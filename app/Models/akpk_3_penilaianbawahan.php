<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class akpk_3_penilaianbawahan extends Model
{
    protected $fillable = [
        'id_atasan',
        'kategori',
        'kompetensi',
        'skala',
        'keterangan',
        'tanggal_pengisian',
    ];
}
