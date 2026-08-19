<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'points_required',
        'type',
        'value',
        'is_active',
        'stock',
    ];

    protected $casts = [
        'points_required' => 'integer',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    public function redemptions(): HasMany
    {
        return $this->hasMany(Redemption::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->where('stock', -1)
                          ->orWhere('stock', '>', 0);
                    });
    }

    public function isAvailable(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        return $this->stock === -1 || $this->stock > 0;
    }

    public function decrementStock(): bool
    {
        if ($this->stock === -1) {
            return true;
        }

        if ($this->stock > 0) {
            $this->decrement('stock');
            return true;
        }

        return false;
    }
}
