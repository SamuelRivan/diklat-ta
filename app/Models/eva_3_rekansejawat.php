<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eva_3_rekansejawat extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_5_pascadiklat_rekankerja';
    protected $primaryKey = 'rekankerja_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    // Konstanta untuk status penilaian
    const STATUS_BELUM_DINILAI = 'belum_dinilai';
    const STATUS_SUDAH_DINILAI = 'sudah_dinilai';
    
    protected $fillable = [
        'alumni_id',
        'pegawai_id', // ID pegawai yang menjadi rekan kerja
        'pelatihan_id', // relasi ke ref_namapelatihans
        'status_penilaian', // belum_dinilai, sudah_dinilai
    ];
    
    protected $casts = [
        'status_penilaian' => 'string',
    ];

    // Relasi ke eva_1_alumni (rekan kerja milik alumni tertentu)
    public function alumni()
    {
        return $this->belongsTo(eva_1_alumni::class, 'alumni_id', 'alumni_id');
    }

    // Relasi ke ref_pegawais (data rekan kerja)
    public function pegawai()
    {
        return $this->belongsTo(ref_pegawais::class, 'pegawai_id', 'id');
    }

    // Relasi ke ref_namapelatihan (pelatihan terkait)
    public function pelatihan()
    {
        return $this->belongsTo(ref_namapelatihan::class, 'pelatihan_id', 'id');
    }
    
    // Method helper untuk status
    public function isBelumDinilai()
    {
        return $this->status_penilaian === self::STATUS_BELUM_DINILAI;
    }
    
    public function isSudahDinilai()
    {
        return $this->status_penilaian === self::STATUS_SUDAH_DINILAI;
    }
    
    public function markAsSudahDinilai()
    {
        $this->update(['status_penilaian' => self::STATUS_SUDAH_DINILAI]);
    }
}
