<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleService
{
    public function storeSched(array $data, $parent): Schedule
    {
        $schedule = Schedule::updateOrCreate(
            [
                'parent_id' => $parent,
            ],
            [ 
                'date' => $data['scheduled_date'],
                'status' => 'Scheduled',
                'remarks' => 'For interview',
            ]
        );
        
        return $schedule;
    }

    public function destroySched(Schedule $schedule)
    {
        $schedule->delete();

        return $schedule;
    }
}