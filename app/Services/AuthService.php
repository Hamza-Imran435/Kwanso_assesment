<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function login($request)
    {
        $user = User::where('email', $request['email'])->first();
        if ($user && Hash::check($request['password'], $user->password)) {
            Auth::login($user);
            session()->put('UserLoggIn', value: 1);
            return redirect()->route(route: 'dashboard')->with('success', 'Logged in successfully.');
        } else {
            return back()->withErrors(['email' => 'Email or Password entered is incorrect.']);
        }
    }
}
