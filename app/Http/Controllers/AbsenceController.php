<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\AbsenceRequest;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isA('admin'))
        {
            $absences = Absence::where('user_id', '!=', auth()->user()->id)->get();
        } else {
            $absences = Absence::where('user_id', auth()->id())->get();
        }
        return view('absence.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $motifs = Motif::all();
        if (auth()->user()->isA('admin')) {
            $users = User::where('id', '!=', auth()->user()->id)->get();
        } else {
            $users = User::where('id', auth()->id())->get();
        }

        return view('absence.create', compact('motifs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $absence = new Absence();
        $absence->user_id = $request->user_id;
        $absence->motif_id = $request->motif_id;
        $absence->date_debut = $request->date_debut;
        $absence->date_fin = $request->date_fin;
        $absence->save();

        return redirect('absence');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        $absences = Absence::where('id', $absence->id)->with('motif', 'user')->first();
        $motif = $absence->motif;
        $user = $absence->user;

        return view('absence.show', compact('absences', 'motif', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        $motifs = Motif::all();
        if (auth()->user()->isA('admin')) {
            $users = User::where('id', '!=', auth()->user()->id)->get();
        } else {
            $users = User::where('id', auth()->id())->get();
        }

        return view('absence.edit', compact('motifs', 'users', 'absence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence)
    {
        $absence->user_id = $request->user_id;
        $absence->motif_id = $request->motif_id;
        $absence->date_debut = $request->date_debut;
        $absence->date_fin = $request->date_fin;
        $absence->save();

        return redirect('absence');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {

        if (auth()->user()->isA('salarié')) {
            // Ajouter un message d'erreur dans la session et rediriger
            return redirect()->route('absence.index')->with('error', 'Vous n\'avez pas les permissions pour supprimer une absence.');
        }

        // Si l'utilisateur n'est pas un salarié, il peut supprimer l'absence
        $absence->delete();

        return redirect()->route('absence.index')->with('success', 'L\'absence a été supprimée avec succès.');
    }

    /**
     * Restore the specified resource.
     *
     * @param Absence $absence
     * @return RedirectResponse
     */
    public function restore(Absence $absence): RedirectResponse
    {
        $absence->restore();

        return redirect()->route('absence.index');
    }
}
