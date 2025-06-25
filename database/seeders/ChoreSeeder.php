<?php

namespace Database\Seeders;

use App\Models\Chore;
use App\Models\Family;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = Family::all();

        foreach ($families as $family) {
            // Daily chores
            Chore::create([
                'family_id' => $family->id,
                'title' => 'Make the bed',
                'description' => 'Straighten up the bed and pillows',
                'frequency' => 'daily',
                'priority' => 'low',
                'status' => 'pending',
                'points' => 5,
            ]);

            Chore::create([
                'family_id' => $family->id,
                'title' => 'Wash dishes',
                'description' => 'Clean all dishes and put them away',
                'frequency' => 'daily',
                'priority' => 'medium',
                'status' => 'pending',
                'points' => 10,
            ]);

            // Weekly chores
            Chore::create([
                'family_id' => $family->id,
                'title' => 'Vacuum the house',
                'description' => 'Vacuum all rooms and common areas',
                'frequency' => 'weekly',
                'priority' => 'medium',
                'status' => 'pending',
                'points' => 15,
            ]);

            Chore::create([
                'family_id' => $family->id,
                'title' => 'Do laundry',
                'description' => 'Wash, dry, and fold clothes',
                'frequency' => 'weekly',
                'priority' => 'high',
                'status' => 'pending',
                'points' => 20,
            ]);

            // Monthly chores
            Chore::create([
                'family_id' => $family->id,
                'title' => 'Clean refrigerator',
                'description' => 'Remove expired items and clean shelves',
                'frequency' => 'monthly',
                'priority' => 'medium',
                'status' => 'pending',
                'points' => 25,
            ]);
        }
    }
}
