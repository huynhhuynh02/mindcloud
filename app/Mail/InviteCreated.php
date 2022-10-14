<?php

namespace App\Mail;

use App\Models\Invite;
use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite, Organization $organization)
    {
        $this->invite = $invite;
        $this->organization = $organization;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'huynhhuynh02@gmail.com'))
            ->subject($this->organization->name." invited you to MindCloud")
            ->markdown(
                'mails.invite_user',[
                    'invite' => $this->invite,
                    'organization' => $this->organization,
                ]
            );
    }
}
