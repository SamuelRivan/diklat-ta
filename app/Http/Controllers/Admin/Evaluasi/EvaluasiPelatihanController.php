<?php

namespace App\Http\Controllers\Admin\Evaluasi;

use App\Http\Controllers\Controller;
use App\Models\ref_namapelatihan;
use App\Models\ref_jenispelatihans;
use App\Models\ref_pegawais;
use App\Models\eva_1_alumni;
use App\Models\Pelatihan_5_Pascadiklat_Kuesioner;
use App\Models\Pelatihan_5_Pascadiklat_Jawaban;
use App\Models\eva_2_atasan;
use App\Models\eva_3_rekansejawat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/**
 * Admin: Mengelola data pelatihan yang akan dievaluasi (Pascadiklat)
 */
class EvaluasiPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatihans = ref_namapelatihan::with('jenisPelatihan')->latest()->get();
        
        return view('Admin.Evaluasi.pelatihan.index', compact('pelatihans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenispelatihans = ref_jenispelatihans::all();

        return view('Admin.Evaluasi.pelatihan.create', compact('jenispelatihans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pelatihan_id' => 'required|exists:ref_jenispelatihans,id',
            'nama_pelatihan' => 'required|string|max:255|unique:ref_namapelatihans,nama_pelatihan',
        ], [
            'jenis_pelatihan_id.required' => 'Jenis pelatihan harus dipilih',
            'jenis_pelatihan_id.exists' => 'Jenis pelatihan tidak valid',
            'nama_pelatihan.required' => 'Nama pelatihan harus diisi',
            'nama_pelatihan.unique' => 'Nama pelatihan sudah ada',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            ref_namapelatihan::create([
                'jenis_pelatihan_id' => $request->jenis_pelatihan_id,
                'nama_pelatihan' => $request->nama_pelatihan,
            ]);

            return redirect()->route('admin.evaluasi.pelatihan.index')
                ->with('success', 'Data pelatihan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelatihan = ref_namapelatihan::with('jenisPelatihan', 'alumni.pegawai')->findOrFail($id);

        return view('Admin.Evaluasi.pelatihan.show', compact('pelatihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelatihan = ref_namapelatihan::findOrFail($id);
        $jenispelatihans = ref_jenispelatihans::all();

        return view('Admin.Evaluasi.pelatihan.edit', compact('pelatihan', 'jenispelatihans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelatihan = ref_namapelatihan::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'jenis_pelatihan_id' => 'required|exists:ref_jenispelatihans,id',
            'nama_pelatihan' => 'required|string|max:255|unique:ref_namapelatihans,nama_pelatihan,' . $id,
        ], [
            'jenis_pelatihan_id.required' => 'Jenis pelatihan harus dipilih',
            'jenis_pelatihan_id.exists' => 'Jenis pelatihan tidak valid',
            'nama_pelatihan.required' => 'Nama pelatihan harus diisi',
            'nama_pelatihan.unique' => 'Nama pelatihan sudah ada',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $pelatihan->update([
                'jenis_pelatihan_id' => $request->jenis_pelatihan_id,
                'nama_pelatihan' => $request->nama_pelatihan,
            ]);

            return redirect()->route('admin.evaluasi.pelatihan.index')
                ->with('success', 'Data pelatihan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pelatihan = ref_namapelatihan::findOrFail($id);
            
            // Cek apakah pelatihan sudah digunakan di tabel alumni
            if ($pelatihan->alumni()->count() > 0) {
                return redirect()->route('admin.evaluasi.pelatihan.index')
                    ->with('error', 'Data pelatihan tidak dapat dihapus karena sudah digunakan di data alumni!');
            }
            
            $pelatihan->delete();

            return redirect()->route('admin.evaluasi.pelatihan.index')
                ->with('success', 'Data pelatihan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.evaluasi.pelatihan.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show form to add multiple alumni to the training
     */
    public function createAlumni(string $id)
    {
        $pelatihan = ref_namapelatihan::findOrFail($id);
        
        // Get all pegawai yang belum menjadi alumni untuk pelatihan ini
        $existingAlumniIds = $pelatihan->alumni()->pluck('pegawai_id')->toArray();
        $pegawais = ref_pegawais::whereNotIn('id', $existingAlumniIds)->get();

        return view('Admin.Evaluasi.pelatihan.create_alumni', compact('pelatihan', 'pegawais'));
    }

    /**
     * Store multiple alumni for the training
     */
    public function storeAlumni(Request $request, string $id)
    {
        $pelatihan = ref_namapelatihan::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'pegawai_ids' => 'required|array|min:1',
            'pegawai_ids.*' => 'required|exists:ref_pegawais,id',
            'tanggal_mulai_pelatihan' => 'required|date',
            'tanggal_selesai_pelatihan' => 'required|date|after_or_equal:tanggal_mulai_pelatihan',
            'status_alumni' => 'required|in:belum_dinilai,sedang_dinilai,sudah_dinilai',
        ], [
            'pegawai_ids.required' => 'Minimal satu pegawai harus dipilih',
            'pegawai_ids.array' => 'Format data pegawai tidak valid',
            'pegawai_ids.min' => 'Minimal satu pegawai harus dipilih',
            'pegawai_ids.*.exists' => 'Pegawai yang dipilih tidak valid',
            'tanggal_mulai_pelatihan.required' => 'Tanggal mulai pelatihan harus diisi',
            'tanggal_selesai_pelatihan.required' => 'Tanggal selesai pelatihan harus diisi',
            'tanggal_selesai_pelatihan.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
            'status_alumni.required' => 'Status alumni harus dipilih',
            'status_alumni.in' => 'Status alumni tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Check for duplicates
            $existingAlumniIds = $pelatihan->alumni()->pluck('pegawai_id')->toArray();
            $duplicates = array_intersect($request->pegawai_ids, $existingAlumniIds);
            
            if (!empty($duplicates)) {
                $duplicateNames = ref_pegawais::whereIn('id', $duplicates)->pluck('nama_lengkap')->toArray();
                return redirect()->back()
                    ->with('error', 'Pegawai berikut sudah terdaftar sebagai alumni: ' . implode(', ', $duplicateNames))
                    ->withInput();
            }

            // Bulk insert alumni
            $alumniData = [];
            foreach ($request->pegawai_ids as $pegawai_id) {
                $alumniData[] = [
                    'pegawai_id' => $pegawai_id,
                    'pelatihan_id' => $pelatihan->id,
                    'tanggal_mulai_pelatihan' => $request->tanggal_mulai_pelatihan,
                    'tanggal_selesai_pelatihan' => $request->tanggal_selesai_pelatihan,
                    'status_alumni' => $request->status_alumni,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            eva_1_alumni::insert($alumniData);

            $totalAdded = count($request->pegawai_ids);
            return redirect()->route('admin.evaluasi.pelatihan.show', $id)
                ->with('success', "Berhasil menambahkan {$totalAdded} alumni ke pelatihan {$pelatihan->nama_pelatihan}!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove alumni from training
     */
    public function removeAlumni(string $pelatihanId, string $alumniId)
    {
        try {
            $pelatihan = ref_namapelatihan::findOrFail($pelatihanId);
            $alumni = eva_1_alumni::where('alumni_id', $alumniId)
                ->where('pelatihan_id', $pelatihanId)
                ->firstOrFail();
            
            $alumni->delete();

            return redirect()->route('admin.evaluasi.pelatihan.show', $pelatihanId)
                ->with('success', 'Alumni berhasil dihapus dari pelatihan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update status alumni
     */
    public function updateAlumniStatus(Request $request, string $pelatihanId, string $alumniId)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:belum_dinilai,sedang_dinilai,sudah_dinilai',
        ], [
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        try {
            $alumni = eva_1_alumni::where('alumni_id', $alumniId)
                ->where('pelatihan_id', $pelatihanId)
                ->firstOrFail();
            
            $alumni->update([
                'status_alumni' => $request->status
            ]);

            $statusLabel = [
                'belum_dinilai' => 'Belum Dinilai',
                'sedang_dinilai' => 'Sedang Dinilai',
                'sudah_dinilai' => 'Sudah Dinilai',
            ];

            return redirect()->route('admin.evaluasi.pelatihan.show', $pelatihanId)
                ->with('success', 'Status alumni berhasil diubah menjadi: ' . $statusLabel[$request->status]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan jawaban kuesioner untuk seorang alumni (beserta jawaban atasan & rekan) pada pelatihan ini.
     *
     * @param string $pelatihanId
     * @param string $alumniId
     */
    public function showAlumniAnswers(string $pelatihanId, string $alumniId)
    {
        $pelatihan = ref_namapelatihan::with('kuesioner')->findOrFail($pelatihanId);
        $alumni = eva_1_alumni::with(['pegawai', 'atasan.pegawai', 'rekanKerja.pegawai'])
            ->where('alumni_id', $alumniId)
            ->where('pelatihan_id', $pelatihanId)
            ->firstOrFail();

        // Ambil semua kuesioner yang ter-assign pada pelatihan ini (aktif maupun tidak, bisa difilter)
        $kuesionerIds = $pelatihan->kuesioner->pluck('id')->toArray();

        // Kelompokkan jawaban berdasarkan peran pengisi
        $jawabanAlumni = Pelatihan_5_Pascadiklat_Jawaban::with(['pertanyaan.opsiJawaban','opsiJawaban','kuesioner'])
            ->whereIn('kuesioner_id', $kuesionerIds)
            ->where('pelatihan_id', $pelatihanId)
            ->where('pegawai_id', $alumni->pegawai_id)
            ->where('role_pengisi', 'alumni')
            ->get()
            ->groupBy('kuesioner_id');

        // Jawaban atasan: kumpulkan semua pegawai atasan lalu ambil jawaban mereka
        $atasanPegawaiIds = $alumni->atasan->pluck('pegawai_id')->toArray();
        $jawabanAtasan = [];
        if (!empty($atasanPegawaiIds)) {
            $jawabanAtasan = Pelatihan_5_Pascadiklat_Jawaban::with(['pertanyaan.opsiJawaban','opsiJawaban','kuesioner','pegawai'])
                ->whereIn('kuesioner_id', $kuesionerIds)
                ->where('pelatihan_id', $pelatihanId)
                ->whereIn('pegawai_id', $atasanPegawaiIds)
                ->where('role_pengisi', 'atasan')
                ->get()
                ->groupBy(function($item){
                    return $item->kuesioner_id.'|'.$item->pegawai_id; // group per kuesioner per atasan
                });
        }

        // Jawaban rekan kerja (maks 1 rekan)
        $rekanPegawaiId = optional($alumni->rekanKerja)->pegawai_id;
        $jawabanRekan = collect();
        if ($rekanPegawaiId) {
            $jawabanRekan = Pelatihan_5_Pascadiklat_Jawaban::with(['pertanyaan.opsiJawaban','opsiJawaban','kuesioner','pegawai'])
                ->whereIn('kuesioner_id', $kuesionerIds)
                ->where('pelatihan_id', $pelatihanId)
                ->where('pegawai_id', $rekanPegawaiId)
                ->where('role_pengisi', 'rekan')
                ->get()
                ->groupBy('kuesioner_id');
        }

        // Ambil definisi kuesioner beserta pertanyaan untuk ditampilkan berurutan
        $kuesioners = Pelatihan_5_Pascadiklat_Kuesioner::with(['pertanyaan' => function($q){
            $q->orderBy('urutan');
        }])->whereIn('id', $kuesionerIds)->get();

        // Hitung statistik jawaban global untuk pelatihan ini (untuk chart & resume)
        // Kita butuh data: Pertanyaan ID -> [ {Opsi: 'A', Jumlah: 10}, {Opsi: 'B', Jumlah: 5} ]
        // Hanya untuk pertanyaan pilihan ganda (punya opsi)
        $globalStats = Pelatihan_5_Pascadiklat_Jawaban::where('pelatihan_id', $pelatihanId)
            ->whereNotNull('opsi_jawaban_id')
            ->with('opsiJawaban')
            ->select('pertanyaan_id', 'opsi_jawaban_id', DB::raw('count(*) as total'))
            ->groupBy('pertanyaan_id', 'opsi_jawaban_id')
            ->get()
            ->groupBy('pertanyaan_id');

        return view('Admin.Evaluasi.pelatihan.alumni_answers', compact(
            'pelatihan',
            'alumni',
            'kuesioners',
            'jawabanAlumni',
            'jawabanAtasan',
            'jawabanRekan',
            'globalStats'
        ));
    }
}
