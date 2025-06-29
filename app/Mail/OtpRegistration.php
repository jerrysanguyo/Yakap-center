<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    protected $cityLogoCid;
    protected $yakapLogoCid;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Your Registration OTP')
                    ->withSwiftMessage(function ($message) {
                        $this->cityLogoCid = $message->embed(public_path('images/city_logo.webp'));
                        $this->yakapLogoCid = $message->embed(public_path('images/logoyakap.webp'));
                    })
                    ->markdown('emails.otp')
                    ->with([
                        'otp' => $this->otp,
                        'cityLogoCid' => $this->cityLogoCid,
                        'yakapLogoCid' => $this->yakapLogoCid,
                    ]);
    }
}