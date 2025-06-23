<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CollaborateurController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connect',function(){
    return view('connect');
})->name('connect');

Route::get('/edit', [AuthController::class, 'edit'])->name('edit');

Route::post('/connect', [AuthController::class, 'login'])->name('connect');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/update-profil', [AuthController::class, 'update'])->name('update_profil');

Route::get('/liste', [CollaborateurController::class, 'liste'])->name('liste_utilisateur');