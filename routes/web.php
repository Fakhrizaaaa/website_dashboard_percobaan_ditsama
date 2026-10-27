<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JadwalMahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PerkuliahanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

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

    Route::get('admin/mata-kuliah/{mataKuliah}/mahasiswa', [MataKuliahController::class, 'mahasiswa'])
        ->name('admin.mata-kuliah.mahasiswa');

    Route::resource('admin/mata-kuliah', MataKuliahController::class)
        ->except('show')
        ->names('admin.mata-kuliah');

    Route::resource('admin/perkuliahan', PerkuliahanController::class)
        ->except('show')
        ->names('admin.perkuliahan');

    Route::resource('admin/ujian', UjianController::class)
        ->except('show')
        ->names('admin.ujian');

    Route::resource('admin/users', UserController::class)
        ->except('show')
        ->names('admin.users');

    Route::resource('admin/pengumuman', PengumumanController::class)
        ->except('show')
        ->names('admin.pengumuman');
});

// Dosen Routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardController::class, 'dosenDashboard'])->name('dosen.dashboard');

    Route::get('dosen/mata-kuliah/{mataKuliah}/mahasiswa', [MataKuliahController::class, 'mahasiswa'])
        ->name('dosen.mata-kuliah.mahasiswa');

    Route::resource('dosen/mata-kuliah', MataKuliahController::class)
        ->except('show')
        ->names('dosen.mata-kuliah');

    Route::resource('dosen/perkuliahan', PerkuliahanController::class)
        ->except('show')
        ->names('dosen.perkuliahan');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mhs'])->group(function () {
    Route::get('/mhs/dashboard', [DashboardController::class, 'mhsDashboard'])->name('mhs.dashboard');
    Route::get('/mhs/jadwal-kuliah', [JadwalMahasiswaController::class, 'kuliah'])->name('mhs.jadwal-kuliah');
    Route::get('/mhs/jadwal-ujian', [JadwalMahasiswaController::class, 'ujian'])->name('mhs.jadwal-ujian');
    Route::get('/mhs/informasi', [InformasiController::class, 'index'])->name('mhs.informasi');
});

require __DIR__.'/auth.php';