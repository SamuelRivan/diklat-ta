<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ref_pegawais;
use Illuminate\Support\Facades\DB;

class PegawaiAuthController extends Controller
{
    // Menampilkan form login pegawai
    public function showLoginForm()
    {
        return view('pegawai.login');
    }

    // Proses login pegawai
    public function login(Request $request)
    {
        // Validasi input untuk NIP
        $request->validate([
            'nip' => 'required|exists:ref_pegawais,nip', // Pastikan NIP ada di database
        ]);

        // Ambil NIP dari request
        $nip = $request->input('nip');

        // Cari pegawai berdasarkan NIP
        $pegawai = ref_pegawais::where('nip', $nip)->first();

        // Jika pegawai ditemukan, login menggunakan guard pegawais
        if ($pegawai) {
            Auth::guard('pegawais')->login($pegawai);

            $request->session()->regenerate(); // Regenerate session setelah login sukses

            // Simpan nama pegawai di session
            session([
                'nama_pegawai' => $pegawai->nama, // Asumsikan ada kolom 'nama' di tabel ref_pegawais
            ]);

            // Arahkan ke dashboard pegawai
            return redirect('/'); // atau route('home') jika pakai nama route
        }

        // Jika NIP tidak ditemukan
        return back()->withErrors(['nip' => 'NIP tidak ditemukan atau tidak valid.']);
    }

    // Logout pegawai
    public function logout(Request $request)
    {
        Auth::guard('pegawais')->logout(); // Logout pegawai
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Arahkan ke halaman login pegawai
    }
}
