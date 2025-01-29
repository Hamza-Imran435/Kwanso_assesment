<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\User;
use App\Services\InvitationService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function __construct(protected InvitationService $service) {}

    public function index(): View
    {
        return view('Auth.invitation.index');
    }

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $invite = $this->service->sendInvitation($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Invitation sent successfully!',
                'invite' => $invite,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send invitation: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function acceptInvitation($token)
    {
        $invite = Invite::where('token', $token)->first();

        if (!$invite) {
            return redirect()->route('login')->with('error', 'Invalid invitation link.');
        }

        if ($invite->expires_at < Carbon::now()) {
            return redirect()->route('login')->with('error', 'This invitation has expired.');
        }

        return view('Auth.signup', ['email' => $invite->email, 'token' => $invite->token]);
    }

    public function getInvitations(Request $request)
    {
        $response  = $this->service->getInvitations($request->all());

        return $response;
    }
}
