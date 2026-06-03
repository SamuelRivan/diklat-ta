<?php

namespace App\Http\Controllers\Admin\Evaluasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatihan_5_Pascadiklat_Pertanyaan;
use App\Models\Pelatihan_5_Pascadiklat_Kuesioner;
use App\Models\Pelatihan_5_Pascadiklat_OpsiJawaban;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Admin: Mengelola daftar pertanyaan dalam kuesioner evaluasi
 */
class PertanyaanController extends Controller
{
    /**
     * Update the order of questions in a questionnaire.
     */
    public function updateUrutan(Request $request, string $kuesioner_id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan_ids' => 'required|array',
            'pertanyaan_ids.*' => 'exists:pelatihan_5_pascadiklat_pertanyaan,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            foreach ($request->pertanyaan_ids as $index => $id) {
                Pelatihan_5_Pascadiklat_Pertanyaan::where('id', $id)
                    ->update(['urutan' => $index + 1]);
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui urutan'], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $kuesioner_id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($kuesioner_id);
        $pertanyaans = Pelatihan_5_Pascadiklat_Pertanyaan::where('kuesioner_id', $kuesioner_id)
            ->orderBy('urutan', 'asc')
            ->paginate(10);

        return view('Admin.Evaluasi.pertanyaan.index', compact('kuesioner', 'pertanyaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $kuesioner_id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($kuesioner_id);
        return view('Admin.Evaluasi.pertanyaan.create', compact('kuesioner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $kuesioner_id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|string',
            'jenis' => ['required', Rule::in(['pilihan_ganda', 'pertanyaan_singkat', 'ya_tidak'])],
            'urutan' => 'nullable|integer|min:0',
            'wajib' => 'boolean',
            'opsi_jawaban' => 'required_if:jenis,pilihan_ganda|array',
            'opsi_jawaban.*' => 'required_if:jenis,pilihan_ganda|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($kuesioner_id);

            // Hitung urutan terakhir jika tidak diisi
            if (empty($request->urutan)) {
                $lastOrder = Pelatihan_5_Pascadiklat_Pertanyaan::where('kuesioner_id', $kuesioner_id)
                    ->max('urutan');
                $urutan = $lastOrder + 1;
            } else {
                $urutan = $request->urutan;
            }

            $pertanyaan = new Pelatihan_5_Pascadiklat_Pertanyaan();
            $pertanyaan->kuesioner_id = $kuesioner_id;
            $pertanyaan->pertanyaan = $request->pertanyaan;
            $pertanyaan->jenis = $request->jenis;
            $pertanyaan->urutan = $urutan;
            $pertanyaan->wajib = $request->has('wajib');
            $pertanyaan->save();

            // Simpan opsi jawaban jika jenis pertanyaan adalah pilihan ganda
            if ($request->jenis == 'pilihan_ganda' && is_array($request->opsi_jawaban)) {
                foreach ($request->opsi_jawaban as $key => $opsi) {
                    if (!empty($opsi)) {
                        $opsiJawaban = new Pelatihan_5_Pascadiklat_OpsiJawaban();
                        $opsiJawaban->pertanyaan_id = $pertanyaan->id;
                        $opsiJawaban->teks_opsi = $opsi;
                        $opsiJawaban->urutan = $key + 1;
                        $opsiJawaban->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.kuesioner.pertanyaan.index', $kuesioner_id)
                ->with('success', 'Pertanyaan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kuesioner_id, string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($kuesioner_id);
        $pertanyaan = Pelatihan_5_Pascadiklat_Pertanyaan::with('opsiJawaban')->findOrFail($id);

        return view('Admin.Evaluasi.pertanyaan.show', compact('kuesioner', 'pertanyaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kuesioner_id, string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($kuesioner_id);
        $pertanyaan = Pelatihan_5_Pascadiklat_Pertanyaan::with('opsiJawaban')->findOrFail($id);

        return view('Admin.Evaluasi.pertanyaan.edit', compact('kuesioner', 'pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kuesioner_id, string $id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|string',
            'jenis' => ['required', Rule::in(['pilihan_ganda', 'pertanyaan_singkat', 'ya_tidak'])],
            'urutan' => 'nullable|integer|min:0',
            'wajib' => 'boolean',
            'opsi_jawaban' => 'required_if:jenis,pilihan_ganda|array',
            'opsi_jawaban.*' => 'required_if:jenis,pilihan_ganda|string|max:255',
            'opsi_id.*' => 'nullable|integer|exists:pelatihan_5_pascadiklat_opsi_jawaban,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($kuesioner_id);
            $pertanyaan = Pelatihan_5_Pascadiklat_Pertanyaan::findOrFail($id);

            // Update data pertanyaan
            $pertanyaan->pertanyaan = $request->pertanyaan;
            $pertanyaan->jenis = $request->jenis;
            $pertanyaan->urutan = $request->urutan ?? $pertanyaan->urutan;
            $pertanyaan->wajib = $request->has('wajib');
            $pertanyaan->save();

            // Jika jenis pertanyaan adalah pilihan ganda, update opsi jawaban
            if ($request->jenis == 'pilihan_ganda' && is_array($request->opsi_jawaban)) {
                // Hapus opsi yang tidak ada di request
                if (isset($request->opsi_id) && is_array($request->opsi_id)) {
                    Pelatihan_5_Pascadiklat_OpsiJawaban::where('pertanyaan_id', $id)
                        ->whereNotIn('id', array_filter($request->opsi_id))
                        ->delete();
                } else {
                    // Jika tidak ada opsi_id, hapus semua opsi lama
                    Pelatihan_5_Pascadiklat_OpsiJawaban::where('pertanyaan_id', $id)->delete();
                }

                // Update atau buat opsi baru
                foreach ($request->opsi_jawaban as $key => $opsi) {
                    if (!empty($opsi)) {
                        $opsi_id = $request->opsi_id[$key] ?? null;

                        if ($opsi_id) {
                            $opsiJawaban = Pelatihan_5_Pascadiklat_OpsiJawaban::find($opsi_id);
                            if ($opsiJawaban) {
                                $opsiJawaban->teks_opsi = $opsi;
                                $opsiJawaban->urutan = $key + 1;
                                $opsiJawaban->save();
                                continue;
                            }
                        }

                        // Buat opsi baru
                        $opsiJawaban = new Pelatihan_5_Pascadiklat_OpsiJawaban();
                        $opsiJawaban->pertanyaan_id = $pertanyaan->id;
                        $opsiJawaban->teks_opsi = $opsi;
                        $opsiJawaban->urutan = $key + 1;
                        $opsiJawaban->save();
                    }
                }
            } else {
                // Jika bukan pilihan ganda, hapus semua opsi jawaban
                Pelatihan_5_Pascadiklat_OpsiJawaban::where('pertanyaan_id', $id)->delete();
            }

            DB::commit();

            return redirect()->route('admin.kuesioner.pertanyaan.index', $kuesioner_id)
                ->with('success', 'Pertanyaan berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kuesioner_id, string $id)
    {
        try {
            $pertanyaan = Pelatihan_5_Pascadiklat_Pertanyaan::findOrFail($id);
            $pertanyaan->delete();

            return redirect()->route('admin.kuesioner.pertanyaan.index', $kuesioner_id)
                ->with('success', 'Pertanyaan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
