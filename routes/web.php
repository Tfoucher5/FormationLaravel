<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\TestController;
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

Route::get('cool', [AccueilController::class, 'index'] )->name('accueil');
Route::get('motif', [MotifController::class, 'index'] )->name('Motifs');
Route::resource('/absence', AbsenceController::class);
Route::resource('/user', UserController::class );
