<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city() . ' ' . fake()->randomElement(['Pusat', 'Selatan', 'Utara', 'Barat', 'Timur']),
            'slug' => fake()->unique()->slug(2),
            'province' => fake()->state(),
            'city' => fake()->city(),
            'district' => fake()->citySuffix(),
            'postal_code' => fake()->postcode(),
            'latitude' => fake()->latitude(-10, 6),
            'longitude' => fake()->longitude(95, 141),
        ];
    }
}
