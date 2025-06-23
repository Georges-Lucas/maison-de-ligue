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

Route::get('/inscription', function() {
    return view('inscription');
})->name('store_utilisateur');

Route::post('/inscription', [CollaborateurController::class, 'store'])->name('store_utilisateur');

Route::get('/edit', [AuthController::class, 'edit'])->name('edit');
Route::get('/collaborateur/{id}/modification', [CollaborateurController::class, 'edit'])->name('edit_collaborateur');

Route::post('/connect', [AuthController::class, 'login'])->name('connect');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/update-profil', [AuthController::class, 'update'])->name('update_profil');
Route::post('/collaborateur/{id}/modification', [CollaborateurController::class, 'update'])->name('update_profil');

Route::get('/liste', [CollaborateurController::class, 'liste'])->name('liste_utilisateur');
Route::delete('/collaborateur/{id}/supprimer', [CollaborateurController::class, 'destroy'])->name('delete_collaborateur');