<?php

namespace App\Http\Controllers\Umum\Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\Katalog_2_masuks;
use Illuminate\Http\Request;

class UmumPelatihanController extends Controller
{
    public function index()
    {
        $trainings = Katalog_2_masuks::all(); // Fetch all records from the katalog_2_masuks table
        return view('MenuUmum.Pelatihan.index', compact('trainings'));
    }

    public function show($id)
    {
        $training = Katalog_2_masuks::findOrFail($id); // Fetch a single record by ID
        return view('MenuUmum.Pelatihan.show', compact('training'));
    }
}
