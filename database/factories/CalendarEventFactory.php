<?php

namespace Database\Factories;

use App\Models\CalendarEvent;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarEvent>
 */
class CalendarEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventTypes = [
            'personal' => [
                'Doctor appointment',
                'Dentist visit',
                'Haircut',
                'Gym session',
                'Personal training',
                'Massage',
                'Therapy session'
            ],
            'family' => [
                'Family dinner',
                'Movie night',
                'Game night',
                'Family walk',
                'Family meeting',
                'Weekend trip',
                'Family photos'
            ],
            'work' => [
                'Work meeting',
                'Conference call',
                'Deadline',
                'Presentation',
                'Business trip',
                'Team lunch',
                'Training session'
            ],
            'health' => [
                'Doctor checkup',
                'Dental cleaning',
                'Eye exam',
                'Physical therapy',
                'Nutritionist appointment',
                'Mental health session'
            ],
            'other' => [
                'Shopping trip',
                'Car maintenance',
                'Home repair',
                'Volunteer work',
                'Community event',
                'Social gathering',
                'Hobby time'
            ]
        ];

        $type = fake()->randomElement(array_keys($eventTypes));
        $title = fake()->randomElement($eventTypes[$type]);
        $startDate = fake()->dateTimeBetween('now', '+2 months');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s') . ' +1 day');

        return [
            'family_id' => Family::factory(),
            'family_member_id' => fake()->optional(0.7)->randomElement(FamilyMember::all()),
            'title' => $title,
            'description' => fake()->optional(0.6)->sentence(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'all_day' => fake()->boolean(30),
            'location' => fake()->optional(0.4)->address(),
            'color' => fake()->randomElement(['#3B82F6', '#EF4444', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899']),
            'type' => $type,
            'is_recurring' => fake()->boolean(20),
            'recurrence_pattern' => fake()->optional(0.2)->randomElement([
                ['frequency' => 'daily', 'interval' => 1],
                ['frequency' => 'weekly', 'interval' => 1, 'days' => ['monday', 'wednesday', 'friday']],
                ['frequency' => 'monthly', 'interval' => 1, 'day' => 15],
            ]),
        ];
    }

    /**
     * Create a personal event.
     */
    public function personal(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'personal',
            'title' => fake()->randomElement([
                'Doctor appointment',
                'Dentist visit',
                'Haircut',
                'Gym session',
                'Personal training',
                'Massage',
                'Therapy session'
            ]),
            'color' => '#3B82F6',
        ]);
    }

    /**
     * Create a family event.
     */
    public function family(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'family',
            'title' => fake()->randomElement([
                'Family dinner',
                'Movie night',
                'Game night',
                'Family walk',
                'Family meeting',
                'Weekend trip',
                'Family photos'
            ]),
            'color' => '#10B981',
            'family_member_id' => null, // Family events don't belong to specific member
        ]);
    }

    /**
     * Create a work event.
     */
    public function work(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'work',
            'title' => fake()->randomElement([
                'Work meeting',
                'Conference call',
                'Deadline',
                'Presentation',
                'Business trip',
                'Team lunch',
                'Training session'
            ]),
            'color' => '#F59E0B',
        ]);
    }

    /**
     * Create a health event.
     */
    public function health(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'health',
            'title' => fake()->randomElement([
                'Doctor checkup',
                'Dental cleaning',
                'Eye exam',
                'Physical therapy',
                'Nutritionist appointment',
                'Mental health session'
            ]),
            'color' => '#EF4444',
        ]);
    }

    /**
     * Create an all-day event.
     */
    public function allDay(): static
    {
        $startDate = fake()->dateTimeBetween('now', '+1 month');
        $startDate->setTime(0, 0, 0);
        $endDate = clone $startDate;
        $endDate->setTime(23, 59, 59);

        return $this->state(fn(array $attributes) => [
            'all_day' => true,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    /**
     * Create a recurring event.
     */
    public function recurring(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_recurring' => true,
            'recurrence_pattern' => fake()->randomElement([
                ['frequency' => 'daily', 'interval' => 1],
                ['frequency' => 'weekly', 'interval' => 1, 'days' => ['monday', 'wednesday', 'friday']],
                ['frequency' => 'monthly', 'interval' => 1, 'day' => 15],
            ]),
        ]);
    }

    /**
     * Create an urgent event.
     */
    public function urgent(): static
    {
        $startDate = fake()->dateTimeBetween('now', '+1 day');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s') . ' +2 hours');

        return $this->state(fn(array $attributes) => [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'color' => '#EF4444',
        ]);
    }
}
