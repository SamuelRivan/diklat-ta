<?php

namespace App\Exports\Evaluasi;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\eva_1_alumni;
use App\Exports\Evaluasi\EvaluasiDataSheet;
use App\Exports\Evaluasi\EvaluasiResumeSheet;

class EvaluasiExport implements WithMultipleSheets
{
    use Exportable;

    protected $pelatihan_id;
    protected $pegawai_id;

    public function __construct($pelatihan_id = null, $pegawai_id = null)
    {
        $this->pelatihan_id = $pelatihan_id;
        $this->pegawai_id = $pegawai_id;
    }

    public function sheets(): array
    {
        $sheets = [];

        if ($this->pelatihan_id) {
            // Case 1: Per Pelatihan (All employees in this training) -> $pegawai_id = null
            // Case 3: Per Alumni Per Pelatihan (Specific employee in this training) -> $pegawai_id = integer
            $sheets[] = new EvaluasiDataSheet($this->pelatihan_id, $this->pegawai_id);
            // Resume only if for whole training. If single user, resume is weird (N=1).
            // But user said "resume juga didalam export nya". Let's include it anyway, won't hurt.
            // Resume is always aggregate for the training, not filtered by user (unless we filter resume too).
            // Usually resume means "Summary of All Responses for this Training".
            $sheets[] = new EvaluasiResumeSheet($this->pelatihan_id);
        } elseif ($this->pegawai_id) {
            // Case 2: Per Alumni (All trainings for this employee)
            $trainings = eva_1_alumni::where('pegawai_id', $this->pegawai_id)
                ->pluck('pelatihan_id')
                ->unique();

            foreach ($trainings as $pid) {
                if ($pid) {
                    $sheets[] = new EvaluasiDataSheet($pid, $this->pegawai_id);
                    // Resume for each training sheet
                    //$sheets[] = new EvaluasiResumeSheet($pid); 
                    // Naming collision if multiple resumes. 
                    // EvaluasiResumeSheet uses title "Title Resume".
                    // So it should be fine.
                }
            }
        }

        return $sheets;
    }
}
