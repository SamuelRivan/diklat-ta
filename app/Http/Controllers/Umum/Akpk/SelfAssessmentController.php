<?php


namespace App\Http\Controllers\Umum\AKPK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\akpk_2_selfassesment;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\ref_pegawais;

class SelfAssessmentController extends Controller

{

    public function index()
    {
        // Logika untuk mengambil data dan menampilkan tampilan
        return view('MenuUmum.Akpk.Assessment.SelfAssessment');
    }
    
    public function showForm()
    {
        return view('self-assessment');
    }

    public function storeData(Request $request)
    {
        // Validasi input data
        $validated = $request->validate([
            'tanggal_pengisian' => 'required|date',
            'manajerial_skala' => 'required|array',
            'manajerial_keterangan' => 'nullable|array',
            'teknis_skala' => 'required|array',
            'teknis_keterangan' => 'nullable|array',
            'sosio_skala' => 'required|array',
            'sosio_keterangan' => 'nullable|array',
            'kompetensi_dibutuhkan' => 'required|string',
            'pelatihan_dibutuhkan' => 'required|string',
        ]);

        // Ambil nama atasan berdasarkan atasan_id
        $pegawai = Auth::guard('pegawais')->user();
        $nama = ref_pegawais::find($pegawai->id_atasan)->nama ?? 'Tidak Diketahui';

        // Simpan data ke database
        akpk_2_selfassesment::create([
            'pegawai_id' => $pegawai->id,
            'tanggal_pengisian' => $validated['tanggal_pengisian'],
            'manajerial_nilai' => json_encode($validated['manajerial_skala']),
            'manajerial_keterangan' => json_encode($validated['manajerial_keterangan']),
            'teknis_nilai' => json_encode($validated['teknis_skala']),
            'teknis_keterangan' => json_encode($validated['teknis_keterangan']),
            'sosiokultural_nilai' => json_encode($validated['sosio_skala']),
            'sosiokultural_keterangan' => json_encode($validated['sosio_keterangan']),
            'kompetensi_dibutuhkan' => $validated['kompetensi_dibutuhkan'],
            'pelatihan_dibutuhkan' => $validated['pelatihan_dibutuhkan'],
            'nama_atasan' => $nama,
        ]);

        // Alihkan dengan pesan sukses
        return redirect()->route('self-assessment.index')->with('success', 'Data berhasil disimpan.');
    }
}
