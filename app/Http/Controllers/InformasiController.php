<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\View\View;

// Halaman Informasi Kampus untuk mahasiswa
class InformasiController extends Controller
{
    public function index(): View
    {
        return view('mhs.informasi', [
            'daftar' => Pengumuman::with('penulis')->latest()->paginate(10),
        ]);
    }
}