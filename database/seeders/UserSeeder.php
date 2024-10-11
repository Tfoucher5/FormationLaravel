<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'utilisateur admin existe déjà
        $admin = User::firstOrCreate(
            ['email' => 'theonicolas.foucher@gmail.com'],
            [
                'prenom' => 'Theo',
                'nom' => 'Foucher',
                'password' => Hash::make('totototo'),
            ]
        );

        // Assigner les permissions à l'utilisateur admin
        Bouncer::allow('admin')->to([
            'create-motif',
            'view-motif',
            'edit-motif',
            'delete-motif',
            'create-absence',
            'view-absence',
            'edit-absence',
            'delete-absence',
            'create-user',
            'view-user',
            'edit-user',
            'delete-user',
        ]);

        // Vérifier si l'utilisateur salarié existe déjà
        $salarie = User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'prenom' => 'User',
                'nom' => 'Test',
                'password' => Hash::make('totototo'),
            ]
        );

        Bouncer::allow('salarie')->to([
            'create-absence',
            'view-absence',
            'edit-absence',
        ]);

        Bouncer::assign('admin')->to($admin);
        Bouncer::assign('salarie')->to($salarie);

        // Créer d'autres utilisateurs si nécessaire
        User::factory()->count(10)->create();
    }
}
