<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/absence', AbsenceController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/motif', MotifController::class);
    Route::put('/absence/validate/{id}', [AbsenceController::class, 'validateAbsence'])->name('absence.validate');
    Route::get('/absence/vue/{id}', [AbsenceController::class, 'voirAbsence'])->name('absence.vue');
});

Route::get('motif/{motif}/restore', [MotifController::class, 'restore'])->withTrashed()->name('motif.restore');
Route::get('user/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('user.restore');

require __DIR__.'/auth.php';
