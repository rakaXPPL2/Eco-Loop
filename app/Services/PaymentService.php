<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Notification;

/**
 * Payment Simulation Service
 *
 * This service simulates payment gateway behavior.
 * In production, replace with actual payment provider (Midtrans, etc.)
 */
class PaymentService
{
    /**
     * Payment status constants
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_FAILED = 'failed';
    public const STATUS_EXPIRED = 'expired';

    /**
     * Payment method constants
     */
    public const METHOD_BANK_TRANSFER = 'bank_transfer';
    public const METHOD_E_WALLET = 'e_wallet';
    public const METHOD_QRIS = 'qris';
    public const METHOD_COD = 'cod';

    /**
     * Simulate payment initiation
     * In production, this would call Midtrans/other gateway API
     */
    public function initiatePayment(Order $order): array
    {
        // Generate simulation payment reference
        $paymentRef = 'PAY-' . strtoupper(uniqid()) . '-' . time();

        // Calculate expiration (24 hours from now)
        $expiresAt = now()->addHours(24);

        // Generate payment instructions based on method
        $instructions = $this->generateInstructions($order->payment_method, $paymentRef);

        // Update order with payment reference
        $order->update([
            'payment_ref' => $paymentRef,
            'payment_expires_at' => $expiresAt,
        ]);

        // Notify admin of new pending payment
        $this->notifyAdminNewPayment($order);

        return [
            'success' => true,
            'payment_ref' => $paymentRef,
            'expires_at' => $expiresAt,
            'instructions' => $instructions,
            'amount' => $order->total_amount,
            'message' => 'Payment initiated successfully. Please complete payment within 24 hours.',
        ];
    }

    /**
     * Generate payment instructions based on method
     */
    protected function generateInstructions(string $method, string $paymentRef): array
    {
        return match ($method) {
            self::METHOD_BANK_TRANSFER => [
                'title' => 'Transfer Bank',
                'bank' => [
                    ['name' => 'BCA', 'account' => '1234567890', 'holder' => 'PT Eco-Loop Indonesia'],
                    ['name' => 'Mandiri', 'account' => '1234567891', 'holder' => 'PT Eco-Loop Indonesia'],
                    ['name' => 'BNI', 'account' => '1234567892', 'holder' => 'PT Eco-Loop Indonesia'],
                    ['name' => 'BRI', 'account' => '1234567893', 'holder' => 'PT Eco-Loop Indonesia'],
                ],
                'amount_to_pay' => 'Transfer sesuai nominal pesanan',
                'notes' => 'Mohon transfer tepat hingga 2 angka desimal untuk verifikasi otomatis.',
            ],
            self::METHOD_E_WALLET => [
                'title' => 'E-Wallet',
                'options' => [
                    ['name' => 'GoPay', 'icon' => 'fa-google-wallet'],
                    ['name' => 'OVO', 'icon' => 'fa-credit-card'],
                    ['name' => 'DANA', 'icon' => 'fa-mobile-alt'],
                    ['name' => 'ShopeePay', 'icon' => 'fa-shopping-bag'],
                ],
                'notes' => 'Pastikan saldo cukup sebelum melanjutkan.',
            ],
            self::METHOD_QRIS => [
                'title' => 'QRIS',
                'qr_code' => $paymentRef,
                'notes' => 'Scan QR Code menggunakan aplikasi e-wallet atau mobile banking Anda.',
            ],
            self::METHOD_COD => [
                'title' => 'Bayar di Tempat (COD)',
                'notes' => 'Siapkan uang tunai sesuai nominal pesanan saat kurir datang.',
                'additional_info' => 'Biaya COD Rp 5.000 akan ditambahkan pada saat pembayaran.',
            ],
            default => [
                'title' => 'Metode Tidak Dikenal',
                'notes' => 'Silakan hubungi customer service.',
            ],
        };
    }

