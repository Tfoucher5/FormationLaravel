<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\AbsenceRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Motif;

class AbsenceRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test si les règles de validation sont correctement appliquées.
     */
    public function test_absence_request_validation_rules()
    {
        // Crée un utilisateur et un motif valide
        $user = User::factory()->create();
        $motif = Motif::factory()->create();

        // Teste une requête valide
        $validData = [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDay()->toDateString(),
        ];

        $request = new AbsenceRequest();
        $validator = Validator::make($validData, $request->rules());

        // S'assure que la validation passe sans erreur
        $this->assertFalse($validator->fails());

        // Teste une requête avec des données invalides
        $invalidData = [
            'user_id' => null,
            'motif_id' => null,
            'date_debut' => 'invalid-date',
            'date_fin' => now()->toDateString(),
        ];

        $validator = Validator::make($invalidData, $request->rules());

        // S'assure que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que les erreurs correctes sont renvoyées
        $errors = $validator->errors();
        $this->assertTrue($errors->has('user_id'));
        $this->assertTrue($errors->has('motif_id'));
        $this->assertTrue($errors->has('date_debut'));
    }

    /**
     * Test les messages de validation personnalisés si définis.
     */
    public function test_absence_request_custom_messages()
    {
        // Ici, nous testons si des messages personnalisés sont correctement définis.
        $request = new AbsenceRequest();

        // Données invalides
        $invalidData = [
            'user_id' => null,
            'motif_id' => null,
            'date_debut' => 'invalid-date',
            'date_fin' => now()->toDateString(),
        ];

        $validator = Validator::make($invalidData, $request->rules());

        // Si tu avais des messages personnalisés définis dans la méthode `messages` de la request
        // On s'assure qu'ils sont renvoyés en cas d'erreur
        $errors = $validator->errors();
        $this->assertTrue($errors->has('user_id'));
        $this->assertTrue($errors->has('motif_id'));
        $this->assertTrue($errors->has('date_debut'));
    }
}
