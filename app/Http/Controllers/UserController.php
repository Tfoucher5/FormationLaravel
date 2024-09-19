<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // You would add your logic for storing the user here
        return redirect()->route('user.index');
    }

    /**
     * Display the specified user along with absences and motifs.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $motifs = Motif::all();
        $absences = Absence::where('user_id', $user->id)->get();

        return view('user.show', compact('absences', 'user', 'motifs'));
    }
}
