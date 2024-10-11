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

    protected $table = 'motifs';

    protected $fillable = ['libelle', 'is_accessible_salarie'];

    public function absences()
    {
        return $this->hasMany(Absence::class, 'motif_id');
    }

    protected $casts = [
        'is_accessible_salarie' => 'boolean',
    ];

}
