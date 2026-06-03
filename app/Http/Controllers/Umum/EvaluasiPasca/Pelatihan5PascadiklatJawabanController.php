<?php

namespace App\Http\Controllers\Umum\EvaluasiPasca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pelatihan_5_Pascadiklat_Kuesioner;
use App\Models\Pelatihan_5_Pascadiklat_Pertanyaan;
use App\Models\Pelatihan_5_Pascadiklat_OpsiJawaban;
use App\Models\Pelatihan_5_Pascadiklat_Jawaban;
use App\Models\ref_pegawais;
use App\Models\ref_namapelatihan;
use App\Models\eva_1_alumni;
use App\Models\eva_2_atasan;
use App\Models\eva_3_rekansejawat;

/**
 * Mengelola pengisian dan penyimpanan jawaban kuesioner pasca diklat
 */
class Pelatihan5PascadiklatJawabanController extends Controller
{
    /**
     * Menampilkan daftar kuesioner yang tersedia untuk role tertentu
     */
    public function index(Request $request)
    {
        $role = $request->get('role', 'alumni'); // Default ke alumni
        $nip = session('user_nip');
        
        if (!$nip) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        // Ambil kuesioner yang aktif dan sesuai dengan role
        // Hanya tampilkan kuesioner untuk pelatihan yang pernah diikuti user
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::where('is_active', true)
            ->where(function($query) use ($role) {
                $query->where('role_target', $role)
                      ->orWhere('role_target', 'all');
            })
            ->with(['pelatihan' => function($query) use ($pegawai) {
                $query->wherePivot('is_active', true)
                      ->where(function($subQuery) {
                          $subQuery->whereNull('tanggal_selesai')
                                   ->orWhere('tanggal_selesai', '>=', now());
                      })
                      ->whereExists(function($existsQuery) use ($pegawai) {
                          $existsQuery->select(DB::raw(1))
                                     ->from('pelatihan_5_pascadiklat_alumni')
                                     ->whereColumn('pelatihan_5_pascadiklat_alumni.pelatihan_id', 'ref_namapelatihans.id')
                                     ->where('pelatihan_5_pascadiklat_alumni.pegawai_id', $pegawai->id);
                      });
            }])
            ->whereHas('pelatihan', function($query) use ($pegawai) {
                $query->whereExists(function($existsQuery) use ($pegawai) {
                    $existsQuery->select(DB::raw(1))
                               ->from('pelatihan_5_pascadiklat_alumni')
                               ->whereColumn('pelatihan_5_pascadiklat_alumni.pelatihan_id', 'ref_namapelatihans.id')
                               ->where('pelatihan_5_pascadiklat_alumni.pegawai_id', $pegawai->id);
                });
            })
            ->get();
        
        return view('MenuUmum.EvaluasiPasca.kuesioner.index', compact('kuesioner', 'pegawai', 'role'));
    }
    
    /**
     * Menampilkan kuesioner spesifik untuk diisi
     */
    public function show($kuesioner_id, $pelatihan_id = null)
    {
        $nip = session('user_nip');
        
        if (!$nip) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::with(['pertanyaan.opsiJawaban'])
            ->where('is_active', true)
            ->findOrFail($kuesioner_id);
        
        $pelatihan = null;
        if ($pelatihan_id) {
            $pelatihan = ref_namapelatihan::findOrFail($pelatihan_id);
        }
        
        // Untuk kuesioner alumni, cek apakah sudah memilih evaluator
        if ($kuesioner->role_target === 'alumni' || $kuesioner->role_target === 'all') {
            if ($pelatihan_id) {
                // Cari data alumni untuk pelatihan ini
                $alumniData = eva_1_alumni::where('pegawai_id', $pegawai->id)
                    ->where('pelatihan_id', $pelatihan_id)
                    ->first();
                    
                if ($alumniData) {
                    // Cek apakah sudah memilih evaluator
                    $sudahPilihAtasan = eva_2_atasan::where('alumni_id', $alumniData->alumni_id)->exists();
                    $sudahPilihRekan = eva_3_rekansejawat::where('alumni_id', $alumniData->alumni_id)->exists();
                    
                    // Jika belum memilih evaluator, redirect ke halaman pemilihan evaluator
                    if (!$sudahPilihAtasan || !$sudahPilihRekan) {
                        return redirect()->route('pascadiklat.kuesioner.select.evaluators', [$kuesioner_id, $pelatihan_id])
                            ->with('info', 'Silakan pilih evaluator (rekan kerja dan atasan) terlebih dahulu.');
                    }
                }
            }
        }
        
        // Cek apakah sudah pernah mengisi kuesioner ini untuk pelatihan ini
        $sudahMengisi = Pelatihan_5_Pascadiklat_Jawaban::where('pegawai_id', $pegawai->id)
            ->where('kuesioner_id', $kuesioner_id)
            ->when($pelatihan_id, function($query, $pelatihan_id) {
                return $query->where('pelatihan_id', $pelatihan_id);
            })
            ->exists();
        
        if ($sudahMengisi) {
            return redirect()->back()->with('warning', 'Anda sudah mengisi kuesioner ini sebelumnya.');
        }
        
        // Urutkan pertanyaan berdasarkan urutan
        $pertanyaan = $kuesioner->pertanyaan()->orderBy('urutan')->get();
        
        return view('MenuUmum.EvaluasiPasca.kuesioner.form', compact('kuesioner', 'pertanyaan', 'pegawai', 'pelatihan'));
    }
    
