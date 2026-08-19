<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'region_id',
        'photo',
        'banner',
        'phone',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'region_id' => 'integer',
            'user_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function getProductsCountAttribute(): int
    {
        return $this->user->products()->count();
    }

    public function getTotalSalesAttribute(): int
    {
        return Order::whereHas('items', fn($q) => $q->where('seller_id', $this->user_id))
            ->where('status', 'completed')
            ->count();
    }
}
