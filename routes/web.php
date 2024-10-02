<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController; // Assurez-vous d'importer ce contrôleur
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LanguageMiddleware;

// Appliquez le middleware sur toutes les routes
Route::middleware([LanguageMiddleware::class])->group(function () {

    // Route pour changer la langue
    Route::post('/language/change', [LanguageController::class, 'change'])->name('language.change');

    // Route d'accueil
    Route::get('/', function () {
        return view('welcome');
    });

    // Routes protégées par authentification
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Ressources pour Absences, Utilisateurs et Motifs
        Route::resource('/absence', AbsenceController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/motif', MotifController::class);

        // Routes spécifiques pour les absences
        Route::put('/absence/validate/{id}', [AbsenceController::class, 'validateAbsence'])->name('absence.validate');
        Route::get('/absence/vue/{id}', [AbsenceController::class, 'voirAbsence'])->name('absence.vue');

        // Routes pour restaurer un motif ou un utilisateur
        Route::get('motif/{motif}/restore', [MotifController::class, 'restore'])->withTrashed()->name('motif.restore');
        Route::get('user/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('user.restore');

        // Route pour le dashboard
        Route::get('/dashboard', function () {
            return redirect('/');
        })->middleware(['auth'])->name('dashboard');
    });

    // Authentification
    require __DIR__ . '/auth.php';
});
