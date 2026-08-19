<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use App\Models\Notification;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $cart = Cart::with('items.product.category')
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Keranjang belanja kosong');
        }

        $cartItems = $cart->items;
        $totalCarbonSaved = $cart->total_carbon_saved;
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $shipping = 0; // Free shipping
        $total = $subtotal + $shipping;

        // Get payment methods from PaymentService
        $paymentMethods = PaymentService::getPaymentMethods();

        return view('eco-loop.pages.checkout', compact('cart', 'cartItems', 'totalCarbonSaved', 'subtotal', 'shipping', 'total', 'paymentMethods'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:bank_transfer,e_wallet,qris,cod',
        ]);

        $cart = Cart::with('items.product.category', 'items.product.user')
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Keranjang belanja kosong');
        }

        // Calculate total from cart items
        $totalAmount = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

        // Combine address fields into shipping_address
        $shippingAddress = sprintf(
            '%s %s, %s, %s %s, %s',
            $validated['first_name'],
            $validated['last_name'],
            $validated['address'],
            $validated['city'],
            $validated['state'],
            $validated['zip']
        );

        DB::beginTransaction();

        try {
            // For COD, we can proceed directly since payment is collected on delivery
            // For non-COD, order starts as pending until payment is confirmed
            $isCOD = $validated['payment_method'] === 'cod';
            $initialStatus = $isCOD ? 'processing' : 'pending';

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'total_carbon_saved' => $cart->total_carbon_saved,
                'shipping_address' => $shippingAddress,
                'notes' => $validated['notes'] ?? null,
                'status' => $initialStatus,
                'payment_method' => $validated['payment_method'],
                'payment_status' => $isCOD ? 'paid' : 'pending', // COD is considered paid since collected on delivery
                'payment_paid_at' => $isCOD ? now() : null,
            ]);

            // Create order items and update product stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'seller_id' => $item->product->user_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'carbon_saved' => $item->carbon_saved,
                ]);

                // Update product stock and status
                $item->product->decrement('stock', $item->quantity);
                if ($item->product->stock <= 0) {
                    $item->product->update(['status' => 'sold']);
                }

                // Update seller's carbon saved and orders
                $seller = $item->product->user;
                $seller->addCarbonSaved($item->carbon_saved);
                $seller->incrementOrders();
            }

            // Update buyer's carbon saved and orders
            $user = auth()->user();
            $user->addCarbonSaved($cart->total_carbon_saved);
            $user->incrementOrders();

            // Clear cart
            $cart->items()->delete();
            $cart->update(['total_carbon_saved' => 0]);

            // For COD: create vouchers immediately since payment will be collected on delivery
            if ($isCOD) {
                $this->createOrderVouchers($order);
            }

            DB::commit();

            // For non-COD: initiate payment flow
            if (!$isCOD) {
                $paymentResult = $this->paymentService->initiatePayment($order);
                return redirect()->route('checkout.payment', $order)
                    ->with('payment_instructions', $paymentResult);
            }

            // For COD: redirect to success page
            return redirect()->route('checkout.success', $order)
                ->with('success', 'Pesanan berhasil! Pesanan Anda sedang diproses dan akan dikirim dalam 2-5 hari kerja.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Create vouchers for buyer and sellers after order is confirmed (payment received)
     */
    protected function createOrderVouchers(Order $order): void
    {
        $user = $order->user;

        // Create voucher for buyer (1 point per 0.1 kg CO2)
        $points = (int) ($order->total_carbon_saved * 10);
        Voucher::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'code' => Voucher::generateCode(),
            'carbon_amount' => $order->total_carbon_saved,
            'points' => $points,
            'status' => 'active',
            'expires_at' => now()->addDays(30),
        ]);

        $user->addVoucher($points);

        // Create voucher for each seller
        foreach ($order->items->groupBy('seller_id') as $sellerId => $items) {
            $sellerCarbon = $items->sum('carbon_saved');
            $sellerPoints = (int) ($sellerCarbon * 10);

            Voucher::create([
                'user_id' => $sellerId,
                'order_id' => $order->id,
                'code' => Voucher::generateCode(),
                'carbon_amount' => $sellerCarbon,
                'points' => $sellerPoints,
                'status' => 'active',
                'expires_at' => now()->addDays(30),
            ]);

            // Notify seller
            Notification::create([
                'user_id' => $sellerId,
                'type' => 'order',
                'title' => 'Pesanan Baru!',
                'message' => "Pesanan {$order->order_number} telah dibuat. +{$sellerPoints} voucher karbon!",
                'is_read' => false,
            ]);
        }

        // Notify buyer
        Notification::create([
            'user_id' => $user->id,
            'type' => 'order',
            'title' => 'Pesanan Diproses!',
            'message' => "Pesanan {$order->order_number} sedang diproses. +{$points} voucher karbon!",
            'is_read' => false,
        ]);
    }

    /**
     * Show payment instructions page
     */
    public function payment(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Refresh order with latest payment data
        $order->refresh();
        $order->load(['items.product']);

        // Get payment instructions
        $paymentMethods = PaymentService::getPaymentMethods();
        $selectedMethod = collect($paymentMethods)->firstWhere('id', $order->payment_method);

        // Check if already paid
        if ($order->isPaymentPaid()) {
            return redirect()->route('checkout.success', $order)
                ->with('success', 'Pembayaran sudah lunas!');
        }

        // Check if expired
        if ($order->isPaymentExpired() && $order->isPaymentPending()) {
            $this->paymentService->markPaymentFailed($order, 'Payment expired');
            $order->refresh();
            return redirect()->route('home')
                ->with('error', 'Pembayaran telah kedaluwarsa. Silakan buat pesanan baru.');
        }

        // Get payment instructions based on method
        $instructions = $this->getPaymentInstructions($order);

        return view('eco-loop.pages.checkout-payment', compact('order', 'selectedMethod', 'instructions'));
    }

    /**
     * Generate payment instructions based on method
     */
    protected function getPaymentInstructions(Order $order): array
    {
        $ref = $order->payment_ref ?? $order->order_number;

        return match ($order->payment_method) {
            'bank_transfer' => [
                'type' => 'bank_transfer',
                'title' => 'Transfer Bank',
                'instructions' => [
                    'Pilih bank yang Anda gunakan (BCA, Mandiri, BNI, atau BRI)',
                    'Transfer ke salah satu rekening berikut:',
                    '- BCA: 1234567890 a.n. PT Eco-Loop Indonesia',
                    '- Mandiri: 1234567891 a.n. PT Eco-Loop Indonesia',
                    '- BNI: 1234567892 a.n. PT Eco-Loop Indonesia',
                    '- BRI: 1234567893 a.n. PT Eco-Loop Indonesia',
                    'Transfer dengan nominal: Rp ' . number_format($order->total_amount),
                    'Isikan berita transfer dengan: ' . $ref,
                    'Simpan bukti transfer untuk konfirmasi',
                ],
            ],
            'e_wallet' => [
                'type' => 'e_wallet',
                'title' => 'E-Wallet',
                'instructions' => [
                    'Pilih aplikasi e-wallet Anda (GoPay, OVO, DANA, atau ShopeePay)',
                    'Scan atau masukkan nomor tujuan pembayaran',
                    'Pastikan nominal yang ditransfer: Rp ' . number_format($order->total_amount),
                    'Selesaikan pembayaran dalam aplikasi e-wallet',
                ],
            ],
            'qris' => [
                'type' => 'qris',
                'title' => 'QRIS',
                'instructions' => [
                    'Buka aplikasi mobile banking atau e-wallet Anda',
                    'Pilih menu "Scan QR" atau "Bayar QRIS"',
                    'Scan kode QR yang ditampilkan',
                    'Pastikan nominal: Rp ' . number_format($order->total_amount),
                    'Selesaikan pembayaran',
                ],
                'qr_code' => $ref,
            ],
            'cod' => [
                'type' => 'cod',
                'title' => 'Bayar di Tempat (COD)',
                'instructions' => [
                    'Siapkan uang tunai sebesar Rp ' . number_format($order->total_amount + 5000) . ' (termasuk biaya COD Rp 5.000)',
                    'Kurir akan datang dalam 2-5 hari kerja',
                    'Serahkan pembayaran kepada kurir saat paket diterima',
                    'Pastikan paket sesuai pesanan sebelum membayar',
                ],
                'cod_fee' => 5000,
            ],
            default => [
                'type' => 'unknown',
                'title' => 'Metode Tidak Dikenal',
                'instructions' => ['Silakan hubungi customer service untuk informasi lebih lanjut.'],
            ],
        };
    }

    /**
     * Success page after checkout
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.product', 'vouchers' => function ($q) {
            $q->where('user_id', auth()->id());
        }]);

        // Get the voucher earned for this order
        $voucherEarned = $order->vouchers->first();
        $ordersCount = auth()->user()->orders()->count();

        return view('eco-loop.pages.checkout-success', compact('order', 'voucherEarned', 'ordersCount'));
    }
}
