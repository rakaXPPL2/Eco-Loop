<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for the authenticated user.
     * Sellers see orders containing their products.
     * Buyers see their own orders.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isSeller()) {
            // Sellers see orders where their products were purchased
            $orders = Order::whereHas('items', function ($query) use ($user) {
                $query->where('seller_id', $user->id);
            })
            ->with(['items' => function ($query) use ($user) {
                $query->where('seller_id', $user->id);
            }, 'user'])
            ->latest()
            ->paginate(10);
        } elseif ($user->isBuyer()) {
            // Buyers see their own orders
            $orders = $user->orders()
                ->with(['items.product.seller', 'user'])
                ->latest()
                ->paginate(10);
        } else {
            // Admin sees all orders
            $orders = Order::with(['user', 'items.product'])
                ->latest()
                ->paginate(10);
        }

        return view('eco-loop.pages.dashboard.orders', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $user = auth()->user();

        // Authorization: Seller can only view orders containing their products
        // Buyer can only view their own orders
        if ($user->isSeller()) {
            $hasSellerProduct = $order->items()->where('seller_id', $user->id)->exists();
            if (!$hasSellerProduct) {
                abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
            }
        } elseif ($user->isBuyer() && $order->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->load(['items.product', 'items.seller', 'user']);

        return view('eco-loop.pages.dashboard.order-detail', compact('order'));
    }

    /**
     * Update the status of an order.
     * Only sellers can update order status, and only for orders containing their products.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $user = auth()->user();

        if (!$user->isSeller()) {
            abort(403, 'Hanya penjual yang dapat memperbarui status pesanan.');
        }

        $hasSellerProduct = $order->items()->where('seller_id', $user->id)->exists();
        if (!$hasSellerProduct) {
            abort(403, 'Pesanan ini tidak berisi produk Anda.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'shipping_provider' => 'nullable|string|max:100|required_if:status,shipped',
            'tracking_number' => 'nullable|string|max:100|required_if:status,shipped',
            'shipping_proof_photo' => 'nullable|image|max:2048|required_if:status,shipped',
        ]);

        $newStatus = $validated['status'];
        $currentStatus = $order->status;

        $validTransitions = [
            'pending' => ['processing', 'cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped' => ['completed'],
            'completed' => [],
            'cancelled' => [],
        ];

        if (!in_array($newStatus, $validTransitions[$currentStatus] ?? [])) {
            return back()->with('error', "Tidak dapat mengubah status dari '{$currentStatus}' ke '{$newStatus}'.");
        }

        $updateData = ['status' => $newStatus];

        if ($newStatus === 'shipped') {
            $path = $request->file('shipping_proof_photo')
                ? $request->file('shipping_proof_photo')->store('shipping-proofs', 'public')
                : $order->seller_shipping_proof_photo;

            $updateData = array_merge($updateData, [
                'shipping_provider' => $validated['shipping_provider'] ?? $order->shipping_provider,
                'tracking_number' => $validated['tracking_number'] ?? $order->tracking_number,
                'shipping_status' => 'sent',
                'seller_shipping_proof_photo' => $path,
                'seller_sent_at' => now(),
            ]);
        }

        if ($newStatus === 'completed') {
            $updateData['shipping_status'] = 'received';
            $updateData['buyer_received_at'] = now();
        }

        $order->update($updateData);

        $statusMessages = [
            'pending' => 'pending',
            'processing' => 'sedang diproses',
            'shipped' => 'sedang dikirim',
            'completed' => 'selesai',
            'cancelled' => 'dibatalkan',
        ];

        $order->user->notifications()->create([
            'type' => 'order',
            'title' => 'Status Pesanan Diperbarui',
            'message' => "Pesanan {$order->order_number} sekarang berstatus: {$statusMessages[$newStatus]}",
            'is_read' => false,
        ]);

        $message = "Status pesanan berhasil diperbarui menjadi '{$statusMessages[$newStatus]}'.";
        return back()->with('success', $message);
    }

    public function uploadShippingProof(Request $request, Order $order)
    {
        $user = auth()->user();

        if (!$user->isSeller()) {
            abort(403, 'Hanya penjual yang bisa mengupload bukti pengiriman.');
        }

        $hasSellerProduct = $order->items()->where('seller_id', $user->id)->exists();
        if (!$hasSellerProduct) {
            abort(403, 'Pesanan ini tidak berisi produk Anda.');
        }

        $validated = $request->validate([
            'shipping_provider' => 'required|string|max:100',
            'tracking_number' => 'required|string|max:100',
            'shipping_proof_photo' => 'required|image|max:2048',
        ]);

        $path = $request->file('shipping_proof_photo')->store('shipping-proofs', 'public');

        $order->update([
            'shipping_provider' => $validated['shipping_provider'],
            'tracking_number' => $validated['tracking_number'],
            'shipping_status' => 'sent',
            'seller_shipping_proof_photo' => $path,
            'seller_sent_at' => now(),
            'status' => 'shipped',
        ]);

        return back()->with('success', 'Bukti pengiriman berhasil diunggah dan paket telah dikirim.');
    }

    public function confirmDelivery(Request $request, Order $order)
    {
        $user = auth()->user();

        if ($order->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $validated = $request->validate([
            'delivery_proof_photo' => 'required|image|max:2048',
            'note' => 'nullable|string|max:500',
        ]);

        $path = $request->file('delivery_proof_photo')->store('delivery-proofs', 'public');

        $order->update([
            'buyer_received_photo' => $path,
            'buyer_received_at' => now(),
            'shipping_status' => 'received',
            'status' => 'completed',
            'notes' => $validated['note'] ?? $order->notes,
        ]);

        return back()->with('success', 'Konfirmasi penerimaan barang berhasil dikirim. Terima kasih!');
    }

    /**
     * Get orders with pending status for a seller (API/JSON response).
     */
    public function getPendingOrders()
    {
        $user = auth()->user();

        if (!$user->isSeller()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pendingOrders = Order::whereHas('items', function ($query) use ($user) {
            $query->where('seller_id', $user->id);
        })
        ->where('status', 'pending')
        ->with(['user', 'items' => function ($query) use ($user) {
            $query->where('seller_id', $user->id);
        }])
        ->latest()
        ->get();

        return response()->json($pendingOrders);
    }
}
