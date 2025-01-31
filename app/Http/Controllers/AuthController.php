<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignUpVerificationRequest;
use App\Http\Requests\Auth\ValidLoginRequest;
use App\Models\Invite;
use App\Models\Task;
use App\Models\User;
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

        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'Client');
        })->count();

        $tasks = Task::count();

        $invitesCount = Invite::selectRaw('status, COUNT(*) as count')
            ->whereIn('status', [0, 1])
            ->groupBy('status')
            ->pluck('count', 'status');

        $invitesAccepted = $invitesCount[1] ?? 0;
        $invitesPending = $invitesCount[0] ?? 0;

        return view('Auth/dashboard', compact('user', 'clients', 'tasks', 'invitesAccepted', 'invitesPending'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->forget('UserLoggIn');
        return redirect()->route('login')->with('success', 'Log out successfully');
    }

    public function signUp(SignUpVerificationRequest $request)
    {
        $response = $this->authService->signUp($request->all());

        return $response;
    }

    public function index()
    {
        return view('Auth.customer.index');
    }

    public function clientList(Request $request)
    {
        $response = $this->authService->customerList($request->all());

        return $response;
    }


    public function clientDetail($id)
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        $customer = $this->authService->customerDetail($id);

        return view('Auth.customer.detail', compact('customer', 'tasks'));
    }
}
