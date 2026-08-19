<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Produk Olahan', 'slug' => 'produk-olahan', 'icon' => 'fa-recycle', 'carbon_value' => 0.8],
            ['name' => 'Makanan Sisa', 'slug' => 'makanan-sisa', 'icon' => 'fa-utensils', 'carbon_value' => 0.6],
            ['name' => 'Rumput & Pakan Ternak', 'slug' => 'rumput-pakan', 'icon' => 'fa-seedling', 'carbon_value' => 0.45],
            ['name' => 'Sampah Daur Ulang', 'slug' => 'sampah-daur-ulang', 'icon' => 'fa-trash-alt', 'carbon_value' => 0.35],
        ];

        $category = fake()->randomElement($categories);

        return [
            'name' => $category['name'],
            'slug' => $category['slug'] . '-' . fake()->unique()->randomNumber(4),
            'description' => fake()->sentence(),
            'icon' => $category['icon'],
            'carbon_value_per_kg' => $category['carbon_value'],
            'is_active' => true,
            'type' => fake()->randomElement(['product', 'food_waste', 'forage', 'recyclable']),
        ];
    }

    /**
     * Indicate that the category is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
