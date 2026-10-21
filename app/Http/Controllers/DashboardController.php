<?php

namespace App\Http\Controllers;

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
        return view('mhs.dashboard');
    }
}