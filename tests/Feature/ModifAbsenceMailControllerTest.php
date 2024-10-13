<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Motif;
use App\Models\Absence;
use Illuminate\Support\Facades\Mail;
use App\Mail\ModifAbsenceMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;

class ModifAbsenceMailControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $motif;
    protected $absence;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['prenom' => 'John', 'nom' => 'Doe']);
        $this->motif = Motif::factory()->create(['libelle' => 'Congé', 'is_accessible_salarie' => true]);
        $this->absence = Absence::factory()->create([
            'user_id' => $this->user->id,
            'motif_id' => $this->motif->id,
            'date_debut' => '2023-06-01',
            'date_fin' => '2023-06-05'
        ]);

        View::addLocation(resource_path('views'));
    }

    public function test_modif_absence_mail_is_sent()
    {
        Mail::fake();

        $mail = new ModifAbsenceMail($this->user, $this->motif, $this->absence);
        Mail::to($this->user)->send($mail);

        Mail::assertSent(ModifAbsenceMail::class, function ($mail) {
            return $mail->hasTo($this->user->email) &&
                   $mail->user->id === $this->user->id &&
                   $mail->motif->id === $this->motif->id &&
                   $mail->absence->id === $this->absence->id;
        });

        $this->assertEquals($this->user, $mail->user);
        $this->assertEquals($this->motif, $mail->motif);
        $this->assertEquals($this->absence, $mail->absence);

        $envelope = $mail->envelope();
        $this->assertEquals('Une absence a été modifiée', $envelope->subject);

        $content = $mail->content();
        $this->assertEquals('mails.modifAbsence', $content->view);

        $attachments = $mail->attachments();
        $this->assertEmpty($attachments);
    }
}
