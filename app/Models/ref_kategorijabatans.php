<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_kategorijabatans extends Model
{
    use HasFactory;
    protected $fillable = [
      'kode_kategorijabatan',
      'kategori_jabatan',
    ];
}
