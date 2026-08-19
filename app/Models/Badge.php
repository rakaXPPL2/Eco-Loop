<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'requirement',
        'requirement_type',
        'is_active',
    ];

    protected $casts = [
        'requirement' => 'decimal:4',
        'is_active' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(UserBadge::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function checkEligibility(User $user): bool
    {
        return match ($this->requirement_type) {
            'carbon_total' => $user->total_carbon_saved >= $this->requirement,
            'orders_count' => $user->total_orders >= $this->requirement,
            'products_sold' => $user->products()->where('status', 'sold')->count() >= $this->requirement,
            default => false,
        };
    }
}
