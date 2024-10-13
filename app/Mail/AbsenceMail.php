<?php

namespace App\Mail;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\User
     */
    public User $user;

    /**
     * @var \App\Models\Motif
     */
    public Motif $motif;

    /**
     * @var \App\Models\Absence
     */
    public Absence $absence;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Motif $motif, Absence $absence)
    {
        $this->user = $user;
        $this->motif = $motif;
        $this->absence = $absence;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle absence d\'un salarié',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.newAbsence', // Créez une vue `newAbsence.blade.php`
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
