<?php

namespace App\Services;

use App\Models\ChildEducationalPlan;
use App\Models\ProgressReport;

class ChildRatingService
{
    public function storeChildEducPlan(array $data, $childId)
    {
        $updated = [];

        foreach ($data['ratings'] as $objectiveId => $ratingId) {
            $record = ChildEducationalPlan::updateOrCreate(
                [
                    'child_id' => $childId->id,
                    'objective_id' => $objectiveId,
                ],
                [
                    'rating_id' => $ratingId,
                ]
            );

            $updated[] = $record;
        }

        return $updated;
    }

    public function storeChildProgressReport(array $data, $childId)
    {
        $updated = [];

        foreach ($data['ratings'] as $competencyId => $ratingId) {
            $record = ProgressReport::updateOrCreate(
                [
                    'child_id' => $childId->id,
                    'competency_id' => $competencyId,
                ],
                [
                    'rate_id' => $ratingId,
                ]
            );

            $updated[] = $record;
        }

        return $updated;
    }
}