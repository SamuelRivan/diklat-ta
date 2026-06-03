<?php

namespace App\Http\Controllers\Admin\Evaluasi;

use App\Models\ref_namapelatihan;
use App\Models\eva_1_alumni;
use App\Models\Pelatihan_5_Pascadiklat_Jawaban;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Evaluasi\EvaluasiExport;

/**
 * Admin: Mengelola data alumni yang mengikuti evaluasi pasca pelatihan
 */
class AlumniAdminController extends Controller
{
    // Menampilkan daftar pelatihan dengan pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pelatihan_5_pascadiklat_alumni = eva_1_alumni::with(['pegawai', 'pelatihan.jenisPelatihan'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('pelatihan', function ($q) use ($search) {
                    $q->where('nama_pelatihan', 'LIKE', "%{$search}%")
                      ->orWhereHas('jenisPelatihan', function ($jq) use ($search) {
                          $jq->where('jenis_pelatihan', 'LIKE', "%{$search}%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $pelatihans = ref_namapelatihan::orderBy('nama_pelatihan')->get();

        return view('Admin.Evaluasi.alumni', compact('pelatihan_5_pascadiklat_alumni', 'pelatihans'));
    }

    // Menampilkan form edit pelatihan
    public function edit($id)
    {
        $pelatihan_5_pascadiklat_alumni = eva_1_alumni::with(['pegawai', 'pelatihan.jenisPelatihan'])->findOrFail($id);
        return view('Admin.Evaluasi.editalumni', compact('pelatihan_5_pascadiklat_alumni'));
    }

    // Memperbarui data pelatihan
    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:ref_pegawais,id',
            'pelatihan_id' => 'required|exists:ref_namapelatihan,id',
            'tanggal_mulai_pelatihan' => 'required|date',
            'tanggal_selesai_pelatihan' => 'required|date|after_or_equal:tanggal_mulai_pelatihan',
            'status_alumni' => 'required|in:belum_dinilai,sedang_dinilai,sudah_dinilai',
        ]);

        $pelatihan_5_pascadiklat_alumni = eva_1_alumni::findOrFail($id);
        $pelatihan_5_pascadiklat_alumni->update([
            'pegawai_id' => $request->pegawai_id,
            'pelatihan_id' => $request->pelatihan_id,
            'tanggal_mulai_pelatihan' => $request->tanggal_mulai_pelatihan,
            'tanggal_selesai_pelatihan' => $request->tanggal_selesai_pelatihan,
            'status_alumni' => $request->status_alumni,
        ]);

        return redirect()->route('evaluasi.alumni')->with('success', 'Data alumni berhasil diperbarui.');
    }

    // Menghapus data alumni
    public function destroy($id, Request $request)
    {
        $alumni = eva_1_alumni::findOrFail($id);
        $pelatihan_id = $alumni->pelatihan_id;
        $alumni->delete();

        // Redirect berdasarkan konteks
        if ($request->query('from') == 'pelatihan' && $pelatihan_id) {
            return redirect()->route('admin.evaluasi.pelatihan.show', $pelatihan_id)
                ->with('success', 'Alumni berhasil dihapus dari pelatihan.');
        }

        return redirect()->route('evaluasi.alumni')->with('success', 'Data alumni berhasil dihapus.');
    }

    // Menampilkan detail pelatihan
    public function view($id)
    {
        $pelatihan_5_pascadiklat_alumni = eva_1_alumni::with([
            'pegawai',
            'pelatihan.jenisPelatihan'
        ])->findOrFail($id);

        // Query jawaban kuesioner secara manual (seperti di showAlumniAnswers)
        $jawabanKuesioner = Pelatihan_5_Pascadiklat_Jawaban::with(['pertanyaan', 'opsiJawaban', 'kuesioner'])
            ->where('pelatihan_id', $pelatihan_5_pascadiklat_alumni->pelatihan_id)
            ->where('pegawai_id', $pelatihan_5_pascadiklat_alumni->pegawai_id)
            ->orderBy('pertanyaan_id')
            ->get();

        // Set jawabanKuesioner untuk kompatibilitas dengan view
        $pelatihan_5_pascadiklat_alumni->setRelation('jawabanKuesioner', $jawabanKuesioner);

        return view('admin.evaluasi.viewalumni', compact('pelatihan_5_pascadiklat_alumni'));
    }

    // Mengubah status pelatihan
    public function toggleStatus($id)
    {
        $pelatihan_5_pascadiklat_alumni = eva_1_alumni::findOrFail($id);
        $pelatihan_5_pascadiklat_alumni->Status_peserta = $pelatihan_5_pascadiklat_alumni->Status_peserta == 'Alumni' ? 'Non Alumni' : 'Alumni';
        $pelatihan_5_pascadiklat_alumni->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

    public function export(Request $request)
    {
        $pelatihan_id = $request->input('pelatihan_id');
        $pegawai_id = $request->input('pegawai_id');

        if (!$pelatihan_id && !$pegawai_id) {
            return redirect()->back()->with('error', 'Silakan pilih Pelatihan atau Alumni untuk diexport.');
        }

        return Excel::download(new EvaluasiExport($pelatihan_id, $pegawai_id), 'Evaluasi_Alumni_' . date('Y-m-d_H-i') . '.xlsx');
    }
}
