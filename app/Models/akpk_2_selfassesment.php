<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class akpk_2_selfassesment extends Model
{
    protected $table = 'akpk_2_selfs';

    protected $fillable = [
        'pegawai_id',
        'tanggal_pengisian',
        'manajerial_nilai',
        'manajerial_keterangan',
        'teknis_nilai',
        'teknis_keterangan',
        'sosiokultural_nilai',
        'sosiokultural_keterangan',
        'kompetensi_dibutuhkan',
        'pelatihan_dibutuhkan',
        'nama_atasan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(ref_pegawais::class, 'pegawai_id');
    }
}
