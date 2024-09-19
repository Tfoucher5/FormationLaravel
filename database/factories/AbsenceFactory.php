<?php

namespace Database\Factories;

use App\Models\Motif;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Récupérer un utilisateur et un motif aléatoires
        $user = User::inRandomOrder()->first();
        $motif = Motif::inRandomOrder()->first();

        // Générer les dates de début et de fin
        $dateDebut = Carbon::now()->addDays(random_int(0, 30));
        $dateFin = (clone $dateDebut)->addDays(random_int(1, 7));

        return [
            'motif_id' => $motif->id,
            'user_id' => $user->id,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ];
    }
}
