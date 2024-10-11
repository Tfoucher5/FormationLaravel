<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotifRequest;
use App\Models\Absence;
use App\Models\Motif;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isA('admin')) {

            $motifs = Cache::remember('motifs', 3500, function () {
                return Motif::withTrashed()->get();
            });

            return view('motif.index', compact('motifs'));

        } else {
            Session::put('message', __('no_authorization'));

            return redirect()->back();
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->isA('admin')) {
            return view('motif.create');
        } else {
            Session::put('message', __('no_authorization'));

            return redirect()->back();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MotifRequest $request)
    {
        $motif = new Motif;
        $motif->libelle = $request->libelle;

        $motif->is_accessible_salarie = $request->is_accessible_salarie;

        $motif->save();

        Cache::forget('motifs');

        return redirect('motif');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motif $motif)
    {

        if (auth()->user()->isA('admin')) {
            return view('motif.create');
        } else {
            Session::put('message', __('no_authorization'));

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motif $motif)
    {
        if (auth()->user()->isA('admin')) {
            return view('motif.edit', compact('motif'));
        } else {
            Session::put('message', __('no_authorization'));

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MotifRequest $request, Motif $motif)
    {
        $motif->libelle = $request->libelle;

        $motif->is_accessible_salarie = $request->input('is_accessible_salarie') === '1';

        $motif->save();

        Cache::forget('motifs');

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
            Session::put('message', session()->put('message', __('element_still_used')));
        }

        Cache::forget('motifs');

        return redirect('motif');
    }

    /**
     * Restore the specified resource.
     */
    public function restore(Motif $motif): RedirectResponse
    {
        $motif->restore();

        Cache::forget('motifs');

        return redirect('motif');
    }
}
