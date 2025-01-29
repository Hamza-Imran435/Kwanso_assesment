<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Services\InvitationService;
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
            'email' => 'required|email|unique:invites,email',
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
}
