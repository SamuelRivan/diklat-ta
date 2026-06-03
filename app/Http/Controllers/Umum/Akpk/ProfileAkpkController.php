<?php

namespace App\Http\Controllers\Umum\AKPK;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ref_pegawais;
use App\Models\profile_akpk;
use App\Http\Controllers\Controller;

class ProfileAkpkController extends Controller
{
    public function __construct()
    {
        // Middleware ini memastikan user sudah login di guard 'pegawai'
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('pegawais')->check()) {
                return redirect()->route('login.akpk'); // Redirect ke login AKPK jika belum login
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::guard('pegawais')->user();
        $refPegawais = ref_pegawais::all();

        // Fetch supervisor details if id_atasan exists
        $atasan = $user->id_atasan ? ref_pegawais::find($user->id_atasan) : null;

        return view('MenuUmum.Akpk.ProfileAkpk', compact('user', 'refPegawais', 'atasan'));
    }

    public function edit()
    {
        $user = Auth::guard('pegawais')->user();
        $refPegawais = ref_pegawais::select('id', 'nama', 'jabatan')->get(); // Fetch id, nama, and jabatan

        return view('MenuUmum.Akpk.editprofile', compact('user', 'refPegawais'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('pegawais')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'pangkat_golongan' => 'nullable|string|max:50',
            'jenis_jabatan' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'unit_kerja' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'atasan_anda' => 'nullable|exists:ref_pegawais,id',
            'alamat' => 'nullable|string|max:500',
        ]);

        $profileData = $request->except(['foto']);

        if ($request->has('atasan_anda')) {
            $profileData['id_atasan'] = $request->atasan_anda; // Map to id_atasan in the database
        }

        if ($request->hasFile('foto')) {
            if ($user->profile_akpk && $user->profile_akpk->foto && Storage::disk('public')->exists($user->profile_akpk->foto)) {
                Storage::disk('public')->delete($user->profile_akpk->foto);
            }

            $path = $request->file('foto')->store('profile', 'public');
            $profileData['foto'] = $path;
        }

        ref_pegawais::updateOrCreate(
            ['email' => $user->email], // Match by email
            $profileData
        );

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
