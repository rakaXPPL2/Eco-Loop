<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->seller(),
            'name' => fake()->company() . ' Store',
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'region_id' => Region::factory(),
            'phone' => fake()->phoneNumber(),
            'photo' => null,
            'banner' => null,
            'is_verified' => fake()->boolean(30),
        ];
    }

    /**
     * Indicate that the store is verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => true,
        ]);
    }

    /**
     * Indicate that the store is unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => false,
        ]);
    }
}
