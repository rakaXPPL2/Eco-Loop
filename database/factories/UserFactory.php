<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            // Additional fields for Eco-Loop
            'username' => fake()->unique()->userName(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'avatar' => null,
            'total_carbon_saved' => fake()->randomFloat(4, 0, 100),
            'total_vouchers' => fake()->numberBetween(0, 500),
            'total_orders' => fake()->numberBetween(0, 50),
            'role' => 'buyer',
            'region' => fake()->city(),
            'region_id' => null,
            'store_completed' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'email' => fake()->unique()->safeEmail(),
        ]);
    }

    /**
     * Indicate that the user is a seller.
     */
    public function seller(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'seller',
            'store_completed' => true,
        ]);
    }

    /**
     * Indicate that the user is a buyer.
     */
    public function buyer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'buyer',
        ]);
    }
}
