<?php

namespace Tests\Feature;

use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_view_users_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.index'));

        $response->assertRedirect();
        $this->assertTrue(session()->has('message'));
        $this->assertEquals(__('no_authorization'), session()->get('message'));
    }

    public function test_non_admin_cannot_view_user_creation_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.create'));

        $response->assertRedirect();
        $this->assertTrue(session()->has('message'));
        $this->assertEquals(__('no_authorization'), session()->get('message'));
    }

    public function test_admin_can_view_user_creation_form()
    {
        $admin = User::factory()->create();
        $admin->assign('admin');

        $response = $this->actingAs($admin)->get(route('user.create'));

        $response->assertStatus(200)
                 ->assertViewIs('user.create');
    }

    public function test_admin_can_store_new_user()
    {
        $admin = User::factory()->create();
        $admin->assign('admin');
    
        $response = $this->actingAs($admin)->post(route('user.store'), [
            'email' => 'testuser@example.com',
            'prenom' => 'Test',
            'nom' => 'User',
            'password' => 'password',
            'password_confirmation' => 'password', // Ajoutez cette ligne
        ]);        
    
        $response->assertRedirect(route('user.index'));
        // Vérifiez que l'utilisateur a été créé
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'prenom' => 'Test',
            'nom' => 'User',
        ]);
    }    

    public function test_admin_can_view_user_details()
    {
        $admin = User::factory()->create();
        $admin->assign('admin');
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->get(route('user.show', $user->id));

        $response->assertStatus(200)
                 ->assertViewIs('user.show');// Vérifiez que l'email est bien affiché
    }

    public function test_non_admin_cannot_view_user_details()
    {
        $nonAdmin = User::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($nonAdmin)->get(route('user.show', $user->id));

        $response->assertRedirect();
        $this->assertTrue(session()->has('message'));
        $this->assertEquals(__('no_authorization'), session()->get('message'));
    }

    public function test_admin_can_delete_user_if_no_absences()
    {
        $admin = User::factory()->create();
        $admin->assign('admin');
        $user = User::factory()->create();
    
        $response = $this->actingAs($admin)->delete(route('user.destroy', $user));
    
        // Vérifiez que la redirection se fait vers la page des utilisateurs
        $response->assertRedirect(route('user.index'));
    
        // Vérifiez que l'utilisateur a été soft supprimé de la base de données
        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);
    }
     
    
    public function test_admin_cannot_delete_user_with_absences()
    {
        $admin = User::factory()->create();
        $admin->assign('admin');
    
        $motif = Motif::factory()->create([
            'id' => 1,
            'libelle' => 'Motif de test',
            'is_accessible_salarie' => true,
        ]);
    
        // Créez un utilisateur
        $user = User::factory()->create();
    
        // Créez une absence associée à cet utilisateur
        $user->absences()->create([
            'motif_id' => $motif->id,
            'date_debut' => now(),
            'date_fin' => now()->addDays(5),
        ]);
    
        // Tentez de supprimer l'utilisateur
        $response = $this->actingAs($admin)->delete(route('user.destroy', $user->id));
    
        // Vérifiez que la redirection est correcte
        $response->assertRedirect(route('user.index'));
    
        // Vérifiez que l'utilisateur n'a pas été supprimé
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }
    
    public function test_admin_can_restore_user()
    {
        $admin = User::factory()->create();
        $admin->assign('admin');
        $user = User::factory()->create(['deleted_at' => now()]);
    
        // Changer la méthode de post à get
        $response = $this->actingAs($admin)->get(route('user.restore', $user->id));
    
        $response->assertRedirect(route('user.index'));
        // Vérifiez que l'utilisateur a été restauré
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null,
        ]);
    }
    
}
