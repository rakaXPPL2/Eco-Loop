<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'code',
        'carbon_amount',
        'points',
        'status',
        'expires_at',
        'redeemed_at',
    ];

    protected $casts = [
        'carbon_amount' => 'decimal:4',
        'points' => 'integer',
        'expires_at' => 'datetime',
        'redeemed_at' => 'datetime',
    ];

    protected $dates = ['expires_at', 'redeemed_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function generateCode(): string
    {
        return 'CRB-' . strtoupper(Str::random(8));
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && !$this->isExpired();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('expires_at', '>', now());
    }

    public function scopeExpiringSoon($query, $days = 7)
    {
        return $query->where('status', 'active')
                    ->whereBetween('expires_at', [now(), now()->addDays($days)]);
    }

    public function markAsRedeemed(): void
    {
        $this->update([
            'status' => 'redeemed',
            'redeemed_at' => now(),
        ]);
    }

    public function checkAndExpire(): void
    {
        if ($this->isExpired() && $this->status === 'active') {
            $this->update(['status' => 'expired']);
        }
    }
}
