<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_jenisasn extends Model
{
    use HasFactory;
    protected $fillable = [
       'kode_jenisasn',
       'jenis_asn',
    ];
}
