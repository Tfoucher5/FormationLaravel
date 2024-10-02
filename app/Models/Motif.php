<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * @property int $id
 * @property string $libelle
 * @property int $is_accessible_salarie
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Ability> $abilities
 * @property-read int|null $abilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absence> $absences
 * @property-read int|null $absences_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Role> $roles
 * @property-read int|null $roles_count
 *
 * @method static \Database\Factories\MotifFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Motif newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif query()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereIs($role)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereIsAccessibleSalarie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereIsAll($role)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereIsNot($role)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Motif extends Model
{
    use HasFactory;
    use HasRolesAndAbilities;
    use softDeletes;

    public function absences()
    {
        return $this->hasMany(Absence::class, 'motif_id');
    }

    protected function casts(): array
    {
        return [
            'is-accessible-salarie' => 'boolean',
        ];
    }

    //
    //RECUPERATION
    //

    // public function getToutAvecEloquent()
    // {
    //     return Motif::all();
    // }

    // public function getAvecFiltresSimples($clausewhere)
    // {
    //     return Motif::where('Libelle', $clausewhere)->get();
    // }

    // public function getAvecFiltresSimplesMultiples($clausewhere)
    // {
    //     return Motif::where([
    //         'colonne1' => $clausewhere[0],
    //         'colonne2' => $clausewhere[1],
    //     ]);
    // }

    //
    //CREATE
    //

    // public function create()
    // {
    //     $te = new Motif();

    //     $te->colonne1= 'ceci';
    //     $te->colonne2= 'cela';

    //     $te->save();
    // }

    // public function create()
    // {
    //     DB::table('tests')->insert([
    //         'colonne1' => 'ceci',
    //         'colonne2' => 'cela',
    //     ]);
    // }

    //
    //MODIFICATION
    //

    // public function update($id)
    // {
    //     $te = Motif::find($id);

    //     $te->colonne1= 'ceci';
    //     $te->colonne2= 'cela';

    //     $te->save();
    // }

    // public function update($id)
    // {
    //     DB::table('tests')->insert([
    //         'colonne1' => 'ceci',
    //         'colonne2' => 'cela',
    //     ])->where('id', $id);
    // }

    //
    //DELETE
    //

    // public function delete($id)
    // {
    //     DB::table('tests')
    //     ->where('id', $id)
    //     ->delete();
    // }

    //
    //JOINTURES
    //

    // public function essai()
    // {
    //     $liste = DB::table('tests')
    //     ->join('essaus', 'tests.id', '=', 'essais.test_id')
    //     ->select('tests.*', 'essais.col1', 'essais.col2')
    //     ->get();
    // }

    // public function test()
    // {
    //     return $this->belongsTo(Test::class);
    // }
    // -----------------------------------------------
    // public function essais()
    // {
    //     return $this->hasMany(Essai::class);
    // }
}
