<?php

use Illuminate\Support\Facades\Route;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LoginController;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LogoutController;

Route::middleware('moon.guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('moon.auth.login');
    Route::post('/login', [LoginController::class, 'store'])->name('moon.auth.login');
});

Route::middleware('moon.auth')->group(function() {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('moon.auth.logout');
    
    Route::get('', function() {
        return view('moon::dashboard');
    })->name('moon.dashboard');
});
