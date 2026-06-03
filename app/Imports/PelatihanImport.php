<?php

namespace App\Imports;

use App\Models\ref_namapelatihan;
use Maatwebsite\Excel\Concerns\ToModel;


class PelatihanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ref_namapelatihan([
            'jenis_pelatihan_id' => $row[0] ?? null,
            'nama_pelatihan' => $row[1] ?? null,
            // Map additional columns here if needed
        ]);
    }
}
