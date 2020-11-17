<?php

use Illuminate\Support\Facades\Route;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LoginController;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LogoutController;

Route::middleware(['web', 'moon.guest'])->prefix('/admin')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('moon.auth.login');
    Route::post('/login', [LoginController::class, 'store'])->name('moon.auth.login');
});

Route::middleware(['web', 'moon.auth'])->prefix('/admin')->group(function() {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('moon.auth.logout');
    
    Route::get('', function() {
        return view('moon::dashboard');
    })->name('moon.dashboard');
});
