<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PegawaiDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk pegawai.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data pegawai yang sudah login
        $pegawai = auth()->guard('pegawais')->user();

        // Menampilkan halaman dashboard pegawai
        return view('pegawai.dashboard', compact('pegawai'));
    }
}

