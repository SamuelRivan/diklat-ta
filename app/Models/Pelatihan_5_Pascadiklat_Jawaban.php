<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelatihan_5_Pascadiklat_Jawaban extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel yang terkait dengan model ini
     *
     * @var string
     */
    protected $table = 'pelatihan_5_pascadiklat_jawaban';
    
    /**
     * Atribut yang dapat diisi
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'alumni_id',
        'kuesioner_id',
        'pertanyaan_id',
        'opsi_jawaban_id',
        'jawaban_teks',
        'pelatihan_id',
        'role_pengisi',
        'tanggal_pengisian',
    ];
    
    /**
     * Atribut yang harus dikonversi
     *
     * @var array
     */
    protected $casts = [
        'tanggal_pengisian' => 'datetime',
    ];
    
    /**
     * Mendapatkan pegawai yang mengisi jawaban ini
     */
    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(ref_pegawais::class, 'pegawai_id');
    }

    /**
     * Mendapatkan data alumni (jika berbeda dengan pegawai yang mengisi)
     */
    public function alumni(): BelongsTo
    {
        return $this->belongsTo(ref_pegawais::class, 'alumni_id');
    }
    
    /**
     * Mendapatkan kuesioner yang terkait dengan jawaban ini
     */
    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Pelatihan_5_Pascadiklat_Kuesioner::class, 'kuesioner_id');
    }
    
    /**
     * Mendapatkan pertanyaan yang dijawab
     */
    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan_5_Pascadiklat_Pertanyaan::class, 'pertanyaan_id');
    }
    
    /**
     * Mendapatkan opsi jawaban yang dipilih (untuk pertanyaan pilihan ganda)
     */
    public function opsiJawaban(): BelongsTo
    {
        return $this->belongsTo(Pelatihan_5_Pascadiklat_OpsiJawaban::class, 'opsi_jawaban_id');
    }
    
    /**
     * Mendapatkan pelatihan yang terkait dengan jawaban ini
     */
    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(ref_namapelatihan::class, 'pelatihan_id');
    }
}