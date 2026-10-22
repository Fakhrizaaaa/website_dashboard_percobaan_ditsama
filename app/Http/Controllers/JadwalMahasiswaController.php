<?php

namespace App\Http\Controllers;

use App\Models\Perkuliahan;
use App\Models\Ujian;
use Illuminate\View\View;

// Jadwal mahasiswa: hanya mata kuliah yang ada di KRS user yang sedang login
class JadwalMahasiswaController extends Controller
{
    private const HARI = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    private function mataKuliahIds()
    {
        return auth()->user()->mataKuliahDiambil()->pluck('mata_kuliah.id');
    }

    public function kuliah(): View
    {
        $jadwal = Perkuliahan::with('mataKuliah.dosen')
            ->whereIn('mata_kuliah_id', $this->mataKuliahIds())
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        $namaHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('mhs.jadwal-kuliah', [
            'jadwal' => $jadwal,
            'hariList' => self::HARI,
            'hariIni' => $namaHari[now()->dayOfWeekIso - 1],
        ]);
    }

    public function ujian(): View
    {
        $daftar = Ujian::with('mataKuliah')
            ->whereIn('mata_kuliah_id', $this->mataKuliahIds())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('mhs.jadwal-ujian', ['daftar' => $daftar]);
    }
}