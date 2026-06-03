<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelatihan_5_Pascadiklat_Pertanyaan extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel yang terkait dengan model ini
     *
     * @var string
     */
    protected $table = 'pelatihan_5_pascadiklat_pertanyaan';
    
    /**
     * Atribut yang dapat diisi
     *
     * @var array
     */
    protected $fillable = [
        'kuesioner_id',
        'pertanyaan',
        'jenis',
        'urutan',
        'wajib',
    ];
    
    /**
     * Atribut yang harus dikonversi
     *
     * @var array
     */
    protected $casts = [
        'wajib' => 'boolean',
    ];
    
    /**
     * Mendapatkan kuesioner yang terkait dengan pertanyaan ini
     */
    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Pelatihan_5_Pascadiklat_Kuesioner::class, 'kuesioner_id');
    }
    
    /**
     * Mendapatkan semua opsi jawaban untuk pertanyaan ini
     */
    public function opsiJawaban(): HasMany
    {
        return $this->hasMany(Pelatihan_5_Pascadiklat_OpsiJawaban::class, 'pertanyaan_id');
    }
}
