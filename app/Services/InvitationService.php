<?php

namespace App\Services;

use App\Models\Invite;
use Carbon\Carbon;
use Str;

class InvitationService
{
    protected $expirationDays = 7;
    public function __construct(protected Invite $invite) {}
    public function sendInvitation($request)
    {
        $email = $request['email'];

        $invite = $this->invite->create([
            'email' => $email,
            'token' => Str::random(60),
            'expires_at' => Carbon::now()->addDays($this->expirationDays),
        ]);
    }
}
