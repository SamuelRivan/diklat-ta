<?php

namespace App\Http\Controllers\Umum\EvaluasiPasca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pelatihan_5_Pascadiklat_Kuesioner;
use App\Models\Pelatihan_5_Pascadiklat_Pertanyaan;
use App\Models\Pelatihan_5_Pascadiklat_PelatihanKuesioner;
use App\Models\Pelatihan_5_Pascadiklat_OpsiJawaban;
use App\Models\Pelatihan_5_Pascadiklat_Jawaban;
use App\Models\ref_pegawais;
use App\Models\eva_1_alumni;
use App\Models\eva_3_rekansejawat;

/**
 * Mengelola evaluasi pasca pelatihan oleh rekan kerja sejawat alumni
 */
class EvaluasiRekanKerjaController extends Controller
{
    /**
     * Menampilkan daftar alumni yang perlu dinilai oleh rekan kerja yang sedang login
     */
    public function index()
    {
        $nip = session('user_nip');
        
        if (!$nip) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        // Ambil semua alumni yang dipilih untuk dinilai oleh rekan kerja ini
        $alumniList = eva_3_rekansejawat::with(['alumni.pegawai', 'alumni.pelatihan'])
            ->where('pegawai_id', $pegawai->id)
            ->where('status_penilaian', eva_3_rekansejawat::STATUS_BELUM_DINILAI)
            ->get();
        
        return view('MenuUmum.EvaluasiPasca.rekankerja.index', compact('alumniList', 'pegawai'));
    }
    
    /**
     * Menampilkan kuesioner yang tersedia untuk rekan kerja
     */
    public function showKuesioner($alumni_id)
    {
        $nip = session('user_nip');
        
        if (!$nip) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        // Validasi apakah rekan kerja ini berhak menilai alumni tersebut
        $rekanKerjaData = eva_3_rekansejawat::with(['alumni.pegawai', 'alumni.pelatihan'])
            ->where('alumni_id', $alumni_id)
            ->where('pegawai_id', $pegawai->id)
            ->first();

        $pelatihanId = $rekanKerjaData->alumni->pelatihan_id;
            
        if (!$rekanKerjaData) {
            return redirect()->route('dashboard.rekan')->with('error', 'Anda tidak berhak menilai alumni ini.');
        }
        
        // Ambil daftar kuesioner_id yang di-assign ke pelatihan ini dari pivot (aktif dan dalam periode)
        $assignedKuesionerIds = Pelatihan_5_Pascadiklat_PelatihanKuesioner::query()
            ->where('pelatihan_id', $pelatihanId)
            ->where('is_active', 1)
            ->pluck('kuesioner_id');

        // Jika tidak ada kuesioner yang di-assign, hasilkan koleksi kosong langsung
        if ($assignedKuesionerIds->isEmpty()) {
            $kuesioner = collect();
        } else {
            $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::query()
                ->whereIn('id', $assignedKuesionerIds)
                ->active()
                ->forRole('rekan')
                ->with(['pertanyaan' => function($query) {
                    $query->orderBy('urutan');
                }, 'pertanyaan.opsiJawaban'])
                ->get();
        }
        
        return view('MenuUmum.EvaluasiPasca.rekankerja.kuesioner', compact('kuesioner', 'rekanKerjaData', 'pegawai'));
    }
    
