<?php
namespace App\Http\Controllers\Admin\Akpk;

use App\Http\Controllers\Controller;

class AkpkAdminController extends Controller
{
    // ...existing code...

    public function dashboard()
    {
        return view('Admin.Akpk.dashboardAkpk');
    }

    public function tabelSelfAssessment()
    {
        return view('Admin.Akpk.Asessment.tabelSelfAssessment');
    }
    public function tabelAssessmentAtasan()
    {
        return view('Admin.Akpk.Asessment.tabelAssessmentAtasan');
    }
    public function tabelEvaluasiAssessment()
    {
        return view('Admin.Akpk.Asessment.tabelEvaluasiAssessment');
    }
    public function tabelUsulanKebutuhanPelatihan()
    {
        return view('Admin.Akpk.Usulan.tabelUsulanKebutuhanPelatihan');
    }
    public function tabelUsulanPelatihanSolowasis()
    {
        return view('Admin.Akpk.Usulan.tabelUsulanPelatihanSolowasis');
    }
    public function manajemenPertanyaan()
    {
        return view('Admin.Akpk.ManajemenData.manajemenPertanyaan');
    }
    public function manajemenKomentar()
    {
        return view('Admin.Akpk.ManajemenData.manajemenKomentar');
    }
    public function manajemenGaleri()
    {
        return view('Admin.Akpk.ManajemenData.manajemenGaleri');
    }
    public function manajemenSolowasis()
    {
        return view('Admin.Akpk.ManajemenData.manajemenSolowasis');
    }
}
