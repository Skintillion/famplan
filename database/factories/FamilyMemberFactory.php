<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyMember>
 */
class FamilyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'family_id' => Family::factory(),
            'name' => fake()->name(),
            'email' => fake()->optional(0.8)->safeEmail(),
            'role' => fake()->randomElement(['parent', 'child', 'guardian', 'other']),
            'avatar' => fake()->optional(0.3)->imageUrl(200, 200, 'people'),
            'is_active' => true,
        ];
    }

    /**
     * Create a parent family member.
     */
    public function parent(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'parent',
            'email' => fake()->safeEmail(),
        ]);
    }

    /**
     * Create a child family member.
     */
    public function child(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'child',
            'email' => null,
        ]);
    }

    /**
     * Create a guardian family member.
     */
    public function guardian(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'guardian',
            'email' => fake()->safeEmail(),
        ]);
    }

    /**
     * Indicate that the family member is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }
}