    /**
     * Menampilkan form kuesioner spesifik untuk diisi
     */
    public function showFormKuesioner($alumni_id, $kuesioner_id)
    {
        $nip = session('user_nip');
        
        if (!$nip) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        // Validasi apakah rekan kerja ini berhak menilai alumni tersebut
        $rekanKerjaData = eva_3_rekansejawat::with(['alumni.pegawai', 'alumni.pelatihan'])
            ->where('alumni_id', $alumni_id)
            ->where('pegawai_id', $pegawai->id)
            ->first();
            
        if (!$rekanKerjaData) {
            return redirect()->route('dashboard.rekan')->with('error', 'Anda tidak berhak menilai alumni ini.');
        }
        
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::with(['pertanyaan.opsiJawaban'])
            ->where('id', $kuesioner_id)
            ->where('is_active', true)
            ->firstOrFail();
            
        // Cek apakah sudah pernah mengisi kuesioner ini untuk alumni ini
        $sudahMengisi = Pelatihan_5_Pascadiklat_Jawaban::where('pegawai_id', $pegawai->id)
            ->where('kuesioner_id', $kuesioner_id)
            ->where('pelatihan_id', $rekanKerjaData->alumni->pelatihan_id)
            ->where('role_pengisi', 'rekan')
            ->exists();
            
        if ($sudahMengisi) {
            return redirect()->route('evaluasi.rekankerja.kuesioner', $alumni_id)->with('info', 'Anda sudah mengisi kuesioner ini.');
        }
        
        // Urutkan pertanyaan berdasarkan urutan
        $pertanyaan = $kuesioner->pertanyaan()->orderBy('urutan')->get();
        
        return view('MenuUmum.EvaluasiPasca.rekankerja.form', compact('kuesioner', 'pertanyaan', 'pegawai', 'rekanKerjaData'));
    }
    
    /**
     * Menyimpan jawaban kuesioner rekan kerja
     */
    public function store(Request $request)
    {
        $request->validate([
            'kuesioner_id' => 'required|exists:pelatihan_5_pascadiklat_kuesioner,id',
            'alumni_id' => 'required|exists:pelatihan_5_pascadiklat_alumni,alumni_id',
            'jawaban' => 'required|array',
        ]);
        
        $nip = session('user_nip');
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        $alumni = eva_1_alumni::where('alumni_id', $request->alumni_id)->first();
        $alumni_store = ref_pegawais::where('id', $alumni->pegawai_id)->first();
        
        if (!$pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        // Validasi apakah rekan kerja ini berhak menilai alumni tersebut
        $rekanKerjaData = eva_3_rekansejawat::with(['alumni'])
            ->where('alumni_id', $request->alumni_id)
            ->where('pegawai_id', $pegawai->id)
            ->first();
            
        if (!$rekanKerjaData) {
            return redirect()->route('dashboard.rekan')->with('error', 'Anda tidak berhak menilai alumni ini.');
        }
        
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($request->kuesioner_id);
        
        // Cek apakah sudah pernah mengisi
        $sudahMengisi = Pelatihan_5_Pascadiklat_Jawaban::where('pegawai_id', $pegawai->id)
            ->where('kuesioner_id', $request->kuesioner_id)
            ->where('pelatihan_id', $rekanKerjaData->alumni->pelatihan_id)
            ->where('role_pengisi', 'rekan')
            ->exists();
            
        if ($sudahMengisi) {
            return redirect()->route('evaluasi.rekankerja.kuesioner', $request->alumni_id)->with('error', 'Anda sudah mengisi kuesioner ini.');
        }
        
        DB::beginTransaction();
        
        try {
            // Simpan semua jawaban
            foreach ($request->jawaban as $pertanyaan_id => $jawaban) {
                $jawabanData = [
                    'pegawai_id' => $pegawai->id,
                    'alumni_id' => $alumni_store->id,
                    'kuesioner_id' => $request->kuesioner_id,
                    'pertanyaan_id' => $pertanyaan_id,
                    'pelatihan_id' => $rekanKerjaData->alumni->pelatihan_id,
                    'role_pengisi' => 'rekan',
                    'tanggal_pengisian' => now(),
                ];
                
                // Jika jawaban berupa array (checkbox), simpan sebagai JSON
                if (is_array($jawaban)) {
                    $jawabanData['jawaban_teks'] = json_encode($jawaban);
                } elseif (is_numeric($jawaban)) {
                    // Jika jawaban berupa ID opsi jawaban
                    $jawabanData['opsi_jawaban_id'] = $jawaban;
                } else {
                    // Jika jawaban berupa teks bebas
                    $jawabanData['jawaban_teks'] = $jawaban;
                }
                
                Pelatihan_5_Pascadiklat_Jawaban::create($jawabanData);
            }
            
            // Update status penilaian rekan kerja
            $rekanKerjaData->markAsSudahDinilai();
            
            DB::commit();
            
            return redirect()->route('dashboard.rekan')->with('success', 'Terima kasih! Penilaian Anda telah berhasil disimpan.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan jawaban. Silakan coba lagi.');
        }
    }
}