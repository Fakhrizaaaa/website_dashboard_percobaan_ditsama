<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\Pengumuman;
use App\Models\Perkuliahan;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Password semua akun: "password" (di-hash otomatis oleh cast 'hashed' di User)
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => 'password', 'role' => 'admin']
        );

        $dosen = User::updateOrCreate(
            ['email' => 'dosen@example.com'],
            ['name' => 'Dosen Contoh', 'password' => 'password', 'role' => 'dosen']
        );

        $mhs = User::updateOrCreate(
            ['email' => 'mhs@example.com'],
            ['name' => 'Mahasiswa Contoh', 'password' => 'password', 'role' => 'mhs']
        );

        // Data contoh untuk testing
        $pemweb = MataKuliah::updateOrCreate(
            ['kode' => 'IF101'],
            ['nama' => 'Pemrograman Web', 'sks' => 3, 'dosen_id' => $dosen->id]
        );

        $basisData = MataKuliah::updateOrCreate(
            ['kode' => 'IF102'],
            ['nama' => 'Basis Data', 'sks' => 3, 'dosen_id' => $dosen->id]
        );

        Perkuliahan::firstOrCreate(
            ['mata_kuliah_id' => $pemweb->id, 'hari' => 'Senin'],
            ['jam_mulai' => '08:00', 'jam_selesai' => '10:30', 'ruangan' => 'Lab 1', 'semester' => '2026/2027 Ganjil']
        );

        Perkuliahan::firstOrCreate(
            ['mata_kuliah_id' => $basisData->id, 'hari' => 'Rabu'],
            ['jam_mulai' => '10:00', 'jam_selesai' => '12:30', 'ruangan' => 'R. 204', 'semester' => '2026/2027 Ganjil']
        );

        Ujian::firstOrCreate(
            ['mata_kuliah_id' => $pemweb->id, 'jenis' => 'UTS'],
            ['tanggal' => '2026-11-16', 'jam_mulai' => '09:00', 'jam_selesai' => '11:00', 'ruangan' => 'Lab 1']
        );

        Pengumuman::firstOrCreate(
            ['judul' => 'Selamat Datang di Portal Akademik'],
            ['isi' => "Jadwal perkuliahan dan ujian semester ini sudah bisa dilihat di portal.\nPeriksa jadwalmu secara berkala.", 'user_id' => $admin->id]
        );

        // Mahasiswa contoh hanya mengambil Pemrograman Web (untuk uji filter jadwal)
        $mhs->mataKuliahDiambil()->syncWithoutDetaching([$pemweb->id]);
    }
}