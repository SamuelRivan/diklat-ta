<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eva_1_alumni extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_5_pascadiklat_alumni';
    protected $primaryKey = 'alumni_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pegawai_id',
        'pelatihan_id',
        'tanggal_mulai_pelatihan',
        'tanggal_selesai_pelatihan',
        'status_alumni', // belum dinilai, sedang dinilai, sudah dinilai
    ];

    // Relasi ke ref_pegawais (alumni)
    public function pegawai()
    {
        return $this->belongsTo(ref_pegawais::class, 'pegawai_id', 'id');
    }

    // Relasi ke ref_namapelatihan
    public function pelatihan()
    {
        return $this->belongsTo(ref_namapelatihan::class, 'pelatihan_id', 'id');
    }

    // Relasi ke eva_2_atasan (satu alumni bisa punya banyak atasan)
    public function atasan()
    {
        return $this->hasMany(eva_2_atasan::class, 'alumni_id', 'alumni_id');
    }

    // Relasi ke eva_3_rekansejawat (satu alumni hanya punya satu rekan kerja)
    public function rekanKerja()
    {
        return $this->hasOne(eva_3_rekansejawat::class, 'alumni_id', 'alumni_id');
    }
    
    // Method helper untuk mengecek apakah alumni sudah memiliki evaluator
    public function hasEvaluators()
    {
        return $this->atasan()->exists() || $this->rekanKerja()->exists();
    }
    
    // Method helper untuk mengecek apakah semua evaluator sudah menilai
    public function allEvaluatorsCompleted()
    {
        $atasanCompleted = $this->atasan()->where('status_penilaian', eva_2_atasan::STATUS_SUDAH_DINILAI)->exists();
        $rekanCompleted = $this->rekanKerja && $this->rekanKerja->status_penilaian === eva_3_rekansejawat::STATUS_SUDAH_DINILAI;
        
        return $atasanCompleted && $rekanCompleted;
    }
}

