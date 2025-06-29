<?php

namespace App\Services;

use App\Mail\InterviewScheduledMail;
use App\Models\ApplicationStatus;
use App\Models\ParentsInfo;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

            $father = ParentsInfo::where('child_id', $child)->where('type_id', 1)->first();
            $mother = ParentsInfo::where('child_id', $child)->where('type_id', 2)->first();

            $emails = array_filter([
                optional($father)->email,
                optional($mother)->email,
            ]);

            if (!empty($emails)) {
                Mail::to($emails)->send(new InterviewScheduledMail($schedule));
            }

            $textMessage = "This is to inform you that your child is scheduled for an interview at the Taguig Yakap Center on {$data['scheduled_date']}. Kindly ensure their attendance. Thank you.";

            $mobiles = array_filter([
                optional($father)->contact_number,
                optional($mother)->contact_number,
            ]);

            foreach ($mobiles as $mobile) {
                $message = urlencode($textMessage);
                $url = "https://tagatext.taguig.gov.ph/api/sms/c18b09e4-29e8-4b2d-b034-61c9830cc403/{$mobile}/{$message}";
                
                $response = Http::get($url);

                if (!$response->successful()) {
                    \Log::error("Failed to send SMS to {$mobile}: " . $response->body());
                }
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