<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile_akpk extends Model
{
    use HasFactory;

    protected $table = 'profile_akpk';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'pangkat_golongan',
        'jenis_jabatan',
        'jabatan',
        'unit_kerja',
        'no_hp',
        'email',
        'nip_atasan',
        'alamat',
        'foto',
        'atasan_anda',
        'id_atasan',
    ];
}
