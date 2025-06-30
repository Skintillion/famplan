<?php

namespace Database\Factories;

use App\Models\FoodEntry;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodEntry>
 */
class FoodEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foods = [
            'Chicken breast' => [165, 31, 0, 3.6, 0, 0, 74],
            'Salmon' => [208, 25, 0, 12, 0, 0, 59],
            'Brown rice' => [216, 5, 45, 1.8, 3.5, 0.4, 5],
            'Broccoli' => [55, 3.7, 11, 0.6, 5.2, 1.5, 33],
            'Sweet potato' => [103, 2, 24, 0.2, 3.8, 5.4, 41],
            'Greek yogurt' => [59, 10, 3.6, 0.4, 0, 3.2, 36],
            'Banana' => [89, 1.1, 23, 0.3, 2.6, 12, 1],
            'Almonds' => [164, 6, 6, 14, 3.5, 1.2, 1],
            'Spinach' => [23, 2.9, 3.6, 0.4, 2.2, 0.4, 24],
            'Eggs' => [155, 13, 1.1, 11, 0, 1.1, 124],
            'Oatmeal' => [307, 13, 55, 5.3, 8, 1, 49],
            'Avocado' => [160, 2, 9, 15, 7, 0.7, 7],
            'Quinoa' => [222, 8, 39, 4, 5, 1.6, 13],
            'Blueberries' => [57, 0.7, 14, 0.3, 2.4, 10, 1],
            'Tuna' => [184, 39, 0, 6.3, 0, 0, 39],
        ];

        $food = fake()->randomElement(array_keys($foods));
        [$calories, $protein, $carbs, $fat, $fiber, $sugar, $sodium] = $foods[$food];

        return [
            'meal_id' => Meal::factory(),
            'food_name' => $food,
            'quantity' => fake()->randomFloat(2, 0.5, 3.0),
            'unit' => fake()->randomElement(['cup', 'oz', 'g', 'piece', 'tbsp', 'tsp']),
            'calories' => $calories,
            'protein' => $protein,
            'carbs' => $carbs,
            'fat' => $fat,
            'fiber' => $fiber,
            'sugar' => $sugar,
            'sodium' => $sodium,
        ];
    }

    /**
     * Create a high-protein food entry.
     */
    public function highProtein(): static
    {
        return $this->state(fn(array $attributes) => [
            'food_name' => fake()->randomElement(['Chicken breast', 'Salmon', 'Tuna', 'Eggs', 'Greek yogurt']),
            'protein' => fake()->numberBetween(20, 40),
            'calories' => fake()->numberBetween(150, 250),
        ]);
    }

    /**
     * Create a low-carb food entry.
     */
    public function lowCarb(): static
    {
        return $this->state(fn(array $attributes) => [
            'food_name' => fake()->randomElement(['Chicken breast', 'Salmon', 'Spinach', 'Broccoli', 'Eggs']),
            'carbs' => fake()->numberBetween(0, 10),
            'calories' => fake()->numberBetween(50, 200),
        ]);
    }

    /**
     * Create a high-fiber food entry.
     */
    public function highFiber(): static
    {
        return $this->state(fn(array $attributes) => [
            'food_name' => fake()->randomElement(['Broccoli', 'Sweet potato', 'Quinoa', 'Oatmeal', 'Almonds']),
            'fiber' => fake()->numberBetween(3, 8),
            'calories' => fake()->numberBetween(100, 300),
        ]);
    }

    /**
     * Create a fruit food entry.
     */
    public function fruit(): static
    {
        return $this->state(fn(array $attributes) => [
            'food_name' => fake()->randomElement(['Banana', 'Blueberries', 'Apple', 'Orange', 'Strawberries']),
            'sugar' => fake()->numberBetween(5, 15),
            'carbs' => fake()->numberBetween(15, 30),
        ]);
    }

    /**
     * Create a vegetable food entry.
     */
    public function vegetable(): static
    {
        return $this->state(fn(array $attributes) => [
            'food_name' => fake()->randomElement(['Broccoli', 'Spinach', 'Carrots', 'Bell peppers', 'Cauliflower']),
            'calories' => fake()->numberBetween(20, 80),
            'fiber' => fake()->numberBetween(2, 6),
        ]);
    }
}
