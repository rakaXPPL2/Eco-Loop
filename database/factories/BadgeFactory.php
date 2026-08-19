<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Badge>
 */
class BadgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $badges = [
            ['name' => 'Pemula Hijau', 'slug' => 'pemula-hijau', 'icon' => 'fa-seedling', 'color' => '#22c55e', 'requirement' => 1, 'type' => 'carbon_total'],
            ['name' => 'Pahlawan Lingkungan', 'slug' => 'pahlawan-lingkungan', 'icon' => 'fa-hands-helping', 'color' => '#10b981', 'requirement' => 10, 'type' => 'carbon_total'],
            ['name' => 'Juara Hijau', 'slug' => 'juara-hijau', 'icon' => 'fa-trophy', 'color' => '#f59e0b', 'requirement' => 50, 'type' => 'carbon_total'],
            ['name' => 'Duta Karbon', 'slug' => 'duta-karbon', 'icon' => 'fa-medal', 'color' => '#ef4444', 'requirement' => 100, 'type' => 'carbon_total'],
        ];

        $badge = fake()->randomElement($badges);

        return [
            'name' => $badge['name'],
            'slug' => $badge['slug'] . '-' . fake()->unique()->randomNumber(4),
            'description' => fake()->sentence(),
            'icon' => $badge['icon'],
            'color' => $badge['color'],
            'requirement' => $badge['requirement'],
            'requirement_type' => $badge['type'],
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the badge is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
