<?php

namespace App\Services;

use App\Jobs\SendInvitationEmail;
use App\Models\Invite;
use Carbon\Carbon;
use Str;
use Yajra\DataTables\Facades\DataTables;

class InvitationService
{
    protected $expirationDays = 7;
    public function __construct(protected Invite $invite) {}
    public function sendInvitation($request)
    {
        $email = $request['email'];

        $invite = $this->invite->updateOrCreate([
            'email' => $email,
        ], [
            'token' => \Str::random(60),
            'expires_at' => Carbon::now()->addDays($this->expirationDays),
        ]);

        info($invite->token);

        SendInvitationEmail::dispatch($invite);

        return $invite;
    }

    public function getInvitations($request)
    {
        $query = Invite::query()->orderBy('created_at', 'desc');

        $invitations = DataTables::of($query)
            ->addColumn('DT_RowIndex', function ($row) {
                static $index = 0;
                $index++;
                return $index;
            })
            ->editColumn('status', function ($invite) {
                return $invite->status == 1
                    ? '<span class="badge bg-gradient-success">Accepted</span>'
                    : '<span class="badge bg-gradient-warning">Pending</span>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);

        return $invitations;
    }
}
