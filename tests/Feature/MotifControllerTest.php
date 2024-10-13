<?php

namespace Tests\Feature;

use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Bouncer;

class MotifControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test si l'utilisateur admin peut accéder à la liste des motifs.
     */
    public function test_index_as_admin(): void
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin); // Assigner le rôle d'admin

        $this->actingAs($admin)
            ->get('/motif')
            ->assertStatus(200)
            ->assertViewIs('motif.index');
    }

    /**
     * Test si l'utilisateur non admin ne peut pas accéder à la liste des motifs.
     */
    public function test_index_as_non_admin(): void
    {
        $user = User::factory()->create(); // Non-admin

        $this->actingAs($user)
            ->get('/motif')
            ->assertRedirect()
            ->assertSessionHas('message', __('no_authorization'));
    }

    /**
     * Test si la création d'un motif est accessible pour un admin.
     */
    public function test_create_as_admin(): void
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin); // Assigner le rôle d'admin

        $this->actingAs($admin)
            ->get('/motif/create')
            ->assertStatus(200)
            ->assertViewIs('motif.create');
    }

    /**
     * Test si la création d'un motif n'est pas accessible pour un non-admin.
     */
    public function test_create_as_non_admin(): void
    {
        $user = User::factory()->create(); // Non-admin

        $this->actingAs($user)
            ->get('/motif/create')
            ->assertRedirect()
            ->assertSessionHas('message', __('no_authorization'));
    }

    /**
     * Test pour stocker un motif avec succès pour un admin.
     */
    public function test_store_as_admin(): void
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin); // Assigner le rôle d'admin

        $motifData = [
            'libelle' => 'Motif test',
            'is_accessible_salarie' => true,
        ];

        $this->actingAs($admin)
            ->post('/motif', $motifData)
            ->assertRedirect('/motif');

        $this->assertDatabaseHas('motifs', [
            'libelle' => 'Motif test',
        ]);
    }

    /**
     * Test si la mise à jour d'un motif fonctionne pour un admin.
     */
    public function test_update_as_admin(): void
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin); // Assigner le rôle d'admin

        $motif = Motif::factory()->create();

        $updateData = [
            'libelle' => 'Motif updated',
            'is_accessible_salarie' => false,
        ];

        $this->actingAs($admin)
            ->put("/motif/{$motif->id}", $updateData)
            ->assertRedirect('/motif');

        $this->assertDatabaseHas('motifs', [
            'id' => $motif->id,
            'libelle' => 'Motif updated',
        ]);
    }

    /**
     * Test si la suppression d'un motif fonctionne pour un admin.
     */
    public function test_destroy_as_admin(): void
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin); // Assigner le rôle d'admin

        $motif = Motif::factory()->create();

        $this->actingAs($admin)
            ->delete("/motif/{$motif->id}")
            ->assertRedirect('/motif');

        $this->assertSoftDeleted('motifs', [
            'id' => $motif->id,
        ]);
    }

    /**
     * Test si la restauration d'un motif fonctionne pour un admin.
     */
    public function test_restore_as_admin(): void
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin); // Assigner le rôle d'admin

        $motif = Motif::factory()->create();
        $motif->delete(); // Supprimer le motif (soft delete)

        $this->actingAs($admin)
            ->get("/motif/{$motif->id}/restore")
            ->assertRedirect('/motif');

        // Vérifier l'état du motif dans la base de données après restauration
        $this->assertDatabaseHas('motifs', [
            'id' => $motif->id,
            'deleted_at' => null, // Vérifie que is_validated est null après restauration
        ]);

        // Assurez-vous que le motif n'est plus marqué comme supprimé
        $this->assertFalse(Motif::withTrashed()->find($motif->id)->trashed());
    }
}
