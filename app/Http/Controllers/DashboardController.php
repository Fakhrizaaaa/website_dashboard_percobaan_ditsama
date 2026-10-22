<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Ujian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function dosenDashboard()
    {
        return view('dosen.dashboard');
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