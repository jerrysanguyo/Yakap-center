<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OtpRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $ip = request()->ip();
        $browser = request()->header('User-Agent');

        try {
            $user = $this->loginService->authenticate($request->validated());

            if (!$user->email_verified_at) {
                $this->loginService->otpSent($user);

                return redirect()
                    ->route('otp.index', $user->id)
                    ->with('failed', 'You have to verify your email first. An OTP has been sent to your registered email and contact number.');
            }

            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->log('User ' . $user->first_name . ' ' . $user->last_name . " logged in successfully. ({$ip} - {$browser})");

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.dashboard')
                ->with('success', 'Logged in successfully!');
        } catch (AuthenticationException $e) {
            activity()
                ->log("Failed login attempt: ({$ip} - {$browser})");

            return redirect()
                ->route('login.index')
                ->with('failed', 'Invalid login credentials.');
        }
    }

    public function logout()
    {
        $ip = request()->ip();
        $browser = request()->header('User-Agent');
        
        $user = Auth::user();
        
        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->log('User'. $user->first_name .' '. $user->last_name . " logged out successfully. ({$ip} - {$browser})");
        
        $this->loginService->logout(); 

        return redirect()
            ->route('login.index')
            ->with('success', 'You have successfully logged out!');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function registrationStore(RegistrationRequest $request)
    {
        $ip = request()->ip();
        $browser = request()->header('User-Agent');

        $registration = $this->loginService->register($request->validated());

        activity()
            ->performedOn($registration)
            ->causedBy($registration)
            ->log('User '. $registration->first_name .' '. $registration->last_name . " registered successfully. ({$ip} - {$browser})");

        return redirect()
            ->route('otp.index', $registration->id)
            ->with('success', 'Registration successful! Kindly enter the otp sent to your email and contact number to complete the registration.');
    }

    public function verifyOtp(User $user)
    {
        return view('auth.otpConfirm', compact('user'));
    }

    public function OtpVerification(User $user, OtpRequest $request)
    {
        $verify = $this->loginService->verifyOtp($request->validated(), $user);

        if($verify) {
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->log('User '. $user->first_name .' '. $user->last_name . " verified OTP successfully.");

            return redirect()
                ->route('login.index')
                ->with('success', 'OTP verified successfully! You can now log in.');
        } else {
            return redirect()
                ->back()
                ->with('failed', 'Invalid OTP. Please try again.');
        }
    }
}
