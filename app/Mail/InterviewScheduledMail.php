<?php

namespace App\Mail;

use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $schedule;

    protected $cityLogoCid;
    protected $yakapLogoCid;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function build()
    {
        return $this->subject('Interview Schedule Notification')
                    ->withSwiftMessage(function ($message) {
                        $this->cityLogoCid = $message->embed(public_path('images/city_logo.webp'));
                        $this->yakapLogoCid = $message->embed(public_path('images/logoyakap.webp'));
                    })
                    ->markdown('emails.interview')
                    ->with([
                        'cityLogoCid' => $this->cityLogoCid,
                        'yakapLogoCid' => $this->yakapLogoCid,
                    ]);
    }
}