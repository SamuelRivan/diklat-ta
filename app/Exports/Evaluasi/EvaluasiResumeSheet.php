<?php

namespace App\Exports\Evaluasi;

use App\Models\Pelatihan_5_Pascadiklat_Jawaban;
use App\Models\Pelatihan_5_Pascadiklat_Pertanyaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EvaluasiResumeSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    protected $pelatihan_id;
    protected $title;

    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id = $pelatihan_id;
        $pelatihan = \App\Models\ref_namapelatihan::find($pelatihan_id);
        $name = $pelatihan ? $pelatihan->nama_pelatihan : 'Training ' . $pelatihan_id;
        // Limit 31 chars
        $this->title = substr($name, 0, 23) . ' Resume';
    }

    public function collection()
    {
        // Fetch questions
        $questions = Pelatihan_5_Pascadiklat_Pertanyaan::whereHas('kuesioner.pelatihan', function($q) {
            $q->where('ref_namapelatihans.id', $this->pelatihan_id);
        })->orWhereIn('id', function($q) {
             $q->select('pertanyaan_id')
               ->from('pelatihan_5_pascadiklat_jawaban')
               ->where('pelatihan_id', $this->pelatihan_id);
        })->distinct()->get();

        $data = new Collection();

        foreach ($questions as $q) {
            // Count answers
            // If strictly text answers, we can't easily find mode unless exact match.
            // If option based, use opsi_jawaban_id.

            $mostFrequent = Pelatihan_5_Pascadiklat_Jawaban::where('pelatihan_id', $this->pelatihan_id)
                ->where('pertanyaan_id', $q->id)
                ->select('opsi_jawaban_id', 'jawaban_teks', DB::raw('count(*) as total'))
                ->groupBy('opsi_jawaban_id', 'jawaban_teks')
                ->orderByDesc('total')
                ->first();

            $answerText = '-';
            $count = 0;

            if ($mostFrequent) {
                $count = $mostFrequent->total;
                if ($mostFrequent->opsi_jawaban_id) {
                    $opt = \App\Models\Pelatihan_5_Pascadiklat_OpsiJawaban::find($mostFrequent->opsi_jawaban_id);
                    $answerText = $opt ? $opt->teks_opsi : '-';
                } else {
                    $answerText = $mostFrequent->jawaban_teks;
                }
            }

            $data->push([
                'pertanyaan' => $q->pertanyaan,
                'jawaban_terbanyak' => $answerText,
                'jumlah_responden' => $count,
                // Maybe total respondents for this question?
                'total_responden' => Pelatihan_5_Pascadiklat_Jawaban::where('pelatihan_id', $this->pelatihan_id)->where('pertanyaan_id', $q->id)->count(),
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Pertanyaan',
            'Jawaban Terbanyak',
            'Jumlah (Mode)',
            'Total Responden',
        ];
    }

    public function title(): string
    {
        return $this->title;
    }
}
