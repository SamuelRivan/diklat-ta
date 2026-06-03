<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ref_pegawais extends Authenticatable
{
    use HasFactory;

    protected $table = 'ref_pegawais';
    protected $primaryKey = 'id';
    public $incrementing = true; // ubah ke false kalau id bukan auto increment
    protected $keyType = 'int'; // ubah ke 'string' jika id berupa string

    protected $fillable = [
        'id',
        'nip',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'pangkat',
        'golongan',
        'jabatan',
        'unit_kerja',
        'kode_unitkerja',
        'no_wa',
        'email',
        'alamat',
        'foto',
        'jenis_asn',
        'kategori_jabatanasn',
        'no_hp',
        'atasan',
        'pengelola_kepegawaian',
        'uraian_tugas',
        'id_atasan',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function unitKerja()
    {
        return $this->belongsTo(
            ref_unitkerjas::class,
            'kode_unitkerja',
            'kode_unitkerja'
        );
    }

    // Add accessor for unit kerja name if needed
    public function getUnitKerjaNameAttribute()
    {
        return $this->unitKerja ? $this->unitKerja->nama : '-';
    }

    public function atasan()
    {
        return $this->belongsTo(self::class, 'id_atasan', 'id');
    }

    // Relasi ke PegawaiAuth
    public function auth()
    {
        return $this->hasOne(PegawaiAuth::class, 'id_pegawai', 'id');
    }
    
    // Relasi sebagai alumni pascadiklat
    public function alumniPascadiklat()
    {
        return $this->hasMany(eva_1_alumni::class, 'pegawai_id', 'id');
    }
    
    // Relasi sebagai atasan evaluator
    public function sebagaiAtasan()
    {
        return $this->hasMany(eva_2_atasan::class, 'pegawai_id', 'id');
    }
    
    // Relasi sebagai rekan kerja evaluator
    public function sebagaiRekanKerja()
    {
        return $this->hasMany(eva_3_rekansejawat::class, 'pegawai_id', 'id');
    }
    
    // Relasi jawaban kuesioner
    public function jawabanKuesioner()
    {
        return $this->hasMany(Pelatihan_5_Pascadiklat_Jawaban::class, 'pegawai_id', 'id');
    }
}
