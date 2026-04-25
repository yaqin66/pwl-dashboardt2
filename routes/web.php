<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarketingUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Management (CRUD)
Route::resource('users', UserController::class);

// User Marketing Management (CRUD)
Route::resource('marketing', MarketingUserController::class);

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
