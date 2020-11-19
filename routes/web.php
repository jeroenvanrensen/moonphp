<?php

use Illuminate\Support\Facades\Route;
use JeroenvanRensen\MoonPHP\Http\Controllers\DashboardController;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LoginController;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LogoutController;
use JeroenvanRensen\MoonPHP\Http\Controllers\ResourceController;

Route::middleware('moon.guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('moon.auth.login');
    Route::post('/login', [LoginController::class, 'store'])->name('moon.auth.login');
});

Route::middleware('moon.auth')->group(function() {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('moon.auth.logout');
    
    Route::get('/', [DashboardController::class, 'show'])->name('moon.dashboard');

    Route::get('/{resource}', [ResourceController::class, 'index'])->name('moon.resources.index');
});
