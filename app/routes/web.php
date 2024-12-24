<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/auth/google', 'redirectToGoogle')->name('redirectToGoogle');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware(EnsureUserIsAuthenticated::class);
