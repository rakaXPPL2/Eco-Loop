<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'carbon_saved',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'carbon_saved' => 'decimal:4',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getSubtotalAttribute(): float
    {
        return $this->product->price * $this->quantity;
    }

    public function recalculateCarbon(): void
    {
        $this->carbon_saved = $this->product->carbon_saved * $this->quantity;
        $this->save();
    }
}
