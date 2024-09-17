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
        $liste = Motif::all();
        return dump($liste);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Motif $motif)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motif $motif)
    {
        return view('motif.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motif $motif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motif $motif)
    {
        //
    }
}
