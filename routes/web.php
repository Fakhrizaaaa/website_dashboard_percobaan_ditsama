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
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }
    return redirect('/siswa/dashboard');
})->middleware(['auth'])->name('dashboard');

// Group Route khusus ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Group Route khusus SISWA
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswaDashboard'])->name('siswa.dashboard');
});

require __DIR__.'/auth.php';