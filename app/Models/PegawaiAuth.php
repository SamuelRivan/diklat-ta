<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class PegawaiAuth extends Model
{
    use HasFactory;

    protected $table = 'pegawai_auth';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pegawai',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke ref_pegawais
    public function pegawai()
    {
        return $this->belongsTo(ref_pegawais::class, 'id_pegawai', 'id');
    }

    // Mutator untuk hash password otomatis
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Method untuk verifikasi password
    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
