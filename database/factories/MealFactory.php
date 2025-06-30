<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mealTypes = [
            'breakfast' => [
                'Oatmeal with berries',
                'Scrambled eggs and toast',
                'Pancakes with syrup',
                'Yogurt parfait',
                'Smoothie bowl',
                'Breakfast burrito'
            ],
            'lunch' => [
                'Grilled chicken salad',
                'Turkey sandwich',
                'Pasta with vegetables',
                'Soup and crackers',
                'Rice bowl',
                'Caesar salad'
            ],
            'dinner' => [
                'Grilled salmon',
                'Beef stir fry',
                'Chicken pasta',
                'Vegetable curry',
                'Pizza',
                'Tacos'
            ],
            'snack' => [
                'Apple with peanut butter',
                'Trail mix',
                'Greek yogurt',
                'Carrot sticks',
                'Granola bar',
                'Smoothie'
            ]
        ];

        $type = fake()->randomElement(array_keys($mealTypes));
        $name = fake()->randomElement($mealTypes[$type]);

        return [
            'family_id' => Family::factory(),
            'family_member_id' => FamilyMember::factory(),
            'name' => $name,
            'type' => $type,
            'date' => fake()->dateTimeBetween('-1 week', 'now'),
            'notes' => fake()->optional(0.4)->sentence(),
            'total_calories' => fake()->numberBetween(200, 800),
            'total_protein' => fake()->randomFloat(2, 10, 50),
            'total_carbs' => fake()->randomFloat(2, 20, 100),
            'total_fat' => fake()->randomFloat(2, 5, 40),
        ];
    }

    /**
     * Create a breakfast meal.
     */
    public function breakfast(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'breakfast',
            'name' => fake()->randomElement([
                'Oatmeal with berries',
                'Scrambled eggs and toast',
                'Pancakes with syrup',
                'Yogurt parfait',
                'Smoothie bowl',
                'Breakfast burrito'
            ]),
            'total_calories' => fake()->numberBetween(200, 500),
        ]);
    }

    /**
     * Create a lunch meal.
     */
    public function lunch(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'lunch',
            'name' => fake()->randomElement([
                'Grilled chicken salad',
                'Turkey sandwich',
                'Pasta with vegetables',
                'Soup and crackers',
                'Rice bowl',
                'Caesar salad'
            ]),
            'total_calories' => fake()->numberBetween(300, 700),
        ]);
    }

    /**
     * Create a dinner meal.
     */
    public function dinner(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'dinner',
            'name' => fake()->randomElement([
                'Grilled salmon',
                'Beef stir fry',
                'Chicken pasta',
                'Vegetable curry',
                'Pizza',
                'Tacos'
            ]),
            'total_calories' => fake()->numberBetween(400, 800),
        ]);
    }

    /**
     * Create a snack.
     */
    public function snack(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'snack',
            'name' => fake()->randomElement([
                'Apple with peanut butter',
                'Trail mix',
                'Greek yogurt',
                'Carrot sticks',
                'Granola bar',
                'Smoothie'
            ]),
            'total_calories' => fake()->numberBetween(100, 300),
        ]);
    }

    /**
     * Create a low-calorie meal.
     */
    public function lowCalorie(): static
    {
        return $this->state(fn(array $attributes) => [
            'total_calories' => fake()->numberBetween(100, 300),
            'total_fat' => fake()->randomFloat(2, 1, 10),
        ]);
    }

    /**
     * Create a high-protein meal.
     */
    public function highProtein(): static
    {
        return $this->state(fn(array $attributes) => [
            'total_protein' => fake()->randomFloat(2, 30, 60),
            'total_calories' => fake()->numberBetween(400, 700),
        ]);
    }
}