    /**
     * Simulate payment confirmation (admin action)
     */
    public function confirmPayment(Order $order, array $data = []): bool
    {
        // Validate order can be confirmed
        if ($order->payment_status === self::STATUS_PAID) {
            return false;
        }

        if ($order->status === 'cancelled') {
            return false;
        }

        // Update payment status
        $order->update([
            'payment_status' => self::STATUS_PAID,
            'payment_paid_at' => now(),
            'payment_notes' => $data['notes'] ?? null,
            'status' => 'processing', // Auto-update order status
        ]);

        // Notify buyer
        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'payment',
            'title' => 'Pembayaran Dikonfirmasi!',
            'message' => "Pembayaran untuk pesanan {$order->order_number} telah dikonfirmasi. Pesanan Anda sedang diproses.",
            'is_read' => false,
        ]);

        // Notify sellers
        $sellerIds = $order->items->pluck('seller_id')->unique();
        foreach ($sellerIds as $sellerId) {
            Notification::create([
                'user_id' => $sellerId,
                'type' => 'order',
                'title' => 'Pembayaran Pesanan Dikonfirmasi!',
                'message' => "Pembayaran untuk pesanan {$order->order_number} telah dikonfirmasi. Silakan siapkan produk untuk dikirim.",
                'is_read' => false,
            ]);
        }

        return true;
    }

    /**
     * Simulate payment failure
     */
    public function markPaymentFailed(Order $order, string $reason = ''): bool
    {
        $order->update([
            'payment_status' => self::STATUS_FAILED,
            'payment_notes' => $reason,
            'status' => 'cancelled',
        ]);

        // Notify buyer
        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'payment',
            'title' => 'Pembayaran Gagal',
            'message' => "Pembayaran untuk pesanan {$order->order_number} gagal. Pesanan telah dibatalkan.",
            'is_read' => false,
        ]);

        return true;
    }

    /**
     * Check if payment has expired
     */
    public function isExpired(Order $order): bool
    {
        if ($order->payment_status === self::STATUS_PAID) {
            return false;
        }

        if ($order->payment_expires_at && $order->payment_expires_at->isPast()) {
            return true;
        }

        return false;
    }

    /**
     * Mark expired payments
     */
    public function expirePendingPayments(): int
    {
        $expiredOrders = Order::where('payment_status', self::STATUS_PENDING)
            ->where('payment_expires_at', '<', now())
            ->where('status', 'pending')
            ->get();

        foreach ($expiredOrders as $order) {
            $this->markPaymentFailed($order, 'Payment expired - timeout');
        }

        return $expiredOrders->count();
    }

    /**
     * Notify admin of new pending payment
     */
    protected function notifyAdminNewPayment(Order $order): void
    {
        $admins = \App\Models\User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'payment',
                'title' => 'Pembayaran Baru Menunggu Konfirmasi',
                'message' => "Pesanan {$order->order_number} sebesar Rp " . number_format($order->total_amount) . " menunggu konfirmasi pembayaran.",
                'data' => ['order_id' => $order->id],
                'is_read' => false,
            ]);
        }
    }

    /**
     * Get available payment methods
     */
    public static function getPaymentMethods(): array
    {
        return [
            [
                'id' => self::METHOD_BANK_TRANSFER,
                'name' => 'Transfer Bank',
                'description' => 'BCA, Mandiri, BNI, BRI',
                'icon' => 'fa-university',
                'color' => 'blue',
            ],
            [
                'id' => self::METHOD_E_WALLET,
                'name' => 'E-Wallet',
                'description' => 'GoPay, OVO, DANA, ShopeePay',
                'icon' => 'fa-mobile-alt',
                'color' => 'purple',
            ],
            [
                'id' => self::METHOD_QRIS,
                'name' => 'QRIS',
                'description' => 'Scan QR dengan aplikasi apapun',
                'icon' => 'fa-qrcode',
                'color' => 'teal',
            ],
            [
                'id' => self::METHOD_COD,
                'name' => 'Bayar di Tempat (COD)',
                'description' => 'Bayar saat barang diterima (+Rp 5.000)',
                'icon' => 'fa-money-bill-wave',
                'color' => 'green',
            ],
        ];
    }
}
