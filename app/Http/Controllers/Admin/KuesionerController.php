<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatihan_5_Pascadiklat_Kuesioner;
use App\Models\ref_namapelatihan as Pelatihan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

/**
 * Admin: Mengelola template kuesioner evaluasi pasca diklat
 */
class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kuesioners = Pelatihan_5_Pascadiklat_Kuesioner::orderBy('created_at', 'desc')->get();
        return view('Admin.Evaluasi.kuesioner.index', compact('kuesioners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Evaluasi.kuesioner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'role_target' => ['required', Rule::in(['alumni', 'atasan', 'rekan'])],
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kuesioner = new Pelatihan_5_Pascadiklat_Kuesioner();
        $kuesioner->judul = $request->judul;
        $kuesioner->deskripsi = $request->deskripsi;
        $kuesioner->role_target = $request->role_target;
        $kuesioner->is_active = $request->has('is_active');
        $kuesioner->save();

        return redirect()->route('admin.kuesioner.index')
            ->with('success', 'Kuesioner berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::with(['pertanyaan' => function($query) {
            $query->orderBy('urutan', 'asc');
        }])->findOrFail($id);

        return view('Admin.Evaluasi.kuesioner.show', compact('kuesioner'));
    }

    /**
     * Tampilkan form untuk assign kuesioner ke pelatihan
     */
    public function assignForm(string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::with('pelatihan')->findOrFail($id);
        // Ambil daftar pelatihan yang tersedia
        $pelatihanList = Pelatihan::orderBy('id', 'desc')->get();

        return view('Admin.Evaluasi.kuesioner.assign', compact('kuesioner', 'pelatihanList'));
    }

    /**
     * Assign kuesioner ke pelatihan (attach)
     */
    public function assign(Request $request, string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($id);

        $request->validate([
            'pelatihan_id' => 'required|integer',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'is_active' => 'nullable|boolean',
        ]);

        $pelatihanId = $request->pelatihan_id;

        // attach with pivot data (if already attached, syncWithoutDetaching to update pivot)
        $kuesioner->pelatihan()->syncWithoutDetaching([
            $pelatihanId => [
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]
        ]);

        return redirect()->route('admin.kuesioner.assign.form', $kuesioner->id)
            ->with('success', 'Kuesioner berhasil di-assign ke pelatihan.');
    }

    /**
     * Unassign kuesioner dari pelatihan (detach)
     */
    public function unassign(string $id, string $pelatihan_id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($id);
        $kuesioner->pelatihan()->detach($pelatihan_id);

        return redirect()->route('admin.kuesioner.assign.form', $kuesioner->id)
            ->with('success', 'Kuesioner berhasil di-unassign dari pelatihan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($id);
        return view('Admin.Evaluasi.kuesioner.edit', compact('kuesioner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'role_target' => ['required', Rule::in(['alumni', 'atasan', 'rekan'])],
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($id);
        $kuesioner->judul = $request->judul;
        $kuesioner->deskripsi = $request->deskripsi;
        $kuesioner->role_target = $request->role_target;
        $kuesioner->is_active = $request->has('is_active');
        $kuesioner->save();

        return redirect()->route('admin.kuesioner.index')
            ->with('success', 'Kuesioner berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kuesioner = Pelatihan_5_Pascadiklat_Kuesioner::findOrFail($id);
        $kuesioner->delete();

        return redirect()->route('admin.kuesioner.index')
            ->with('success', 'Kuesioner berhasil dihapus!');
    }
}
