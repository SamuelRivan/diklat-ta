<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulKebutuhanPelatihan extends Model
{
    use HasFactory;

    protected $table = 'akpk_5_usulankebutuhanpelatihans'; // Specify the table name
    protected $fillable = ['tahun', 'nama_pelatihan'];
}
