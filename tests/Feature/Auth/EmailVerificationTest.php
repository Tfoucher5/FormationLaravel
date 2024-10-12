<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test si l'écran de vérification d'email peut être rendu.
     */
    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200); // Vérifie que la page se rend avec succès (200 OK)
    }

    /**
     * Test si l'email peut être vérifié avec succès.
     */
    public function test_email_can_be_verified(): void
    {
        $user = User::factory()->unverified()->create();

        // Fait un "fake" pour l'événement Verified
        Event::fake();

        // Crée une URL de vérification temporaire
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60), // Lien valide pendant 60 minutes
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Fait une requête GET vers l'URL de vérification
        $response = $this->actingAs($user)->get($verificationUrl);

        // S'assure que l'événement Verified a été déclenché
        Event::assertDispatched(Verified::class);

        // Vérifie que l'utilisateur a bien vérifié son email
        $this->assertTrue($user->fresh()->hasVerifiedEmail());

        // Vérifie la redirection vers le dashboard avec un paramètre `verified=1`
        $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    }

    /**
     * Test si l'email n'est pas vérifié avec un hash invalide.
     */
    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $user = User::factory()->unverified()->create();

        // Crée une URL de vérification temporaire mais avec un mauvais hash
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')] // Hash incorrect
        );

        // Effectue la requête avec l'URL invalide
        $this->actingAs($user)->get($verificationUrl);

        // Vérifie que l'utilisateur n'a toujours pas vérifié son email
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
