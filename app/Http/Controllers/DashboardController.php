<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Pengumuman;
use App\Models\Perkuliahan;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard', [
            'jumlahUser' => User::count(),
            'jumlahMatkul' => MataKuliah::count(),
            'jumlahJadwal' => Perkuliahan::count(),
            'jumlahUjian' => Ujian::count(),
        ]);
    }

    public function dosenDashboard()
    {
        $matkulIds = auth()->user()->mataKuliahDiampu()->pluck('id');

        return view('dosen.dashboard', [
            'jumlahMatkul' => $matkulIds->count(),
            'jumlahJadwal' => Perkuliahan::whereIn('mata_kuliah_id', $matkulIds)->count(),
            'jumlahMahasiswa' => DB::table('krs')->whereIn('mata_kuliah_id', $matkulIds)->distinct()->count('user_id'),
        ]);
    }

    public function mhsDashboard()
    {
        $mataKuliah = auth()->user()->mataKuliahDiambil;

        // Ujian terdekat (hari ini atau setelahnya) dari mata kuliah yang diambil
        $ujianTerdekat = Ujian::with('mataKuliah')
            ->whereIn('mata_kuliah_id', $mataKuliah->pluck('id'))
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->first();

        return view('mhs.dashboard', [
            'jumlahMatkul' => $mataKuliah->count(),
            'totalSks' => $mataKuliah->sum('sks'),
            'ujianTerdekat' => $ujianTerdekat,
            'pengumumanTerbaru' => Pengumuman::latest()->take(3)->get(),
        ]);
    }
}