<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class akpk_5_usulankebutuhanpelatihan extends Model
{
    // Define the table name
    protected $table = 'akpk_5_usulankebutuhanpelatihans';

    // Specify fillable attributes
    protected $fillable = ['tahun', 'nama_pelatihan'];

    // Enable timestamps
    public $timestamps = true;
}
