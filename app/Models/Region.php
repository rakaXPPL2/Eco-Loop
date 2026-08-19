<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'province',
        'city',
        'district',
        'postal_code',
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }

    public function getFullAddressAttribute(): string
    {
        return "{$this->district}, {$this->city}, {$this->province}";
    }

    // Calculate distance to another region in km
    public function getDistanceTo(Region $other): float
    {
        $lat1 = deg2rad($this->latitude ?? 0);
        $lon1 = deg2rad($this->longitude ?? 0);
        $lat2 = deg2rad($other->latitude ?? 0);
        $lon2 = deg2rad($other->longitude ?? 0);

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * asin(sqrt($a));

        return 6371 * $c; // Earth's radius in km
    }
}
