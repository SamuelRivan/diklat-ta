<?php

namespace App\Http\Controllers\Umum\EvaluasiPasca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\eva_1_alumni;
use App\Models\ref_pegawais;
use App\Models\Pertanyaan;
use App\Models\Jawaban;

/**
 * Mengelola evaluasi pasca pelatihan oleh alumni (peserta pelatihan)
 */
class EvaluasiAlumniController extends Controller
{
    // Halaman awal form alumni
    public function index()
    {
        $nip = session('user_nip');
        $ref_pegawais = ref_pegawais::where('nip', $nip)->first();

        if (!$ref_pegawais) {
            return redirect()->route('home')->with('error', 'Data alumni tidak ditemukan.');
        }

        return view('MenuUmum.EvaluasiPasca.evaluasi.alumni', compact('ref_pegawais'));
    }

    // Menyimpan data awal alumni
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatihan'   => 'required|string|max:255',
            'jenis_pelatihan'  => 'required|string|max:255',
            'nip_atasan'       => 'required|string|max:50',
            'nama_atasan'      => 'required|string|max:255',
            'nip_rekankerja'   => 'required|string|max:50',
            'nama_rekankerja'  => 'required|string|max:255',
        ]);

        $nip = session('user_nip');
        $pegawai = ref_pegawais::where('nip', $nip)->first();

        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }

        eva_1_alumni::create([
            'nip'             => $pegawai->nip,
            'nama'            => $pegawai->nama,
            'pangkat'         => $pegawai->pangkat,
            'golongan'        => $pegawai->golongan,
            'jabatan'         => $pegawai->jabatan,
            'unit_kerja'      => $pegawai->unit_kerja,
            'nama_pelatihan'  => $request->input('nama_pelatihan'),
            'jenis_pelatihan' => $request->input('jenis_pelatihan'),
            'nip_atasan'      => $request->input('nip_atasan'),
            'nama_atasan'     => $request->input('nama_atasan'),
            'nip_rekankerja'  => $request->input('nip_rekankerja'),
            'nama_rekankerja' => $request->input('nama_rekankerja'),
        ]);

        return redirect()->route('evaluasi.pertanyaanalumni')->with('success', 'Evaluasi berhasil disimpan!');
    }

    // Menampilkan pertanyaan
    public function showPertanyaan()
    {
        $pertanyaan = Pertanyaan::all();
        return view('MenuUmum.EvaluasiPasca.Evaluasi.Pertanyaan', compact('pertanyaan'));
    }

    // Menyimpan jawaban kuesioner
    public function simpanJawaban(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array',
        ]);

        $nip = session('user_nip');

        foreach ($request->jawaban as $pertanyaan_id => $nilai) {
            Jawaban::create([
                'pertanyaan_id' => $pertanyaan_id,
                'nilai' => $nilai,
                'nip_alumni' => $nip, // asumsi Anda punya field ini
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('alumni')->with('success', 'Terima kasih! Jawaban Anda telah disimpan.');
    }

    // Form gabungan pertanyaan dan pegawai (opsional)
    public function showForm()
    {
        $ref_pegawais = ref_pegawais::all();
        $pertanyaan = Pertanyaan::all();
        return view('evaluasi.form', compact('ref_pegawais', 'pertanyaan'));
    }
}