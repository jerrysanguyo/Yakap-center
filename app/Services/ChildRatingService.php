<?php

namespace App\Services;

use App\Models\ChildEducationalPlan;

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
}