<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelatihan_5_Pascadiklat_PelatihanKuesioner extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel yang terkait dengan model ini
     *
     * @var string
     */
    protected $table = 'pelatihan_5_pascadiklat_pelatihan_kuesioner';
    
    /**
     * Atribut yang dapat diisi
     *
     * @var array
     */
    protected $fillable = [
        'pelatihan_id',
        'kuesioner_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];
    
    /**
     * Atribut yang harus dikonversi
     *
     * @var array
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
    
    /**
     * Mendapatkan pelatihan yang terkait dengan pivot ini
     */
    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(ref_namapelatihan::class, 'pelatihan_id');
    }
    
    /**
     * Mendapatkan kuesioner yang terkait dengan pivot ini
     */
    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Pelatihan_5_Pascadiklat_Kuesioner::class, 'kuesioner_id');
    }
    
    /**
     * Scope untuk pivot yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope untuk pivot yang sedang dalam periode
     */
    public function scopeInPeriod($query, $tanggal = null)
    {
        $tanggal = $tanggal ?? now();
        
        return $query->where('tanggal_mulai', '<=', $tanggal)
                    ->where('tanggal_selesai', '>=', $tanggal);
    }
    
    /**
     * Method helper untuk mengecek apakah masih dalam periode aktif
     */
    public function isInPeriod($tanggal = null)
    {
        $tanggal = $tanggal ?? now();
        
        return $this->tanggal_mulai <= $tanggal && $this->tanggal_selesai >= $tanggal;
    }
}