<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EvaluasiUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'evaluasi_users';

    protected $fillable = [
        'nip',
        'email',
        'nama',
        'password',
        'tanggal_lahir',
        'foto_profile',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
