<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;

class PertanyaanSeeder extends Seeder
{
    public function run()
    {
        $pertanyaans = [
            'Saya lebih suka wirausaha dibandingkan menjadi karyawan.',
            'Saya lebih suka bekerja secara tim dibandingkan bekerja sendiri.',
            'Pemasukan perbulan rutin dan tetap lebih baik.',
        ];

        foreach ($pertanyaans as $isi) {
            Pertanyaan::create(['isi_pertanyaan' => $isi]);
        }
    }
}