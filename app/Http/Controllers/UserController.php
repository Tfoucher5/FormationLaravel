<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->isA('admin')) {
            $users = User::all();

            return view('user.index', compact('users'));
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
            return view('user.create');
        } else {
            Session::put('message', __('no_authorization'));

            return redirect()->back();
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
        if (auth()->user()->isA('admin')) {
            $motifs = Motif::all();
            $absences = Absence::where('user_id', $user->id)->get();
        } else {
            Session::put('message', __('no_authorization'));

            return redirect()->back();
        }

        return view('user.show', compact('absences', 'user', 'motifs'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $nb = Absence::where('user_id', $user->id)->count();

        if ($nb === 0) {
            $user->delete();
        } else {
            session()->put('message', __('element_still_used'));
        }

        return redirect('user');
    }

    public function restore(User $user): RedirectResponse
    {
        $user->restore();

        return redirect('motif');
    }
}
