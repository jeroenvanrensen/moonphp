<?php

use Illuminate\Support\Facades\Route;
use JeroenvanRensen\MoonPHP\Http\Controllers\Auth\LoginController;

Route::middleware('moon.guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'show'])->name('moon.auth.login');
    Route::post('/admin/login', [LoginController::class, 'store'])->name('moon.auth.login');
});
