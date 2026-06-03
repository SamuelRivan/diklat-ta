<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelatihan_5_Pascadiklat_OpsiJawaban extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel yang terkait dengan model ini
     *
     * @var string
     */
    protected $table = 'pelatihan_5_pascadiklat_opsi_jawaban';
    
    /**
     * Atribut yang dapat diisi
     *
     * @var array
     */
    protected $fillable = [
        'pertanyaan_id',
        'teks_opsi',
        'urutan',
    ];
    
    /**
     * Mendapatkan pertanyaan yang terkait dengan opsi jawaban ini
     */
    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan_5_Pascadiklat_Pertanyaan::class, 'pertanyaan_id');
    }
}
