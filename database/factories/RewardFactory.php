<?php

namespace Database\Factories;

use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['discount', 'product', 'donation'];
        $type = fake()->randomElement($types);

        return [
            'name' => fake()->randomElement([
                'Diskon 10%',
                'Diskon 20%',
                'Eco Bag',
                'Bibit Pohon',
                'Donasi Penghijauan',
                'Free Shipping',
                'Voucher Rp 50.000',
            ]),
            'description' => fake()->paragraph(),
            'image' => null,
            'points_required' => fake()->numberBetween(50, 500),
            'type' => $type,
            'value' => $type === 'discount' ? fake()->numberBetween(5, 25) . '%' : fake()->word(),
            'is_active' => true,
            'stock' => fake()->numberBetween(10, 100),
        ];
    }

    /**
     * Indicate that the reward is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    /**
     * Indicate that the reward is unlimited stock.
     */
    public function unlimited(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => -1,
        ]);
    }

    /**
     * Indicate that the reward is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
