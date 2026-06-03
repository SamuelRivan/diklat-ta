<?php

namespace App\Http\Controllers\Umum\EvaluasiPasca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\EvaluasiUser;
use App\Models\ref_pegawais;

class ProfileController extends Controller
{
    /**
     * Display the profile page
     */
    public function index()
    {
        if (!session()->has('user_nip')) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session('user_nip');
        $userId = session('user_id');
        $userRole = session('user_role');

        // Get EvaluasiUser for foto_profile
        $evaluasiUser = EvaluasiUser::find($userId);

        // Get ref_pegawai for detailed info
        $ref_pegawai = ref_pegawais::where('nip', $nip)->first();

        if (!$ref_pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Data pegawai tidak ditemukan.');
        }

        return view('MenuUmum.EvaluasiPasca.profile.index', compact('evaluasiUser', 'ref_pegawai', 'userRole'));
    }

    /**
     * Update profile photo
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'foto_profile.required' => 'Silakan pilih foto untuk diupload.',
            'foto_profile.image' => 'File harus berupa gambar.',
            'foto_profile.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'foto_profile.max' => 'Ukuran foto maksimal 2MB.'
        ]);

        if (!session()->has('user_id')) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session('user_id');
        $evaluasiUser = EvaluasiUser::find($userId);

        if (!$evaluasiUser) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        // Delete old photo if exists
        if ($evaluasiUser->foto_profile && file_exists(public_path($evaluasiUser->foto_profile))) {
            unlink(public_path($evaluasiUser->foto_profile));
        }

        // Upload new photo
        $file = $request->file('foto_profile');
        $filename = 'profile_' . $userId . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Move file to public/uploads/profiles
        $destinationPath = public_path('uploads/profiles');

        // Create directory if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $filename);

        // Update database
        $evaluasiUser->foto_profile = 'uploads/profiles/' . $filename;
        $evaluasiUser->save();

        return back()->with('success', 'Foto profile berhasil diperbarui.');
    }

    /**
     * Remove profile photo
     */
    public function removePhoto()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session('user_id');
        $evaluasiUser = EvaluasiUser::find($userId);

        if (!$evaluasiUser) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        // Delete photo file if exists
        if ($evaluasiUser->foto_profile && file_exists(public_path($evaluasiUser->foto_profile))) {
            unlink(public_path($evaluasiUser->foto_profile));
        }

        // Update database
        $evaluasiUser->foto_profile = null;
        $evaluasiUser->save();

        return back()->with('success', 'Foto profile berhasil dihapus.');
    }
}
