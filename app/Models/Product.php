<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'city',
        'price',
        'weight',
        'stock',
        'image',
        'condition',
        'status',
        'carbon_saved',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'weight' => 'decimal:2',
            'carbon_saved' => 'decimal:4',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias for user() relationship - returns the seller of this product.
     * This is used for eager loading: ->with(['items.product.seller'])
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')
                    ->where('is_active', true)
                    ->where('stock', '>', 0);
    }

    public function calculateCarbonSaved(): float
    {
        if (!$this->category) {
            return 0;
        }

        // Different categories have different CO2 savings per kg
        // Based on real environmental impact data
        $carbonValues = [
            'produk-olahan' => 2.5,    // Processed leather/compost saves more CO2
            'makanan-sisa' => 3.2,     // Food waste prevention saves significant CO2
            'rumput-pakan' => 1.5,    // Animal feed substitution
            'sampah-daur-ulang' => 3.8, // Recycling plastics/metals saves most CO2
        ];

        $valuePerKg = $carbonValues[$this->category->slug] ?? 1.0;

        return round($this->weight * $valuePerKg, 4);
    }

    // Get formatted carbon savings text
    public function getCarbonDisplayAttribute(): string
    {
        $carbon = $this->carbon_saved ?? $this->calculateCarbonSaved();

        // Different display based on category
        $unitLabels = [
            'produk-olahan' => 'CO₂eq dari pengolahan kulit/kompos',
            'makanan-sisa' => 'CO₂eq dari pencegahan food waste',
            'rumput-pakan' => 'CO₂eq dari substitusi pakan',
            'sampah-daur-ulang' => 'CO₂eq dari recycling',
        ];

        $unitLabel = $unitLabels[$this->category->slug ?? ''] ?? 'CO₂eq yang dihemat';

        return "{$carbon} kg {$unitLabel}";
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if ($product->category) {
                $product->carbon_saved = $product->calculateCarbonSaved();
            }
        });
    }
}
