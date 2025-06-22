<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connect',function(){
    return view('connect');
})->name('connect');

Route::post('/connect', [AuthController::class, 'login'])->name('connect');