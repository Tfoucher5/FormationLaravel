<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\MotifRequest;
use App\Models\Absence;
use App\Models\Motif;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $motifs = Motif::withTrashed()->get();

        return view('motif.index', compact('motifs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('motif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MotifRequest $request
     * @return RedirectResponse
     */
    public function store(MotifRequest $request): RedirectResponse
    {
        $motif = new Motif();
        $motif->libelle = $request->libelle;

        $motif->is_accessible_salarie = $request->is_accessible_salarie;

        $motif->save();

        return redirect('motif');
    }

    /**
     * Display the specified resource.
     *
     * @param Motif $motif
     * @return void
     */
    public function show(Motif $motif): void
    {
        // Pas d'implémentation pour l'instant
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Motif $motif
     * @return View
     */
    public function edit(Motif $motif): View
    {
        return view('motif.edit', compact('motif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MotifRequest $request
     * @param Motif $motif
     * @return RedirectResponse
     */
    public function update(MotifRequest $request, Motif $motif): RedirectResponse
    {
        $motif->libelle = $request->libelle;

        $motif->is_accessible_salarie = $request->input('is_accessible_salarie') === '1';

        $motif->save();

        return redirect('motif');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Motif $motif
     * @return RedirectResponse
     */
    public function destroy(Motif $motif): RedirectResponse
    {
        $nb = Absence::where('motif_id', $motif->id)->count();

        if ($nb === 0) {
            $motif->delete();
        } else {
            Session::put('message', "Le motif est encore utilisé par {$nb} absence(s)");
        }

        return redirect('motif');
    }

    /**
     * Restore the specified resource.
     *
     * @param Motif $motif
     * @return RedirectResponse
     */
    public function restore(Motif $motif): RedirectResponse
    {
        $motif->restore();

        return redirect('motif');
    }
}
