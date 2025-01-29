<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $invite;
    /**
     * Create a new message instance.
     */
    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    public function build()
    {
        return $this->subject('You are invited!')
            ->view('Mail.invitation')
            ->with([
                'inviteLink' => env('APP_URL') . '/invitations/accept/' . $this->invite->token,

            ]);
    }
}
