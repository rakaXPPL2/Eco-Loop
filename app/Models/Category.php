<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'carbon_value_per_kg',
        'is_active',
        'type',
    ];

    protected $casts = [
        'carbon_value_per_kg' => 'decimal:4',
        'is_active' => 'boolean',
    ];

    /**
     * Color configuration for categories
     * This provides consistent colors across the application
     */
    public const COLORS = [
        'produk-olahan' => [
            'bg_from' => '#f3e8ff',
            'bg_to' => '#e9d5ff',
            'text' => '#9333ea',
            'border' => '#c084fc',
        ],
        'makanan-sisa' => [
            'bg_from' => '#ffedd5',
            'bg_to' => '#fed7aa',
            'text' => '#ea580c',
            'border' => '#fb923c',
        ],
        'rumput-pakan' => [
            'bg_from' => '#dcfce7',
            'bg_to' => '#bbf7d0',
            'text' => '#22c55e',
            'border' => '#4ade80',
        ],
        'sampah-daur-ulang' => [
            'bg_from' => '#dbeafe',
            'bg_to' => '#bfdbfe',
            'text' => '#2563eb',
            'border' => '#60a5fa',
        ],
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get colors for this category
     */
    public function getColors(): array
    {
        return self::COLORS[$this->slug] ?? [
            'bg_from' => '#f3f4f6',
            'bg_to' => '#e5e7eb',
            'text' => '#6b7280',
            'border' => '#9ca3af',
        ];
    }

    /**
     * Get inline style for category background gradient
     */
    public function getBackgroundStyle(): string
    {
        $colors = $this->getColors();
        return "background: linear-gradient(135deg, {$colors['bg_from']} 0%, {$colors['bg_to']} 100%);";
    }

    /**
     * Get inline style for category text color
     */
    public function getTextStyle(): string
    {
        return "color: " . ($this->getColors()['text'] ?? '#6b7280') . ";";
    }
}
