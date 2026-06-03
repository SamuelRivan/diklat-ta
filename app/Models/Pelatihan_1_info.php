<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan_1_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'info_pelatihan',
        'link_pelatihan',
        'gambar',
    ];
}
