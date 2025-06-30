<?php

namespace Database\Seeders;

use App\Models\CalendarEvent;
use App\Models\Chore;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\FoodEntry;
use App\Models\Meal;
use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Database\Seeder;

class FamplanTestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users
        $users = User::factory(5)->create();

        // Create families with members
        $families = Family::factory(3)->create();

        foreach ($families as $family) {
            // Create family members for each family
            $members = collect();

            // Add 2 parents
            $members->push(
                FamilyMember::factory()
                    ->parent()
                    ->create([
                        'family_id' => $family->id,
                        'user_id' => $users->random()->id,
                    ])
            );

            $members->push(
                FamilyMember::factory()
                    ->parent()
                    ->create([
                        'family_id' => $family->id,
                        'user_id' => $users->random()->id,
                    ])
            );

            // Add 1-3 children
            $childCount = rand(1, 3);
            for ($i = 0; $i < $childCount; $i++) {
                $members->push(
                    FamilyMember::factory()
                        ->child()
                        ->create([
                            'family_id' => $family->id,
                            'user_id' => $users->random()->id,
                        ])
                );
            }

            // Create chores for the family
            Chore::factory(rand(8, 15))
                ->create([
                    'family_id' => $family->id,
                    'assigned_to' => $members->random()->id,
                ]);

            // Create meals for each family member
            foreach ($members as $member) {
                // Create meals for the past week
                for ($i = 0; $i < rand(10, 20); $i++) {
                    $meal = Meal::factory()
                        ->create([
                            'family_id' => $family->id,
                            'family_member_id' => $member->id,
                        ]);

                    // Add 2-5 food entries per meal
                    FoodEntry::factory(rand(2, 5))
                        ->create(['meal_id' => $meal->id]);
                }
            }

            // Create weight logs for adult members
            foreach ($members->where('role', 'parent') as $member) {
                WeightLog::factory(rand(5, 12))
                    ->adult()
                    ->create(['family_member_id' => $member->id]);
            }

            // Create weight logs for children
            foreach ($members->where('role', 'child') as $member) {
                WeightLog::factory(rand(3, 8))
                    ->child()
                    ->create(['family_member_id' => $member->id]);
            }

            // Create calendar events
            CalendarEvent::factory(rand(10, 20))
                ->create(['family_id' => $family->id]);

            // Create some personal events for each member
            foreach ($members as $member) {
                CalendarEvent::factory(rand(3, 8))
                    ->personal()
                    ->create([
                        'family_id' => $family->id,
                        'family_member_id' => $member->id,
                    ]);
            }

            // Create some family events
            CalendarEvent::factory(rand(5, 10))
                ->family()
                ->create(['family_id' => $family->id]);
        }

        // Create some standalone data for testing
        $this->createStandaloneData();
    }

    private function createStandaloneData(): void
    {
        // Create a family with minimal data
        $minimalFamily = Family::factory()
            ->minimal()
            ->create();

        $minimalMember = FamilyMember::factory()
            ->parent()
            ->create(['family_id' => $minimalFamily->id]);

        // Create some specific test scenarios
        $this->createTestScenarios($minimalFamily, $minimalMember);
    }

    private function createTestScenarios(Family $family, FamilyMember $member): void
    {
        // Scenario 1: High priority chores
        Chore::factory(3)
            ->highPriority()
            ->create([
                'family_id' => $family->id,
                'assigned_to' => $member->id,
            ]);

        // Scenario 2: Completed chores
        Chore::factory(5)
            ->completed()
            ->create([
                'family_id' => $family->id,
                'assigned_to' => $member->id,
            ]);

        // Scenario 3: Weight loss trend
        WeightLog::factory(8)
            ->weightLoss()
            ->create(['family_member_id' => $member->id]);

        // Scenario 4: High protein meals
        for ($i = 0; $i < 5; $i++) {
            $meal = Meal::factory()
                ->highProtein()
                ->create([
                    'family_id' => $family->id,
                    'family_member_id' => $member->id,
                ]);

            FoodEntry::factory(3)
                ->highProtein()
                ->create(['meal_id' => $meal->id]);
        }

        // Scenario 5: Urgent calendar events
        CalendarEvent::factory(3)
            ->urgent()
            ->create([
                'family_id' => $family->id,
                'family_member_id' => $member->id,
            ]);
    }
}
