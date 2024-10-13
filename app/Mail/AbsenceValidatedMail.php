<?php

namespace App\Mail;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\User
     */
    public User $user;

    /**
     * @var \App\Models\Absence
     */
    public Absence $absence;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Absence $absence)
    {
        $this->user = $user;
        $this->absence = $absence;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre absence a été validée',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.absenceValidated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
