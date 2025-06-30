<?php

namespace Database\Factories;

use App\Models\FamilyMember;
use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightLog>
 */
class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_member_id' => FamilyMember::factory(),
            'weight' => fake()->randomFloat(2, 100, 250),
            'date' => fake()->dateTimeBetween('-6 months', 'now'),
            'notes' => fake()->optional(0.3)->sentence(),
            'body_fat_percentage' => fake()->optional(0.5)->randomFloat(2, 8, 35),
            'muscle_mass' => fake()->optional(0.4)->randomFloat(2, 30, 80),
        ];
    }

    /**
     * Create a weight log for an adult.
     */
    public function adult(): static
    {
        return $this->state(fn(array $attributes) => [
            'weight' => fake()->randomFloat(2, 120, 220),
            'body_fat_percentage' => fake()->optional(0.6)->randomFloat(2, 10, 30),
            'muscle_mass' => fake()->optional(0.5)->randomFloat(2, 40, 70),
        ]);
    }

    /**
     * Create a weight log for a child.
     */
    public function child(): static
    {
        return $this->state(fn(array $attributes) => [
            'weight' => fake()->randomFloat(2, 30, 100),
            'body_fat_percentage' => fake()->optional(0.3)->randomFloat(2, 8, 25),
            'muscle_mass' => fake()->optional(0.2)->randomFloat(2, 15, 40),
        ]);
    }

    /**
     * Create a recent weight log.
     */
    public function recent(): static
    {
        return $this->state(fn(array $attributes) => [
            'date' => fake()->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    /**
     * Create a weight log with body composition data.
     */
    public function withBodyComposition(): static
    {
        return $this->state(fn(array $attributes) => [
            'body_fat_percentage' => fake()->randomFloat(2, 8, 35),
            'muscle_mass' => fake()->randomFloat(2, 30, 80),
        ]);
    }

    /**
     * Create a weight log showing weight loss trend.
     */
    public function weightLoss(): static
    {
        $startWeight = fake()->randomFloat(2, 180, 250);
        $currentWeight = $startWeight - fake()->randomFloat(2, 5, 30);

        return $this->state(fn(array $attributes) => [
            'weight' => $currentWeight,
            'notes' => fake()->optional(0.4)->randomElement([
                'Feeling lighter!',
                'Good progress',
                'Staying consistent',
                'Healthy eating paying off',
                'Exercise routine working'
            ]),
        ]);
    }

    /**
     * Create a weight log showing weight gain trend.
     */
    public function weightGain(): static
    {
        $startWeight = fake()->randomFloat(2, 120, 180);
        $currentWeight = $startWeight + fake()->randomFloat(2, 5, 25);

        return $this->state(fn(array $attributes) => [
            'weight' => $currentWeight,
            'notes' => fake()->optional(0.4)->randomElement([
                'Building muscle',
                'Healthy weight gain',
                'Feeling stronger',
                'Good nutrition',
                'Training progress'
            ]),
        ]);
    }
}
