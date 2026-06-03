<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ref_namapelatihan;

class Pelatihan_5_Pascadiklat_Kuesioner extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel yang terkait dengan model ini
     *
     * @var string
     */
    protected $table = 'pelatihan_5_pascadiklat_kuesioner';
    
    /**
     * Atribut yang dapat diisi
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'role_target',
        'is_active',
    ];
    
    /**
     * Atribut yang harus dikonversi
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    /**
     * Mendapatkan semua pertanyaan yang terkait dengan kuesioner ini
     */
    public function pertanyaan(): HasMany
    {
        return $this->hasMany(Pelatihan_5_Pascadiklat_Pertanyaan::class, 'kuesioner_id');
    }
    
    /**
     * Mendapatkan semua pelatihan yang menggunakan kuesioner ini
     */
    public function pelatihan(): BelongsToMany
    {
        return $this->belongsToMany(
            ref_namapelatihan::class,
            'pelatihan_5_pascadiklat_pelatihan_kuesioner',
            'kuesioner_id',
            'pelatihan_id'
        )->withPivot('tanggal_mulai', 'tanggal_selesai', 'is_active')
         ->withTimestamps();
    }
    
    /**
     * Mendapatkan semua jawaban dari kuesioner ini
     */
    public function jawaban(): HasMany
    {
        return $this->hasMany(Pelatihan_5_Pascadiklat_Jawaban::class, 'kuesioner_id');
    }
    
    /**
     * Scope untuk kuesioner yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope untuk kuesioner berdasarkan role
     */
    public function scopeForRole($query, $role)
    {
        return $query->where(function($q) use ($role) {
            $q->where('role_target', $role)
              ->orWhere('role_target', 'all');
        });
    }
    
    /**
     * Method helper untuk mengecek apakah kuesioner bisa diisi oleh role tertentu
     */
    public function canBeFilledBy($role)
    {
        return $this->role_target === $role || $this->role_target === 'all';
    }
}
