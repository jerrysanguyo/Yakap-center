<?php

namespace App\Services\Auth;

use App\Mail\OtpRegistration;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class LoginService
{
    public function authenticate(array $data): User
    {
        if($user = Auth::attempt($data))
        {
            request()->session()->regenerate();
            return Auth::user();
        }

        throw new AuthenticationException('Invalid login credentials.');
    }

    public function logout():? User
    {
        $user = Auth::user();
        Auth::logout();
        return $user;
    }

    public function register(array $data)
    {
        $register = User::updateOrCreate(
            [
                'email' => $data['email'],
                'contact_number' => $data['contact_number']
            ],
            [
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'password' => bcrypt($data['password']),
            ]
        );

        if ($register) {
            $register->assignRole('user');
            $this->otpSent($register);
        }

        return $register;
    }

    private function generateUniqueOtp(): string
    {
        do {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Otp::where('otp', $otp)->exists());

        return $otp;
    }

    public function otpSent(User $user)
    {
        $otp = $this->generateUniqueOtp();

        Otp::updateOrCreate([
            'user_id' => $user->id,
            'otp' => $otp,
            'remarks' => 'registration',
        ]);

        $message = "Thank you for registering. Here's your OTP: {$otp}";
        $mobile = $user->contact_number;
        
        $message = urlencode($message);
        $url = "https://tagatext.taguig.gov.ph/api/sms/c18b09e4-29e8-4b2d-b034-61c9830cc403/{$mobile}/{$message}";

        $response = Http::get($url);

        if (!$response->successful()) {
            \Log::error("Failed to send SMS to {$mobile}: " . $response->body());
        }

        Mail::to($user->email)->send(new OtpRegistration($otp));
    }

    public function verifyOtp(array $data, User $user)
    {
        $otpVerification = Otp::where('user_id', $user->id)
                            ->where('otp', $data['otp'])
                            ->where('remarks', 'registration')
                            ->first();
        if($otpVerification)
        {
            $otpVerification->delete();
            $user->update(['email_verified_at' => now()]);
        }

        return $otpVerification ? $user : null;
    }
}