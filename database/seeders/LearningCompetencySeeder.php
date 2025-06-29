<?php

namespace Database\Seeders;

use App\Models\learningCompetency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningCompetencySeeder extends Seeder
{
    public function run(): void
    {
        $competencies = [
            [
                'domain_id' => 1,
                'competencies' => [
                    ['name' => 'Recognition of letters of the first and last name'],
                    ['name' => 'Matching letters of his full name'],
                    ['name' => 'Scribbles in vertical, horizontal, and circular directions'],
                    ['name' => 'Imitates vertical, horizontal, and circular'],
                    ['name' => 'Recognition of letters uppercase and lowercase “A-Z'],
                    ['name' => 'Matching letters “A-Z”'],
                    ['name' => 'Tracing letters “A-Z”'],
                    ['name' => 'Writing letters “A-Z”'],
                    ['name' => 'Sound recognition of letters “A-Z”'],
                ], 
            ],
            [
                'domain_id' => 2,
                'competencies' => [
                    ['name'=> 'Color recognition (PRIMARY COLORS)'],
                    ['name'=> 'Color sorting (PRIMARY COLORS)'],
                    ['name'=> 'Color matching (PRIMARY COLORS)'],
                    ['name'=> 'Color recognition (SECONDARY COLORS)'],
                    ['name'=> 'Color sorting (SECONDARY COLORS)'],
                    ['name'=> 'Color matching (SECONDARY COLORS)'],
                    ['name'=> 'Pattern recognition with incorporation of colors RED-BLUE-RED'],
                    ['name'=> 'Pattern recognition with incorporation of colors BLUE-RED-BLUE'],
                    ['name'=> 'Pattern recognition with incorporation of colors BLUE-YELLOW-BLUE'],
                    ['name'=> 'Pattern recognition with incorporation of colors YELLOW-BLUE-YELLOW'],
                ],
            ],
            [
                'domain_id' => 3,
                'competencies' => [
                    ['name' => 'Ripping and crumpling paper'],
                    ['name' => 'Lacing and threading'],
                    ['name' => 'Stacking blocks, gears, pipes & cubes'],
                    ['name' => 'Pegs clipping '],
                    ['name' => 'Screwing bolts'],
                    ['name' => 'Peg boards matching'],
                    ['name' => 'Letter craft “A-Z”'],
                ],
            ],
            [
                'domain_id' => 4,
                'competencies' => [
                    ['name' => 'Running '],
                    ['name' => 'Walking '],
                    ['name' => 'Crawling '],
                    ['name' => 'Stand and jump'],
                    ['name' => 'Balance beam crossing '],
                    ['name' => 'Dance imitation 3-4 steps'],
                    ['name' => 'Pushing and pulling of chair'],
                    ['name' => 'Shooting and throwing of balls'],
                ],
            ],
            [
                'domain_id' => 5,
                'competencies' => [
                    ['name' => 'Look and respond when name is called'],
                    ['name' => 'Imitate simple greetings (non-verbal)'],
                    ['name' => 'Imitate simple greetings (verbal)'],
                    ['name' => 'Reciprocate greetings'],
                    ['name' => 'Responds to yes or no questions'],
                ],
            ],
        ];

        foreach($competencies as $record)
        {
            foreach($record['competencies'] as $competency)
            {
                learningCompetency::firstOrCreate(
                    [
                        'domain_id' => $record['domain_id'],
                        'name' => $competency['name'],
                    ],
                    [ 
                        'remarks' => 'seeder generated'
                    ],
                );
            }
        }
    }
}
