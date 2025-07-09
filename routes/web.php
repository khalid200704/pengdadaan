<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\LaporanPengadaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource CRUD routes - Admin and Division Head only
    Route::resource('users', UserController::class)->middleware(['admin_or_division_head']);
    Route::resource('permintaan', PermintaanController::class);
    Route::resource('persetujuan', PersetujuanController::class);
    Route::resource('laporan-pengadaan', LaporanPengadaanController::class);
    Route::resource('saldos', SaldoController::class);
    Route::resource('budgets', BudgetController::class);


    Route::view('/pengaturan', 'pengaturan')->middleware(['auth']);
});

require __DIR__.'/auth.php'; 