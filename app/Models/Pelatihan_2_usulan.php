<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan_2_usulan extends Model
{
    use HasFactory;
    protected $fillable = [
    'nip',
    'nama',
    'pangkat_golongan',
    'jabatan',
    'unitkerja',
    'no_hp',
    'nama_pelatihan',
    'pelaksanaan_pelatihan',
    'metode_pelatihan',
    'jenis_pelatihan',
    'penyelenggara_pelatihan',
    'tempat_pelatihan',
    'tanggal_mulai',
    'tanggal_selesai',
    'estimasi_biaya',
    'file_penawaran',
    'file_usulan',
    'keterangan',
    'status',

    ];
}
