<?php

namespace Database\Factories;

use App\Models\Chore;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chore>
 */
class ChoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chores = [
            'Make the bed' => ['daily', 'low', 5],
            'Wash dishes' => ['daily', 'medium', 10],
            'Take out trash' => ['daily', 'low', 5],
            'Feed pets' => ['daily', 'medium', 8],
            'Vacuum the house' => ['weekly', 'medium', 15],
            'Do laundry' => ['weekly', 'high', 20],
            'Clean bathroom' => ['weekly', 'medium', 12],
            'Mow the lawn' => ['weekly', 'high', 25],
            'Clean refrigerator' => ['monthly', 'medium', 30],
            'Dust furniture' => ['weekly', 'low', 8],
            'Organize closet' => ['monthly', 'low', 15],
            'Wash windows' => ['monthly', 'medium', 20],
            'Clean garage' => ['monthly', 'high', 35],
            'Water plants' => ['weekly', 'low', 5],
            'Set the table' => ['daily', 'low', 3],
        ];

        $chore = fake()->randomElement(array_keys($chores));
        [$frequency, $priority, $points] = $chores[$chore];

        return [
            'family_id' => Family::factory(),
            'assigned_to' => fake()->optional(0.7)->randomElement(FamilyMember::all()),
            'title' => $chore,
            'description' => fake()->optional(0.6)->sentence(),
            'frequency' => $frequency,
            'due_date' => fake()->optional(0.8)->dateTimeBetween('now', '+2 weeks'),
            'completed_at' => fake()->optional(0.3)->dateTimeBetween('-1 week', 'now'),
            'priority' => $priority,
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed', 'overdue']),
            'points' => $points,
        ];
    }

    /**
     * Create a daily chore.
     */
    public function daily(): static
    {
        return $this->state(fn(array $attributes) => [
            'frequency' => 'daily',
            'due_date' => fake()->dateTimeBetween('now', '+1 day'),
        ]);
    }

    /**
     * Create a weekly chore.
     */
    public function weekly(): static
    {
        return $this->state(fn(array $attributes) => [
            'frequency' => 'weekly',
            'due_date' => fake()->dateTimeBetween('now', '+1 week'),
        ]);
    }

    /**
     * Create a monthly chore.
     */
    public function monthly(): static
    {
        return $this->state(fn(array $attributes) => [
            'frequency' => 'monthly',
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
        ]);
    }

    /**
     * Create a completed chore.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
            'completed_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    /**
     * Create a high priority chore.
     */
    public function highPriority(): static
    {
        return $this->state(fn(array $attributes) => [
            'priority' => 'high',
            'points' => fake()->numberBetween(20, 40),
        ]);
    }
}
