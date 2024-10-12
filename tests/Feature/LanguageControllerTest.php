<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\User;  // Assurez-vous d'importer le modèle User

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test que la langue change correctement.
     *
     * @return void
     */
    public function test_language_change()
    {
        // Simule un utilisateur connecté, en utilisant la bonne méthode de fabrique
        $this->actingAs(User::factory()->create());

        // Test de changement vers la langue anglaise
        $response = $this->post(route('language.change'), [
            'language' => 'en',
        ]);

        // Vérifie que la session contient bien la clé 'locale' avec la valeur 'en'
        $this->assertEquals('en', session('locale'));

        // Vérifie la redirection vers la page précédente
        $response->assertRedirect();

        // Test de changement vers la langue française
        $response = $this->post(route('language.change'), [
            'language' => 'fr',
        ]);

        // Vérifie que la session contient bien la clé 'locale' avec la valeur 'fr'
        $this->assertEquals('fr', session('locale'));

        // Vérifie la redirection vers la page précédente
        $response->assertRedirect();
    }

    /**
     * Test de validation pour la langue invalide.
     *
     * @return void
     */
    public function test_invalid_language_change()
    {
        // Test avec une langue invalide
        $response = $this->post(route('language.change'), [
            'language' => 'es', // Langue invalide
        ]);

        // Vérifie que la validation échoue et retourne une erreur
        $response->assertSessionHasErrors('language');
    }
}
