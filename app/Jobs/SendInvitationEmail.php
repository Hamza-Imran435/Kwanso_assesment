<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use App\Models\Invite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendInvitationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $invite;
    /**
     * Create a new job instance.
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->invite->email)->send(new InvitationMail($this->invite));
    }
}
