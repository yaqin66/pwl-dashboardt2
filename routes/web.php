<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarketingUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/setup-database', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        $user = \App\Models\User::firstOrNew(['email' => 'admin@example.com']);
        $user->name = 'Administrator';
        $user->password = \Illuminate\Support\Facades\Hash::make('password123');
        $user->email_verified_at = now();
        $user->save();

        return 'Setup complete. Silakan ke /login';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/run-migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return 'Migrasi berhasil! Tabel transaksi sudah dibuat.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/check-db', function() {
    $hasMarketing = \Illuminate\Support\Facades\Schema::hasTable('marketing_users');
    $hasUsers = \Illuminate\Support\Facades\Schema::hasTable('users');
    return response()->json([
        'users_table' => $hasUsers,
        'marketing_users_table' => $hasMarketing
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // AdminLTE Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // AdminLTE Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Users Management
    Route::resource('users', UserController::class);

    // Marketing Users Management
    Route::resource('marketing', MarketingUserController::class);

    // Transactions Management
    Route::get('transactions/export-pdf', [TransactionController::class, 'exportPdf'])->name('transactions.export-pdf');
    Route::resource('transactions', TransactionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/breeze-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/breeze-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/breeze-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
