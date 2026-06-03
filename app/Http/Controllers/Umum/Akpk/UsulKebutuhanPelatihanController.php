<?php

namespace App\Http\Controllers\Umum\Akpk;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UsulKebutuhanPelatihan;

class UsulKebutuhanPelatihanController extends Controller
{
    public function index()
    {
        $akpk_5_usulankebutuhanpelatihans = UsulKebutuhanPelatihan::paginate(10); // Paginate the data

        $currentPage = $akpk_5_usulankebutuhanpelatihans->currentPage();
        $totalPages = $akpk_5_usulankebutuhanpelatihans->lastPage();

        // Pass the variable to the view
        return view('MenuUmum.Akpk.UsulanPelatihan.UsulanKebutuhanPelatihan.usulankebutuhanpelatihan', compact('akpk_5_usulankebutuhanpelatihans', 'currentPage', 'totalPages'));
    }

    public function create()
    {
        return view('MenuUmum.Akpk.UsulanPelatihan.UsulanKebutuhanPelatihan.tambahUsulPelatihan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'nama_pelatihan' => 'required|string|max:255',
        ]);

        UsulKebutuhanPelatihan::create($request->all());
        return redirect()->route('usulan-kebutuhan-pelatihan.index')->with('success', 'Usulan Pelatihan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'nama_pelatihan' => 'required|string|max:255',
        ]);

        $UsulKebutuhanPelatihan = UsulKebutuhanPelatihan::findOrFail($id);
        $UsulKebutuhanPelatihan->update($request->all());
        return redirect()->back()->with('success', 'Usulan Pelatihan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $UsulKebutuhanPelatihan = UsulKebutuhanPelatihan::findOrFail($id);
        $UsulKebutuhanPelatihan->delete();
        return redirect()->back()->with('success', 'Usulan Pelatihan berhasil dihapus.');
    }
}
