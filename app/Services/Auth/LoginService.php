<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

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
        $register = User::create($data);

        return $register;
    }
}