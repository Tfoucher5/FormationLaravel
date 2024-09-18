<?php

namespace App\Http\Controllers;

use App\Models\Motif;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motifs = Motif::all();
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

        $motif = new Motif;
        $motif->libelle = $request->libelle;
        $motif->save();

        return redirect()->route('motif.index')->with('success', 'Motif created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motif $motif) {}

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

        return redirect()->route('motif.index')->with('success', 'Motif updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motif $motif)
    {
        $motif->delete();
        return redirect('motif');
    }
}
