<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Absence;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $absence;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Absence $absence
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
            view: 'mails.absenceValidated', // Vue du mail
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
