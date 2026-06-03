<?php

namespace App\Http\Controllers\Umum\Akpk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\akpk_3_penilaianbawahan;

class AssessmentBawahanController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        if (!Auth::guard('pegawais')->check()) {
            return redirect()->route('login.akpk')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Fetch the logged-in user's data
        $user = Auth::guard('pegawais')->user();

        // Fetch id_atasan directly
        $id_atasan = $user->id_atasan;

        if (!$id_atasan) {
            return redirect()->back()->with('error', 'ID atasan tidak ditemukan. Pastikan id_atasan sudah diisi dengan benar.');
        }

        // Pass the id_atasan to the view
        return view('MenuUmum.Akpk.Assessment.assessmentBawahan', compact('user', 'id_atasan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_atasan' => 'required|integer',
            'nama_atasan' => 'required|string',
            'tanggal_pengisian' => 'required|date',
            'manajerial_skala' => 'required|array',
            'teknis_skala' => 'required|array',
            'sosio_skala' => 'required|array',
            'manajerial_keterangan' => 'nullable|array',
            'teknis_keterangan' => 'nullable|array',
            'sosio_keterangan' => 'nullable|array',
            'kompetensi_dibutuhkan' => 'required|string',
            'pelatihan_dibutuhkan' => 'required|string',
        ]);

        akpk_3_penilaianbawahan::create([
            'pegawai_id' => Auth::guard('pegawais')->id(), // Ensure pegawai_id is explicitly set
            'id_atasan' => $validatedData['id_atasan'],
            'tanggal_pengisian' => $validatedData['tanggal_pengisian'],
            'manajerial_nilai' => json_encode($validatedData['manajerial_skala']),
            'teknis_nilai' => json_encode($validatedData['teknis_skala']),
            'sosiokultural_nilai' => json_encode($validatedData['sosio_skala']),
            'manajerial_keterangan' => json_encode($validatedData['manajerial_keterangan']),
            'teknis_keterangan' => json_encode($validatedData['teknis_keterangan']),
            'sosiokultural_keterangan' => json_encode($validatedData['sosio_keterangan']),
            'kompetensi_dibutuhkan' => $validatedData['kompetensi_dibutuhkan'],
            'pelatihan_dibutuhkan' => $validatedData['pelatihan_dibutuhkan'],
            'nama_atasan' => $validatedData['nama_atasan'],
        ]);

        return redirect()->route('assessmentBawahan.index')->with('success', 'Data berhasil disimpan.');
    }
}
