<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Models\User;
use App\Models\Absence;
use App\Mail\AbsenceValidatedMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;

class AbsenceValidatedMailControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $absence;
    protected $mail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'prenom' => 'John',
            'nom' => 'Doe',
            'email' => 'john@example.com'
        ]);
        $this->absence = Absence::factory()->create(['user_id' => $this->user->id]);
        $this->mail = new AbsenceValidatedMail($this->user, $this->absence);

        // Mock the View facade globally for all tests
        View::shouldReceive('make')
            ->withAnyArgs()
            ->andReturn(new class {
                public function render()
                {
                    return 'Mocked view content';
                }
            });
    }

    public function test_envelope()
    {
        $envelope = $this->mail->envelope();

        $this->assertEquals('Votre absence a été validée', $envelope->subject);
    }

    public function test_content()
    {
        $content = $this->mail->content();

        $this->assertEquals('mails.absenceValidated', $content->view);
    }

    public function test_attachments()
    {
        $this->assertEmpty($this->mail->attachments());
    }

    public function test_mailable_content()
    {
        $renderedView = $this->mail->render();

        $this->assertEquals('Mocked view content', $renderedView);
    }

    public function test_mailable_contains_correct_data()
    {
        $this->assertEquals($this->user->id, $this->mail->user->id);
        $this->assertEquals($this->absence->id, $this->mail->absence->id);
    }
}
