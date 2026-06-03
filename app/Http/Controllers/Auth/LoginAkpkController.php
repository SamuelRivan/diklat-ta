<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ref_pegawais;

class LoginAkpkController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('pegawais')->check()) {
            return redirect()->route('akpk.index');
        }

        return view('MenuUmum.Akpk.Auth.loginAkpk');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'email' => 'required|email',
        ]);

        $ref_pegawais = ref_pegawais::where('nip', $request->nip)
            ->where('email', $request->email)
            ->first();

        if ($ref_pegawais) {
            Auth::guard('pegawais')->login($ref_pegawais);

            return redirect()->route('akpk.index');
        }

        return back()->withErrors(['nip' => 'NIP atau email salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('pegawais')->logout(); // atau 'web' tergantung guard

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('akpk.index');
        // GANTI ini ke route dashboard publik kamu
    }

}
