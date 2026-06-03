<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_golongans extends Model
{
    use HasFactory;
    protected $fillable = [
       'kode_golongan',
       'jenis_asn',
       'golongan',
       'pangkat',
       'pangkat_golongan',
    ];
}
