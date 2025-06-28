<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $ratings = [
            ['name' => 'MA', 'remarks' => 'Maximal more than 5 types of prompt given (Full physical, Partial Physical, Modeling, Gestural, Verbal, and Visual)'],
            ['name' => 'MO', 'remarks' => 'Moderate more than 4 types of prompt given (Partial Physical, Modeling, Gestural, Verbal, and Visual)'],
            ['name' => 'MI', 'remarks' => 'Minimal more than 2 type of prompt given (Gestural, Verbal, and Visual)'],
            ['name' => 'I', 'remarks' => 'indipendent no prompt given'],
        ];
        
        foreach($ratings as $rating)
        {
            Rating::firstOrCreate($rating);
        }
        
    }
}
