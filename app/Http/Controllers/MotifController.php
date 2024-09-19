<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motifs = Motif::withTrashed()->get();

        // return dump($liste);
        return view(view: 'motif.index', data: compact('motifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('motif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $motif = new Motif();
        $motif->libelle = $request->libelle;
        $motif->save();

        return redirect()->route('motif.index')->with('success', 'Motif created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motif $motif): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motif $motif)
    {
        $motifs = Motif::where('id', $motif)->get();

        return view(view: 'motif.edit', data: compact('motif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motif $motif)
    {
        $motif->libelle = $request->libelle;
        $motif->save();

        return redirect('motif');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motif $motif)
    {
        $nb = Absence::where('motif_id', $motif->id)->count();

        if ($nb === 0) {
            $motif->delete();
        } else {
            session::put('message', "le motif est encore utilisé par {$nb} absence(s)");
        }

        return redirect('motif');
    }

    public function restore(Motif $motif)
    {
        $motif->restore();

        return redirect('motif');
    }
}
