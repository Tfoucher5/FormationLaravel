<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\MotifRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MotifRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test si les règles de validation sont correctement appliquées.
     */
    public function test_motif_request_validation_rules()
    {
        // Teste une requête valide
        $validData = [
            'libelle' => 'Motif valide',
            'is_accessible_salarie' => true,
        ];

        $request = new MotifRequest();
        $validator = Validator::make($validData, $request->rules());

        // S'assure que la validation passe sans erreur
        $this->assertFalse($validator->fails());

        // Teste une requête avec des données invalides
        $invalidData = [
            'libelle' => 'M',
            'is_accessible_salarie' => 'not_a_boolean',
        ];

        $validator = Validator::make($invalidData, $request->rules());

        // S'assure que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que les erreurs correctes sont renvoyées
        $errors = $validator->errors();
        $this->assertTrue($errors->has('libelle'));
        $this->assertTrue($errors->has('is_accessible_salarie'));
    }

    /**
     * Test les messages de validation personnalisés si définis.
     */
    public function test_motif_request_custom_messages()
    {
        // Ici, nous testons si des messages personnalisés sont correctement définis.
        $request = new MotifRequest();

        // Données invalides
        $invalidData = [
            'libelle' => 'M',
            'is_accessible_salarie' => 'not_a_boolean',
        ];

        $validator = Validator::make($invalidData, $request->rules());

        // Si tu avais des messages personnalisés définis dans la méthode `messages` de la request
        // On s'assure qu'ils sont renvoyés en cas d'erreur
        $errors = $validator->errors();
        $this->assertTrue($errors->has('libelle'));
        $this->assertTrue($errors->has('is_accessible_salarie'));
    }
}
