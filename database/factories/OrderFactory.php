<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];
        $paymentMethods = ['bank_transfer', 'e_wallet', 'qris', 'cod'];

        return [
            'user_id' => User::factory()->buyer(),
            'order_number' => Order::generateOrderNumber(),
            'status' => fake()->randomElement($statuses),
            'total_amount' => fake()->randomFloat(2, 50000, 2000000),
            'total_carbon_saved' => fake()->randomFloat(4, 0.5, 50),
            'shipping_address' => fake()->address(),
            'notes' => fake()->optional()->sentence(),
            'payment_method' => fake()->randomElement($paymentMethods),
        ];
    }

    /**
     * Indicate that the order is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the order is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the order is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }

    /**
     * Set the order user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
