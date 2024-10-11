<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Motif;
use App\Models\Absence;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbsenceMail;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AbsenceMailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_mail_sends_correctly()
    {
        // Fake le mail pour éviter son envoi réel
        Mail::fake();

        // Création d'un utilisateur, motif, et absence
        $user = User::factory()->create();
        $motif = Motif::factory()->create();
        $absence = Absence::factory()->create(['user_id' => $user->id]);

        // Envoi du mail
        $mail = new AbsenceMail($user, $motif, $absence);
        Mail::to($user)->send($mail);

        // Vérifier que le mail a bien été envoyé
        Mail::assertSent(AbsenceMail::class, function ($mail) use ($user, $motif, $absence) {
            return $mail->hasTo($user->email) &&
                   $mail->user->id === $user->id &&
                   $mail->motif->id === $motif->id &&
                   $mail->absence->id === $absence->id;
        });

        // Test du constructeur
        $this->assertEquals($user, $mail->user);
        $this->assertEquals($motif, $mail->motif);
        $this->assertEquals($absence, $mail->absence);

        // Test de l'enveloppe
        $envelope = $mail->envelope();
        $this->assertEquals('Nouvelle absence d\'un salarié', $envelope->subject);

        // Test du contenu
        $content = $mail->content();
        $this->assertEquals('mails.newAbsence', $content->view);

        // Test des pièces jointes
        $attachments = $mail->attachments();
        $this->assertEmpty($attachments);
    }

    // Test de la méthode envelope
    public function test_envelope_method()
    {
        $user = User::factory()->create();
        $motif = Motif::factory()->create();
        $absence = Absence::factory()->create(['user_id' => $user->id]);

        $mail = new AbsenceMail($user, $motif, $absence);
        $envelope = $mail->envelope();

        $this->assertEquals('Nouvelle absence d\'un salarié', $envelope->subject);
    }

    // Test de la méthode content
    public function test_content_method()
    {
        $user = User::factory()->create();
        $motif = Motif::factory()->create();
        $absence = Absence::factory()->create(['user_id' => $user->id]);

        $mail = new AbsenceMail($user, $motif, $absence);
        $content = $mail->content();

        $this->assertEquals('mails.newAbsence', $content->view);
    }

    // Test de la méthode attachments
    public function test_attachments_method()
    {
        $user = User::factory()->create();
        $motif = Motif::factory()->create();
        $absence = Absence::factory()->create(['user_id' => $user->id]);

        $mail = new AbsenceMail($user, $motif, $absence);
        $attachments = $mail->attachments();

        $this->assertEmpty($attachments);
    }
}
