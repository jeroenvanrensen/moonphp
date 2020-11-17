<?php

use Illuminate\Support\Facades\Route;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LoginController;

Route::middleware(['web', 'moon.guest'])->prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('moon.auth.login');
    Route::post('/login', [LoginController::class, 'store'])->name('moon.auth.login');
});
