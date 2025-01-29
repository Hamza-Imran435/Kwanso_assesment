<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ValidLoginRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login()
    {
        return Session::get('UserLoggIn') == 1 ? redirect()->route('dashboard') : view('Auth/login');
    }

    public function loginSubmit(ValidLoginRequest $request): RedirectResponse
    {
        $response = $this->authService->login($request->all());

        return $response;
    }

    public function dashboard(): View
    {
        $user = auth()->user();
        return view('Auth/dashboard', compact('user'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->forget('UserLoggIn');
        return redirect()->route('login')->with('success', 'Log out successfully');
    }
}
