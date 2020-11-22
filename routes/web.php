<?php

use Illuminate\Support\Facades\Route;
use JeroenvanRensen\MoonPHP\Http\Controllers\DashboardController;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LogoutController;
use JeroenvanRensen\MoonPHP\Http\Livewire\Auth\Login;
use JeroenvanRensen\MoonPHP\Http\Livewire\Resources\ResourceIndex;

Route::middleware('moon.guest')->group(function () {
    Route::get('/login', Login::class)->name('moon.auth.login');
});

Route::middleware('moon.auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('moon.auth.logout');

    Route::get('/', [DashboardController::class, 'show'])->name('moon.dashboard');

    Route::get('/{resource}', ResourceIndex::class)->name('moon.resources.index');
});
