<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if (auth()->user()->isA('admin'))
        {
            $users = User::all();
            return view('user.index', compact('users'));
        } else {
            return redirect('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->isA('admin'))
        {
            return view('user.create');
        } else {
            return redirect('/');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        $motifs = Motif::all();
        $absences = Absence::where('user_id', $user->id)->get();

        return view('user.show', compact('absences', 'user', 'motifs'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $nb = Absence::where('user_id', $user->id)->count();

        if ($nb === 0) {
            $user->delete();
        } else {
            session::put('message', "L'utilisateur est encore utilisé par {$nb} absence(s)");
        }

        return redirect('user');
    }

    public function restore(User $user): RedirectResponse
    {
        $motif->restore();

        return redirect('motif');
    }
}
