<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Tampilan Dashboard untuk Admin
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    // Tampilan Dashboard untuk Siswa
    public function siswaDashboard()
    {
        return view('siswa.dashboard');
    }
}