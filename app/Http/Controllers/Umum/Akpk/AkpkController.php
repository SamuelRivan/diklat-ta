<?php

namespace App\Http\Controllers\Umum\AKPK;

use App\Http\Controllers\Controller;


class AkpkController extends Controller
{
    public function index()
    {
        return view('MenuUmum.AKPK.homepageAkpk');
    }
}