    /**
     * Menyimpan jawaban kuesioner
     */
    public function store(Request $request)
    {
        $request->validate([
            'kuesioner_id' => 'required|exists:pelatihan_5_pascadiklat_kuesioner,id',
            'pelatihan_id' => 'nullable|exists:ref_namapelatihans,id',
            'jawaban' => 'required|array',
            'jawaban.*' => 'required',
            'role_pengisi' => 'required|in:alumni,atasan,rekan'
        ]);
        
        $nip = session('user_nip');
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($request->kuesioner_id);
        
        // Validasi role target
        if ($kuesioner->role_target !== 'all' && $kuesioner->role_target !== $request->role_pengisi) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengisi kuesioner ini.');
        }
        
        // Cek apakah sudah pernah mengisi
        $sudahMengisi = Pelatihan_5_Pascadiklat_Jawaban::where('pegawai_id', $pegawai->id)
            ->where('kuesioner_id', $request->kuesioner_id)
            ->when($request->pelatihan_id, function($query, $pelatihan_id) {
                return $query->where('pelatihan_id', $pelatihan_id);
            })
            ->exists();
        
        if ($sudahMengisi) {
            return redirect()->back()->with('error', 'Anda sudah mengisi kuesioner ini sebelumnya.');
        }
        
        DB::beginTransaction();
        try {
            foreach ($request->jawaban as $pertanyaan_id => $jawaban) {
                $pertanyaan = Pelatihan_5_Pascadiklat_Pertanyaan::findOrFail($pertanyaan_id);
                // Validasi jawaban berdasarkan jenis pertanyaan
                if ($pertanyaan->jenis === 'pilihan_ganda' || $pertanyaan->jenis === 'radio') {
                    $opsi = Pelatihan_5_Pascadiklat_OpsiJawaban::where('id', $jawaban)
                        ->where('pertanyaan_id', $pertanyaan_id)
                        ->first();
                    if (!$opsi) {
                        throw new \Exception('Opsi jawaban tidak valid untuk pertanyaan ID: ' . $pertanyaan_id);
                    }
                    Pelatihan_5_Pascadiklat_Jawaban::create([
                        'pegawai_id' => $pegawai->id,
                        'kuesioner_id' => $request->kuesioner_id,
                        'pertanyaan_id' => $pertanyaan_id,
                        'opsi_jawaban_id' => $jawaban,
                        'jawaban_teks' => null,
                        'pelatihan_id' => $request->pelatihan_id,
                        'role_pengisi' => $request->role_pengisi,
                        'tanggal_pengisian' => now(),
                    ]);
                } elseif ($pertanyaan->jenis === 'ya_tidak') {
                    if (!in_array($jawaban, ['ya', 'tidak'])) {
                        throw new \Exception('Jawaban ya/tidak tidak valid untuk pertanyaan ID: ' . $pertanyaan_id);
                    }
                    Pelatihan_5_Pascadiklat_Jawaban::create([
                        'pegawai_id' => $pegawai->id,
                        'kuesioner_id' => $request->kuesioner_id,
                        'pertanyaan_id' => $pertanyaan_id,
                        'opsi_jawaban_id' => null,
                        'jawaban_teks' => $jawaban,
                        'pelatihan_id' => $request->pelatihan_id,
                        'role_pengisi' => $request->role_pengisi,
                        'tanggal_pengisian' => now(),
                    ]);
                } else {
                    Pelatihan_5_Pascadiklat_Jawaban::create([
                        'pegawai_id' => $pegawai->id,
                        'kuesioner_id' => $request->kuesioner_id,
                        'pertanyaan_id' => $pertanyaan_id,
                        'opsi_jawaban_id' => null,
                        'jawaban_teks' => $jawaban,
                        'pelatihan_id' => $request->pelatihan_id,
                        'role_pengisi' => $request->role_pengisi,
                        'tanggal_pengisian' => now(),
                    ]);
                }
            }

            // Mark as sudah dinilai jika role_pengisi adalah alumni, atasan, atau rekan
            if ($request->role_pengisi === 'alumni' && $request->pelatihan_id) {
                $alumniData = eva_1_alumni::where('pegawai_id', $pegawai->id)
                    ->where('pelatihan_id', $request->pelatihan_id)
                    ->first();
                if ($alumniData && method_exists($alumniData, 'markAsSudahDinilai')) {
                    $alumniData->markAsSudahDinilai();
                }
            } elseif ($request->role_pengisi === 'atasan' && $request->pelatihan_id) {
                $atasanData = eva_2_atasan::where('pegawai_id', $pegawai->id)
                    ->where('pelatihan_id', $request->pelatihan_id)
                    ->first();
                if ($atasanData && method_exists($atasanData, 'markAsSudahDinilai')) {
                    $atasanData->markAsSudahDinilai();
                }
            } elseif ($request->role_pengisi === 'rekan' && $request->pelatihan_id) {
                $rekanData = eva_3_rekansejawat::where('pegawai_id', $pegawai->id)
                    ->where('pelatihan_id', $request->pelatihan_id)
                    ->first();
                if ($rekanData && method_exists($rekanData, 'markAsSudahDinilai')) {
                    $rekanData->markAsSudahDinilai();
                }
            }

            DB::commit();
            return redirect()->route('pascadiklat.kuesioner.index', ['role' => $request->role_pengisi])
                ->with('success', 'Kuesioner berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Menampilkan hasil jawaban kuesioner
     */
    public function results($kuesioner_id, $pelatihan_id = null)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::with(['pertanyaan.opsiJawaban'])
            ->findOrFail($kuesioner_id);
        
        $jawaban = Pelatihan_5_Pascadiklat_Jawaban::with(['pegawai', 'pertanyaan', 'opsiJawaban', 'pelatihan'])
            ->where('kuesioner_id', $kuesioner_id)
            ->when($pelatihan_id, function($query, $pelatihan_id) {
                return $query->where('pelatihan_id', $pelatihan_id);
            })
            ->get();
        
        $pelatihan = null;
        if ($pelatihan_id) {
            $pelatihan = ref_namapelatihan::findOrFail($pelatihan_id);
        }
        
        return view('MenuUmum.EvaluasiPasca.kuesioner.results', compact('kuesioner', 'jawaban', 'pelatihan'));
    }
    
    /**
     * Menampilkan halaman pemilihan evaluator (rekan kerja dan atasan)
     */
    public function showSelectEvaluators($kuesioner_id, $pelatihan_id = null)
    {
        $nip = session('user_nip');
        
        if (!$nip) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::where('is_active', true)
            ->findOrFail($kuesioner_id);
        
        $pelatihan = null;
        if ($pelatihan_id) {
            $pelatihan = ref_namapelatihan::findOrFail($pelatihan_id);
        }
        
        // Cari data alumni untuk pelatihan ini
        $alumniData = eva_1_alumni::where('pegawai_id', $pegawai->id)
            ->where('pelatihan_id', $pelatihan_id)
            ->first();
            
        if (!$alumniData) {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan untuk pelatihan ini.');
        }
        
        // Cek apakah sudah pernah memilih evaluator
        $sudahPilihAtasan = eva_2_atasan::where('alumni_id', $alumniData->alumni_id)->exists();
        $sudahPilihRekan = eva_3_rekansejawat::where('alumni_id', $alumniData->alumni_id)->exists();
        
        if ($sudahPilihAtasan && $sudahPilihRekan) {
            return redirect()->route('pascadiklat.kuesioner.show.pelatihan', [$kuesioner_id, $pelatihan_id])
                ->with('info', 'Anda sudah memilih evaluator sebelumnya.');
        }
        
        // Ambil daftar pegawai untuk dijadikan rekan kerja (exclude diri sendiri)
        $rekanKerja = ref_pegawais::where('id', '!=', $pegawai->id)
            ->when($pegawai->kode_unitkerja, function($query) use ($pegawai) {
                return $query->where('kode_unitkerja', $pegawai->kode_unitkerja);
            })
            ->orderBy('nama')
            ->get();
        
        // Ambil daftar pegawai untuk dijadikan atasan (exclude diri sendiri)
        $atasan = ref_pegawais::where('id', '!=', $pegawai->id)
            ->when($pegawai->kode_unitkerja, function($query) use ($pegawai) {
                return $query->where('kode_unitkerja', $pegawai->kode_unitkerja);
            })
            ->orderBy('nama')
            ->get();
        
        return view('MenuUmum.EvaluasiPasca.kuesioner.selectEvaluators', compact(
            'kuesioner', 'pelatihan', 'alumniData', 'rekanKerja', 'atasan', 'pegawai'
        ));
    }
    
    /**
     * Menyimpan pilihan evaluator (rekan kerja dan atasan)
     */
    public function storeEvaluators(Request $request)
    {
        $request->validate([
            'kuesioner_id' => 'required|exists:pelatihan_5_pascadiklat_kuesioner,id',
            'pelatihan_id' => 'required|exists:ref_namapelatihans,id',
            'alumni_id' => 'required|exists:pelatihan_5_pascadiklat_alumni,alumni_id',
            'rekan_kerja' => 'required|exists:ref_pegawais,id',
            'atasan' => 'required|array|min:1',
            'atasan.*' => 'exists:ref_pegawais,id'
        ]);
        
        $nip = session('user_nip');
        $pegawai = ref_pegawais::where('nip', $nip)->first();
        
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }
        
        // Validasi bahwa alumni_id milik pegawai yang login
        $alumniData = eva_1_alumni::where('alumni_id', $request->alumni_id)
            ->where('pegawai_id', $pegawai->id)
            ->where('pelatihan_id', $request->pelatihan_id)
            ->first();
            
        if (!$alumniData) {
            return redirect()->back()->with('error', 'Data alumni tidak valid.');
        }
        
        // Validasi tidak boleh memilih diri sendiri
        if ($request->rekan_kerja == $pegawai->id) {
            return redirect()->back()->with('error', 'Anda tidak boleh memilih diri sendiri sebagai rekan kerja.');
        }
        
        if (in_array($pegawai->id, $request->atasan)) {
            return redirect()->back()->with('error', 'Anda tidak boleh memilih diri sendiri sebagai atasan.');
        }
        
        DB::beginTransaction();
        
        try {
            // Hapus data evaluator lama jika ada
            eva_2_atasan::where('alumni_id', $request->alumni_id)->delete();
            eva_3_rekansejawat::where('alumni_id', $request->alumni_id)->delete();
            
            // Simpan rekan kerja
            eva_3_rekansejawat::create([
                'alumni_id' => $request->alumni_id,
                'pegawai_id' => $request->rekan_kerja,
                'pelatihan_id' => $request->pelatihan_id,
                'status_penilaian' => eva_3_rekansejawat::STATUS_BELUM_DINILAI
            ]);
            
            // Simpan atasan (bisa lebih dari 1)
            foreach ($request->atasan as $atasan_id) {
                eva_2_atasan::create([
                    'alumni_id' => $request->alumni_id,
                    'pegawai_id' => $atasan_id,
                    'pelatihan_id' => $request->pelatihan_id,
                    'status_penilaian' => eva_2_atasan::STATUS_BELUM_DINILAI
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('pascadiklat.kuesioner.show.pelatihan', [
                $request->kuesioner_id, 
                $request->pelatihan_id
            ])->with('success', 'Evaluator berhasil dipilih! Sekarang Anda bisa mengisi kuesioner.');
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Mendapatkan daftar pelatihan yang pernah diikuti pegawai (untuk alumni)
     */
    public function getPelatihanPegawai($pegawai_id)
    {
        // Ambil pelatihan yang pernah diikuti oleh pegawai ini dari tabel alumni
        $pelatihan = ref_namapelatihan::whereHas('alumni', function($query) use ($pegawai_id) {
            $query->where('pegawai_id', $pegawai_id);
        })->whereHas('kuesioner', function($query) {
            $query->where('pelatihan_5_pascadiklat_kuesioner.is_active', true)
                  ->where(function($subQuery) {
                      $subQuery->where('pelatihan_5_pascadiklat_kuesioner.role_target', 'alumni')
                               ->orWhere('pelatihan_5_pascadiklat_kuesioner.role_target', 'all');
                  });
        })->get();
        
        return response()->json($pelatihan);
    }
}