<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Family::create([
            'name' => 'The Smith Family',
            'description' => 'A happy family of four living in the suburbs',
            'settings' => [
                'theme' => 'default',
                'notifications' => true,
                'chore_reminders' => true,
                'meal_planning' => true,
            ],
            'is_active' => true,
        ]);

        Family::create([
            'name' => 'The Johnson Family',
            'description' => 'A busy family with three kids and two working parents',
            'settings' => [
                'theme' => 'dark',
                'notifications' => true,
                'chore_reminders' => true,
                'meal_planning' => false,
            ],
            'is_active' => true,
        ]);
    }
}
