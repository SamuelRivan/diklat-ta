<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_namapelatihan extends Model
{
    use HasFactory;
    
    protected $table = 'ref_namapelatihans';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jenis_pelatihan_id',
        'nama_pelatihan',
    ];

    // Relasi ke ref_jenispelatihans
    public function jenisPelatihan()
    {
        return $this->belongsTo(ref_jenispelatihans::class, 'jenis_pelatihan_id', 'id');
    }

    // Relasi ke eva_1_alumni
    public function alumni()
    {
        return $this->hasMany(eva_1_alumni::class, 'pelatihan_id', 'id');
    }
    
    // Relasi ke kuesioner pascadiklat
    public function kuesioner()
    {
        return $this->belongsToMany(
            Pelatihan_5_Pascadiklat_Kuesioner::class,
            'pelatihan_5_pascadiklat_pelatihan_kuesioner',
            'pelatihan_id',
            'kuesioner_id'
        )->withPivot('tanggal_mulai', 'tanggal_selesai', 'is_active')
         ->withTimestamps();
    }
}
