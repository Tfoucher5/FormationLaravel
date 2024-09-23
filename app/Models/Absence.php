<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class Absence extends Model
{
    use HasFactory;
    use HasRolesAndAbilities;

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Définir la relation avec le motif
    public function motif()
    {
        return $this->belongsTo(Motif::class, 'motif_id');
    }

}
