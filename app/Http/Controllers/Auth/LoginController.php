<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->log('User '. $user->first_name .' '. $user->last_name . " logged in successfully. ({$ip} - {$browser})");
    
            return redirect()
                ->route('superadmin.dashboard')
                ->with('success', 'Logged in successfully!');
        } catch (AuthenticationException $e) {
            activity()
                ->log("Failed login attempt: ({$ip} - {$browser})");
    
            return redirect()
                ->route('login')
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
}
