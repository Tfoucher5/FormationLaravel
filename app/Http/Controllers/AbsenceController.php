<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AbsenceRequest;
use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $absences = Absence::with(['user', 'motif'])->get();

        return view('absence.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $motifs = Motif::all();
        $users = User::all();

        return view('absence.create', compact('motifs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AbsenceRequest $request
     * @return RedirectResponse
     */
    public function store(AbsenceRequest $request): RedirectResponse
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
     *
     * @param Absence $absence
     * @return \Illuminate\View\View
     */
    public function show(Absence $absence): View
    {
        $absences = Absence::where('id', $absence->id)->with('motif', 'user')->first();  // Charge l'absence avec ses relations
        $motif = $absence->motif; // Accède au motif lié à cette absence
        $user = $absence->user;   // Accède à l'utilisateur lié à cette absence

        return view('absence.show', compact('absences', 'motif', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Absence $absence
     * @return View
     */
    public function edit(Absence $absence): View
    {
        $motifs = Motif::all();
        $users = User::all();

        return view('absence.edit', compact('motifs', 'users', 'absence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AbsenceRequest $request
     * @param Absence $absence
     * @return RedirectResponse
     */
    public function update(AbsenceRequest $request, Absence $absence): RedirectResponse
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
     *
     * @param Absence $absence
     * @return RedirectResponse
     */
    public function destroy(Absence $absence): RedirectResponse
    {
        $absence->delete();

        return redirect()->route('absence.index');
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
