<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Motif;
use App\Models\Absence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the environment for each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Créer des utilisateurs pour les tests
        $admin = User::factory()->create([
            'prenom' => 'Admin',
            'nom' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assignation du rôle 'admin' à l'utilisateur
        Bouncer::assign('admin')->to($admin);

        $user = User::factory()->create([
            'prenom' => 'Regular',
            'nom' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assignation du rôle 'user' à cet utilisateur
        Bouncer::assign('user')->to($user);

        $this->admin = $admin;
        $this->user = $user;
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_can_access_users_index()
    {
        $response = $this->actingAs($this->admin)
                         ->get(route('user.index'));

        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertViewHas('users');
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function non_admin_cannot_access_users_index()
    {
        $response = $this->actingAs($this->user)
                         ->get(route('user.index'));

        $response->assertStatus(302);
        $response->assertRedirect();
        $this->assertEquals(__('no_authorization'), Session::get('message'));
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_can_view_user_create_form()
    {
        $response = $this->actingAs($this->admin)
                         ->get(route('user.create'));

        $response->assertStatus(200);
        $response->assertViewIs('user.create');
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function non_admin_cannot_view_user_create_form()
    {
        $response = $this->actingAs($this->user)
                         ->get(route('user.create'));

        $response->assertStatus(302);
        $response->assertRedirect();
        $this->assertEquals(__('no_authorization'), Session::get('message'));
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_can_store_user()
    {
        $response = $this->actingAs($this->admin)
                         ->post(route('user.store'), [
                             'prenom' => 'New',
                             'nom' => 'User',
                             'email' => 'newuser@example.com',
                             'password' => 'password',
                         ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
        ]);
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function non_admin_cannot_store_user()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('user.store'), [
                             'prenom' => 'New',
                             'nom' => 'User',
                             'email' => 'newuser@example.com',
                             'password' => 'password',
                         ]);

        $response->assertStatus(302);
        $response->assertRedirect();
        $this->assertEquals(__('no_authorization'), Session::get('message'));
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_can_view_user_show()
    {
        $response = $this->actingAs($this->admin)
                         ->get(route('user.show', $this->user->id));

        $response->assertStatus(200);
        $response->assertViewIs('user.show');
        $response->assertViewHas('user');
        $response->assertViewHas('motifs');
        $response->assertViewHas('absences');
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function non_admin_cannot_view_user_show()
    {
        $response = $this->actingAs($this->user)
                         ->get(route('user.show', $this->admin->id));

        $response->assertStatus(302);
        $response->assertRedirect();
        $this->assertEquals(__('no_authorization'), Session::get('message'));
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_can_delete_user_with_no_absences()
    {
        $response = $this->actingAs($this->admin)
                         ->delete(route('user.destroy', $this->user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
        ]);
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_cannot_delete_user_with_absences()
    {
        $absence = Absence::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->admin)
                         ->delete(route('user.destroy', $this->user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));
        $this->assertEquals(__('element_still_used'), Session::get('message'));
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
        ]);
    }

    #[\PHPUnit\Framework\Attribute\Test]
    public function admin_can_restore_deleted_user()
    {
        $this->user->delete();

        $response = $this->actingAs($this->admin)
                         ->post(route('user.restore', $this->user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'deleted_at' => null,
        ]);
    }
}
