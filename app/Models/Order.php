<?php

namespace App\Models;

use App\Services\PaymentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'total_carbon_saved',
        'shipping_address',
        'notes',
        'shipping_provider',
        'tracking_number',
        'shipping_status',
        'seller_shipping_proof_photo',
        'buyer_received_photo',
        'seller_sent_at',
        'buyer_received_at',
        'payment_method',
        'payment_ref',
        'payment_status',
        'payment_notes',
        'payment_paid_at',
        'payment_expires_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'total_carbon_saved' => 'decimal:4',
        'payment_paid_at' => 'datetime',
        'payment_expires_at' => 'datetime',
        'seller_sent_at' => 'datetime',
        'buyer_received_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }

    public static function generateOrderNumber(): string
    {
        return 'ECO-' . date('Ymd') . '-' . strtoupper(uniqid());
    }

    public function getSellerIdsAttribute(): array
    {
        return $this->items->pluck('seller_id')->unique()->toArray();
    }

    public function getTotalAttribute(): float
    {
        return (float) ($this->total_amount ?? 0);
    }

    public function getCarbonSavedAttribute(): float
    {
        $carbon = $this->total_carbon_saved ?? 0;

        if ((float) $carbon > 0) {
            return (float) $carbon;
        }

        if ($this->relationLoaded('items') || $this->items()->exists()) {
            return (float) $this->items()->sum('carbon_saved');
        }

        return 0.0;
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeAwaitingPayment($query)
    {
        return $query->where('status', 'pending')
            ->where('payment_status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', PaymentService::STATUS_PAID);
    }

    // Payment status helpers
    public function isPaymentPending(): bool
    {
        return $this->payment_status === 'pending' && $this->status === 'pending';
    }

    public function isPaymentPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPaymentFailed(): bool
    {
        return $this->payment_status === 'failed';
    }

    public function isPaymentExpired(): bool
    {
        if ($this->payment_expires_at === null) {
            return false;
        }

        return $this->payment_expires_at->isPast();
    }

    public function canBeConfirmed(): bool
    {
        return $this->status === 'pending' && $this->payment_status !== 'paid';
    }

    public function getPaymentStatusBadgeClass(): string
    {
        return match ($this->payment_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'expired' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPaymentStatusLabel(): string
    {
        return match ($this->payment_status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Lunas',
            'failed' => 'Gagal',
            'expired' => 'Kedaluwarsa',
            default => 'Tidak Diketahui',
        };
    }
}
