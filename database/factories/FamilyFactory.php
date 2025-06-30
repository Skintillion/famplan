<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $familyTypes = [
            'The ' . fake()->lastName() . ' Family',
            fake()->lastName() . ' Household',
            'The ' . fake()->lastName() . 's',
            fake()->lastName() . ' Family Home',
        ];

        return [
            'name' => fake()->randomElement($familyTypes),
            'description' => fake()->optional(0.7)->sentence(),
            'settings' => [
                'theme' => fake()->randomElement(['default', 'dark', 'light']),
                'notifications' => fake()->boolean(80),
                'chore_reminders' => fake()->boolean(90),
                'meal_planning' => fake()->boolean(70),
                'health_tracking' => fake()->boolean(60),
                'calendar_sync' => fake()->boolean(85),
            ],
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the family is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Create a family with minimal settings.
     */
    public function minimal(): static
    {
        return $this->state(fn(array $attributes) => [
            'description' => null,
            'settings' => [
                'theme' => 'default',
                'notifications' => true,
                'chore_reminders' => true,
                'meal_planning' => false,
                'health_tracking' => false,
                'calendar_sync' => false,
            ],
        ]);
    }
}
