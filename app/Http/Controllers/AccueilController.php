<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccueilController extends Controller
{
    public function __construct()
    {
        // abort(500); // Renvoie une erreur 500 si décommenté
    }

    /**
     * Show the welcome page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('welcome');
    }
}
