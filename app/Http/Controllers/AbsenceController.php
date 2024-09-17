<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use DB;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absences = Absence::all();
        return view('absence.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('absence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Récupérer l'absence avec l'utilisateur et le motif associés
    $absence = Absence::with(['user', 'motif'])->where('id', $id)->first();

        $motif = DB::table('motifs')
        ->join('absences', 'motifs.id', '=', 'absences.motif_id')
        ->where('absences.id', $id)
        ->select('motifs.Libelle')
        ->first();

        $user = DB::table('users')
        ->join('absences', 'users.id', '=', 'absences.user_id')
        ->where('absences.id', $id)
        ->select('users.prenom', 'users.nom')
        ->first();

    if(!$absence)
    {
        return ('Aucune absence ne porte ce numéro d\'identification : ' . $id);
    }

    // Afficher les détails de l'absence, y compris les informations utilisateur et motif
    return view('absence.show', [
        'absence' => $absence,
        'user' => $user,
        'motif' => $motif
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        return view('absence.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
