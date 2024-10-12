<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenceRequest;
use App\Mail\AbsenceMail;
use App\Mail\absenceValidatedMail;
use App\Mail\ModifAbsenceMail;
use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isA('admin')) {
            $absences = Absence::withTrashed()->where('user_id', '!=', auth()->user()->id)->get();
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
        if (auth()->user()->isA('admin')) {

            $motifs = Motif::all();
            $users = User::all();

            return view('absence.create', compact('motifs', 'users'));
        } else {
            $motifs = Motif::where('is_accessible_salarie', true)->get();
            $users = User::where('id', auth()->user()->id)->get();

            return view('absence.create', compact('motifs', 'users'));
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AbsenceRequest $request)
    {
        $absence = new Absence;
        $absence->user_id = $request->user_id;
        $absence->motif_id = $request->motif_id;
        $absence->date_debut = $request->date_debut;
        $absence->date_fin = $request->date_fin;
        $absence->save();

        $users = User::all();
        foreach ($users as $user) {
            if ($user->isA('admin')) {
                Mail::to($user->email)->send(new AbsenceMail($absence->user, $absence->motif, $absence));
            }
        }

        return redirect('absence');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {

        if (auth()->user()->isA('admin')) {
            $absences = Absence::where('id', $absence->id)->with('motif', 'user')->first();
            $motif = $absence->motif;
            $user = $absence->user;

            return view('absence.show', compact('absences', 'motif', 'user'));
        } else {
            if (auth()->user()->id != $absence->user->id) {
                Session::put('message', "Vous n'avez pas l'autorisation d'accéder à cette page :/");

                return redirect('/');
            } else {

                $absences = Absence::where('id', $absence->id)->with('motif', 'user')->first();
                $motif = $absence->motif;
                $user = $absence->user;

                return view('absence.show', compact('absences', 'motif', 'user'));
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        $motifs = Motif::where('is_accessible_salarie', true)->get();
        $users = User::all();

        return view('absence.edit', compact('motifs', 'users', 'absence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AbsenceRequest $request, Absence $absence)
    {
        if (auth()->user()->isA('admin')) {
            // Assurez-vous d'inclure `user_id` dans la mise à jour
            $absence->user_id = $request->input('user_id');
            $absence->motif_id = $request->input('motif_id');
            $absence->date_debut = $request->input('date_debut');
            $absence->date_fin = $request->input('date_fin');
            $absence->save();

            // Envoi de l'email aux admins après modification
            $admins = User::where('admin', true)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new ModifAbsenceMail($absence->user, $absence->motif, $absence));
            }
        }
        return redirect('absence');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {

        if (auth()->user()->isA('salarie')) {
            // Ajouter un message d'erreur dans la session et rediriger
            return redirect()->back();
        } else {
            // Si l'utilisateur n'est pas un salarié, il peut supprimer l'absence
            $absence->delete();

            return redirect('absence');
        }
    }

    public function restore(Absence $absence): RedirectResponse
    {
        if (auth()->user()->isA('admin')) {
            $absence->restore();
        }
        return redirect('absence');
    }

    public function validateAbsence($id)
    {
        $absence = Absence::findOrFail($id);

        if (!auth()->user()->isA('admin')) {
            abort(403);
        }

        $absence->is_verified = true;
        $absence->save();

        Mail::to($absence->user->email)->send(new AbsenceValidatedMail($absence->user, $absence));

        return redirect('absence');
    }

    public function voirAbsence()
    {
        $absences = Absence::where('user_id', auth()->user()->id)->get();

        return view('absence.absenceAdmin', compact('absences'));
    }
}
