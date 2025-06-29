<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            AdminSeeder::class,
            RelationSeeder::class,
            BarangaySeeder::class,
            GenderSeeder::class,
            EducationSeeder::class,
            DisabilitySeeder::class,
            ServiceSeeder::class,
            BloodSeeder::class,
            CivilStatusSeeder::class,
            RequirementSeeder::class,
            DomainSeeder::class,
            GoalSeeder::class,
            ObjectiveSeeder::class,
            AccommodationSeeder::class,
            RatingSeeder::class,
            LearningCompetencySeeder::class,
        ]);
    }
}
