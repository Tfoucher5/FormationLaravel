<?php

declare(strict_types=1);

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('cool', function(){
//     return "Cool, Laravel !";
// });

// Route::get('test/profil', function(){
//     return "Ceci est un test";
// })-> name('profil');
// //permet d'utiliser route('profil')

// Route::get('{chiffre}/{deuxieme}', function ($chiffre, $deuxieme) {
//     return "le résultat de $chiffre + $deuxieme est " . $chiffre + $deuxieme;
// })->where(['chiffre' => '[0-9]+' , 'deuxieme' => '[0-9]+'])
//   ->name("");

Route::get('motif/{motif}/restore', [MotifController::class, 'restore'])->withTrashed()->name('motif.restore');
Route::resource('/motif', MotifController::class);

Route::resource('/absence', AbsenceController::class);

Route::resource('/user', UserController::class);
