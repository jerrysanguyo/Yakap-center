<?php

namespace App\Services;

use App\Mail\InterviewScheduledMail;
use App\Models\ApplicationStatus;
use App\Models\ParentsInfo;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ScheduleService
{
    public function storeSched(array $data, $child): Schedule
    {
        $schedule = Schedule::updateOrCreate(
            ['child_id' => $child],
            [ 
                'date' => $data['scheduled_date'],
                'status' => 'not_done',
                'remarks' => 'For interview',
            ]
        );

        if ($schedule) {
            ApplicationStatus::updateOrCreate(
                ['child_id' => $child],
                ['status' => 'interview']
            );

            $fatherEmail = ParentsInfo::where('child_id', $child)
                                    ->where('type_id', 1)
                                    ->pluck('email')
                                    ->first();

            $motherEmail = ParentsInfo::where('child_id', $child)
                                    ->where('type_id', 2)
                                    ->pluck('email')
                                    ->first();

            $emails = array_filter([$fatherEmail, $motherEmail]);

            if (!empty($emails)) {
                Mail::to($emails)->send(new InterviewScheduledMail($schedule));
            }
        }

        return $schedule;
    }

    public function destroySched(Schedule $schedule)
    {
        $schedule->delete();

        return $schedule;
    }
}