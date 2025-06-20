<?php

namespace Database\Seeders;

use App\Models\Objective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjectiveSeeder extends Seeder
{
    public function run(): void
    {
        $objectives = [
            ['goal_id' => 1, 'name' => 'Identify letter sounds from A-Z', 'remarks' => 'seeder generated'],
            ['goal_id' => 1, 'name' => 'Recognize at least 10-15 action words', 'remarks' => 'seeder generated'],
            ['goal_id' => 1, 'name' => 'familiarize with at least 10-15 sight words', 'remarks' => 'seeder generated'],

            ['goal_id' => 2, 'name' => 'Identify and read words to pictures of things', 'remarks' => 'seeder generated'],
            ['goal_id' => 2, 'name' => 'Identify and read words to pictures of transportations', 'remarks' => 'seeder generated'],
            ['goal_id' => 2, 'name' => 'Identify and read words to pictures of animals', 'remarks' => 'seeder generated'],
            ['goal_id' => 2, 'name' => 'Identify and read words to pictures of fruits & vegetables', 'remarks' => 'seeder generated'],
            ['goal_id' => 2, 'name' => 'Identify and read words to pictures of community helpers', 'remarks' => 'seeder generated'],
            ['goal_id' => 2, 'name' => 'Identify and read words to pictures of community places', 'remarks' => 'seeder generated'],

            ['goal_id' => 3, 'name' => 'Trace his first name in large print with moderate assistance to independent', 'remarks' => 'seeder generated'],
            ['goal_id' => 3, 'name' => 'Write his first name in large print with moderate assistance to independent', 'remarks' => 'seeder generated'],

            ['goal_id' => 4, 'name' => 'Familiarize in the pattern of A-B-C form through color RED-YELLOW-BLUE', 'remarks' => 'seeder generated'],

            ['goal_id' => 5, 'name' => 'Sort shapes, sort objects according to its shapes, and match shapes to its name', 'remarks' => 'seeder generated'],
            ['goal_id' => 5, 'name' => 'Trace and draw shapes, color shapes, and sort shapes according to color', 'remarks' => 'seeder generated'],

            ['goal_id' => 6, 'name' => 'Recognition of numbers 1-20, and matching of numerals to numerals', 'remarks' => 'seeder generated'],
            ['goal_id' => 6, 'name' => 'Matching numerals to number words', 'remarks' => 'seeder generated'],
            ['goal_id' => 6, 'name' => 'Tracing numerals 1-20, and tracing numerals and number words 1-20', 'remarks' => 'seeder generated'],

            ['goal_id' => 7, 'name' => 'Strengthen grip and pinch', 'remarks' => 'seeder generated'],
            ['goal_id' => 7, 'name' => 'Improve weight bearing activity through the arms', 'remarks' => 'seeder generated'],

            ['goal_id' => 8, 'name' => 'Introduces self', 'remarks' => 'seeder generated'],
            ['goal_id' => 8, 'name' => 'Call peers by name', 'remarks' => 'seeder generated'],
            ['goal_id' => 8, 'name' => 'Requesting items from peers, and gives and receives items from peers', 'remarks' => 'seeder generated'],
        ];

        foreach($objectives as $o)
        {
            Objective::firstOrCreate($o);
        }
    }
}
