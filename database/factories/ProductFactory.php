<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conditions = ['new', 'like_new', 'good', 'fair'];

        return [
            'user_id' => User::factory()->seller(),
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(10000, 500000),
            'weight' => fake()->randomFloat(2, 0.5, 50),
            'stock' => fake()->numberBetween(1, 100),
            'condition' => fake()->randomElement($conditions),
            'status' => 'available',
            'image' => null,
            'carbon_saved' => fake()->randomFloat(4, 0.1, 10),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
            'status' => 'sold',
        ]);
    }

    /**
     * Indicate that the product is pending approval.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Set the product category by slug.
     */
    public function ofCategory(string $categorySlug): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => Category::where('slug', $categorySlug)->first()?->id ?? $attributes['category_id'],
        ]);
    }
}
