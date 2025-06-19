<?php

namespace App\Services;

use App\Models\ApplicationStatus;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleService
{
    public function storeSched(array $data, $child): Schedule
    {
        $schedule = Schedule::updateOrCreate(
            [
                'child_id' => $child,
            ],
            [ 
                'date' => $data['scheduled_date'],
                'status' => 'not_done',
                'remarks' => 'For interview',
            ]
        );

        if($schedule)
        {
            ApplicationStatus::updateOrCreate(
                [
                    'child_id' => $child,
                ],
                [
                    'status' => 'interview',
                ]
            );
        }
        
        return $schedule;
    }

    public function destroySched(Schedule $schedule)
    {
        $schedule->delete();

        return $schedule;
    }
}