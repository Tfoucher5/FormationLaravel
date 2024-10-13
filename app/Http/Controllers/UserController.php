<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
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
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
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
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données (ajustez selon vos besoins)
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Création de l'utilisateur
        User::create([
            'email' => $validatedData['email'],
            'prenom' => $validatedData['prenom'],
            'nom' => $validatedData['nom'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View|RedirectResponse
     */
    public function show(User $user): View|RedirectResponse
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

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
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

    /**
     * Restore the specified resource.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function restore(User $user): RedirectResponse
    {
        $user->restore();
        return redirect('user');
    }
}
