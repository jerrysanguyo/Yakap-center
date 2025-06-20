<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    public function run(): void
    {
        $goals = [
            ['domain_id' => 1, 'name' => 'will improve his phonological awareness ability such as letter sound, action words, sight words and word matching, with a moderate-minimal level of accuracy to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 1, 'name' => 'will increase his word recognition ability in picture to words for things, transportation, animals, fruits & vegetables, community places, & community helpers with a minimal level of accuracy to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 1, 'name' => 'will develop his writing ability by tracing and writing his first name with moderate-minimal level of accuracy to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 2, 'name' => 'will enhance his following patterns in A-B-C form incorporated to colors (PRIMARY & SECONDARY) with a moderate-minimal level of accuracy to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 2, 'name' => 'will increase his knowledge in numeracy skill through recognition of shapes with a moderate- minimal level of accuracy to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 2, 'name' => 'will increase his number concept ability with a moderate-minimal level of accuracy to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 3, 'name' => 'will enhance his finger and hand strength in fine motor skill with moderate - minimal level of accuracy, to independent.', 'remarks' => 'seeder generated'],
            ['domain_id' => 4, 'name' => 'will enhance his interpersonal skills with moderate- minimal level of accuracy, to independent.', 'remarks' => 'seeder generated'],
        ];

        foreach($goals as $g)
        {
            Goal::firstOrCreate($g);
        }
    }
}