<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * @property int $id
 * @property int $user_id
 * @property int $motif_id
 * @property string $date_debut
 * @property string $date_fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $is_verified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Ability> $abilities
 * @property-read int|null $abilities_count
 * @property-read \App\Models\Motif $motif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\AbsenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Absence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence query()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereIs($role)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereIsAll($role)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereIsNot($role)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereMotifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Absence extends Model
{
    /**
     * 
     * @use HasFactory<\Database\Factories\AbsenceFactory>
     */
    use HasFactory;
    use HasRolesAndAbilities;
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $dates = ['date_fin', 'date_debut'];

    protected $fillable = ['motif_id', 'user_id', 'date_debut', 'date_fin'];

    // Définir la relation avec l'utilisateur
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, \App\Models\Absence>
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Définir la relation avec le motif
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Motif, \App\Models\Absence>
     */
    public function motif(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Motif::class, 'motif_id');
    }
}
