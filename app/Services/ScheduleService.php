<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleService
{
    public function storeSched(array $data): Schedule
    {
        $schedule = Schedule::updateOrCreate(
            [
                'parent_id' => $data['parent'],
            ],
            [ 
                'date' => $data['scheduled_date'],
                'time' => $data['scheduled_time'],
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