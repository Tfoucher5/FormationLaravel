<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccueilControllerTest extends TestCase
{
    // Utilise RefreshDatabase si nécessaire
    use RefreshDatabase;

    /**
     * Teste que la méthode index du contrôleur retourne bien la vue welcome.
     *
     * @return void
     */
    public function it_returns_the_welcome_view()
    {
        // Effectue une requête GET sur la route d'accueil '/'
        $response = $this->get('/');

        // Vérifie que la réponse est un succès (200 OK)
        $response->assertStatus(200);

        // Vérifie que la vue retournée est bien 'welcome'
        $response->assertViewIs('welcome');
    }
}
