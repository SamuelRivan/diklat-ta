<?php

namespace App\Exports\Evaluasi;

use App\Models\eva_1_alumni;
use App\Models\Pelatihan_5_Pascadiklat_Jawaban;
use App\Models\Pelatihan_5_Pascadiklat_Pertanyaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EvaluasiDataSheet implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    protected $pelatihan_id;
    protected $pegawai_id;
    protected $questions;
    protected $title;

    public function __construct($pelatihan_id, $pegawai_id = null)
    {
        $this->pelatihan_id = $pelatihan_id;
        $this->pegawai_id = $pegawai_id;
        
        $pelatihan = \App\Models\ref_namapelatihan::find($pelatihan_id);
        $name = $pelatihan ? $pelatihan->nama_pelatihan : 'Training ' . $pelatihan_id;
        // Limit 31 chars
        $this->title = substr($name, 0, 25) . ' Data';

        // Fetch questions relevant to this training (based on existing answers)
        // Or better, fetch questions from the questionnaire linked to this training.
        // Assuming we find questions via answers for now to be safe.
        $questionIds = Pelatihan_5_Pascadiklat_Jawaban::where('pelatihan_id', $this->pelatihan_id)
            ->distinct()
            ->pluck('pertanyaan_id');
            
        $this->questions = Pelatihan_5_Pascadiklat_Pertanyaan::whereIn('id', $questionIds)
            ->orderBy('urutan')
            ->get();
    }

    public function collection()
    {
        $query = eva_1_alumni::with(['pegawai', 'pelatihan'])
            ->where('pelatihan_id', $this->pelatihan_id);

        if ($this->pegawai_id) {
            $query->where('pegawai_id', $this->pegawai_id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        $headers = [
            'No',
            'NIP',
            'Nama',
            'Jabatan',
            'Unit Kerja',
            'Tanggal Pelatihan',
            'Status',
        ];

        foreach ($this->questions as $q) {
            $headers[] = $q->pertanyaan;
        }

        return $headers;
    }

    public function map($alumni): array
    {
        $data = [
            $alumni->alumni_id, // Or loop index if possible, simpler to use ID or just ignore No
            $alumni->pegawai->nip ?? '-',
            $alumni->pegawai->nama ?? '-',
            $alumni->pegawai->jabatan ?? '-',
            $alumni->pegawai->unit_kerja ?? '-',
            $alumni->tanggal_mulai_pelatihan,
            $alumni->status_alumni,
        ];

        // Fetch answers for this alumni and training
        // Optimization: Use a pre-loaded relationship or query
        $answers = Pelatihan_5_Pascadiklat_Jawaban::with('opsiJawaban')
            ->where('pelatihan_id', $this->pelatihan_id)
            ->where('pegawai_id', $alumni->pegawai_id) // Match user
            ->get()
            ->keyBy('pertanyaan_id');

        foreach ($this->questions as $q) {
            $ans = $answers->get($q->id);
            if ($ans) {
                if ($ans->opsi_jawaban_id) {
                    $val = $ans->opsiJawaban->teks_opsi ?? '';
                } else {
                    $val = $ans->jawaban_teks;
                }
            } else {
                $val = '-';
            }
            $data[] = $val;
        }

        return $data;
    }

    public function title(): string
    {
        return $this->title;
    }
}
