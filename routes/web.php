<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Tambahkan rute ini di routes/web.php jika belum ada
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

// Route utama /dashboard yang memisahkan redirect berdasarkan Role
// Route utama /dashboard sebagai pengarah role
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($role === 'dosen') {
        return redirect('/dosen/dashboard');
    } else {
        return redirect('/mhs/dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Dosen Routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardController::class, 'dosenDashboard'])->name('dosen.dashboard');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mhs'])->group(function () {
    Route::get('/mhs/dashboard', [DashboardController::class, 'mhsDashboard'])->name('mhs.dashboard');
});

require __DIR__.'/auth.php';