<?php

namespace App\Http\Controllers;

use App\Models\ref_pegawais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user login
        $user = Auth::user();

        // Cek role
        if ($user->is_admin == 1) {
            // Superadmin: hitung semua pegawai
            $pegawai = ref_pegawais::count();
        } else {
            // Admin biasa: hitung pegawai sesuai unit kerja
            $pegawai = ref_pegawais::where('kode_unitkerja', $user->kode_unitkerja)->count();
        }

        return view('dashboard', compact('pegawai'));
    }
}
