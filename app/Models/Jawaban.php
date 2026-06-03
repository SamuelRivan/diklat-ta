<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'pelatihan_5_jawaban_alumni';

    protected $fillable = [
        'alumni_id',
        'pertanyaan_index',
        'jawaban',
    ];

    public function alumni()
    {
        // alumni_id references primary key alumni_id on eva_1_alumni
        return $this->belongsTo(eva_1_alumni::class, 'alumni_id', 'alumni_id');
    }
}
