<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Absence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class AbsenceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test si un administrateur peut accéder à la liste des absences (index).
     */
    public function test_admin_can_view_absences_index()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->get(route('absence.index'))
            ->assertStatus(200)
            ->assertViewIs('absence.index'); // Mise à jour du nom de la vue
    }

    /**
     * Test si un administrateur peut voir les détails d'une absence (show).
     */
    public function test_admin_can_view_absence_details()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $absence = Absence::factory()->create();

        $this->actingAs($admin)
            ->get(route('absence.show', $absence->id))
            ->assertStatus(200)
            ->assertViewIs('absence.show') // Mise à jour du nom de la vue
            ->assertSee($absence->id);
    }

    /**
     * Test si un administrateur peut voir le formulaire de création d'une absence (create).
     */
    public function test_admin_can_view_absence_create_form()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->get(route('absence.create'))
            ->assertStatus(200)
            ->assertViewIs('absence.create'); // Mise à jour du nom de la vue
    }

    /**
     * Test si un administrateur peut voir le formulaire d'édition d'une absence (edit).
     */
    public function test_admin_can_view_absence_edit_form()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $absence = Absence::factory()->create(['user_id' => $admin->id]);

        $this->actingAs($admin)
            ->get(route('absence.edit', $absence->id))
            ->assertStatus(200)
            ->assertViewIs('absence.edit') // Mise à jour du nom de la vue
            ->assertSee($absence->id);
    }

    /**
     * Test si un administrateur peut valider une absence (validateAbsence).
     */
    public function test_admin_can_validate_absence()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $absence = Absence::factory()->create(['is_verified' => false]);

        $this->actingAs($admin)
            ->post(route('absence.validate', $absence->id))
            ->assertRedirect(route('absence.index')); // Vérifie que la redirection fonctionne

        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
            'is_verified' => true,
        ]);
    }

    /**
     * Test si un administrateur peut supprimer une absence (destroy).
     */
    public function test_admin_can_delete_absence()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $absence = Absence::factory()->create(['user_id' => $admin->id]);

        $this->actingAs($admin)
            ->delete(route('absence.destroy', $absence->id))
            ->assertRedirect(route('absence.index')); // Redirige vers la page d'index

        // Teste si la suppression fonctionne en soft delete
        $this->assertDatabaseMissing('absences', [
            'id' => $absence->id,
            'deleted_at' => null, // Le soft delete devrait mettre à jour ce champ
        ]);
    }

    /**
     * Test si un administrateur peut restaurer une absence supprimée (restore).
     */
    public function test_admin_can_restore_absence()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $absence = Absence::factory()->create(['user_id' => $admin->id, 'deleted_at' => now()]);

        $this->actingAs($admin)
            ->get(route('absence.restore', $absence->id))
            ->assertRedirect(route('absence.index')); // Vérifie que la redirection vers l'index fonctionne

        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
            'deleted_at' => null,  // Vérifie que l'absence a été restaurée
        ]);
    }

    /**
     * Test si un administrateur ne peut pas valider une absence qui n'existe pas.
     */
    public function test_admin_cannot_validate_nonexistent_absence()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->post(route('absence.validate', 999)) // ID d'absence qui n'existe pas
            ->assertNotFound(); // Vérifie que la réponse est 404
    }

    /**
     * Test si un administrateur ne peut pas supprimer une absence qui n'existe pas.
     */
    public function test_admin_cannot_delete_nonexistent_absence()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->delete(route('absence.destroy', 999)) // ID d'absence qui n'existe pas
            ->assertNotFound(); // Vérifie que la réponse est 404
    }

    /**
     * Test si un administrateur ne peut pas restaurer une absence qui n'existe pas.
     */
    public function test_admin_cannot_restore_nonexistent_absence()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->get(route('absence.restore', 999)) // ID d'absence qui n'existe pas
            ->assertNotFound(); // Vérifie que la réponse est 404
    }

    /**
     * Test si un administrateur ne peut pas accéder aux détails d'une absence qui n'existe pas.
     */
    public function test_admin_cannot_view_nonexistent_absence_details()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->get(route('absence.show', 999)) // ID d'absence qui n'existe pas
            ->assertNotFound(); // Vérifie que la réponse est 404
    }

    /**
     * Test si un administrateur ne peut pas voir le formulaire d'édition d'une absence qui n'existe pas.
     */
    public function test_admin_cannot_view_nonexistent_absence_edit_form()
    {
        $admin = User::factory()->create();
        Bouncer::assign('admin')->to($admin);

        $this->actingAs($admin)
            ->get(route('absence.edit', 999)) // ID d'absence qui n'existe pas
            ->assertNotFound(); // Vérifie que la réponse est 404
    }

}
