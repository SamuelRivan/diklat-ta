<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JawabanEvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample jawaban evaluasi alumni
        $jawabanEvaluasi = [
            // Jawaban Alumni (Kuesioner ID: 1)
            [
                'kuesioner_id' => 1,
                'alumni_id' => 1,
                'pegawai_id' => 1,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 1,
                'opsi_jawaban_id' => 1, // Sangat Puas
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 1,
                'alumni_id' => 1,
                'pegawai_id' => 1,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 2,
                'opsi_jawaban_id' => 6, // Membantu (Skala Likert)
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 1,
                'alumni_id' => 1,
                'pegawai_id' => 1,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 3,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'Setelah mengikuti pelatihan, saya dapat menerapkan konsep manajemen waktu yang lebih efektif dalam menyelesaikan tugas-tugas harian. Saya juga lebih memahami cara berkomunikasi yang baik dengan tim.',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 1,
                'alumni_id' => 1,
                'pegawai_id' => 1,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 4,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'ya',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Jawaban Atasan (Kuesioner ID: 2) untuk Alumni ID: 1
            [
                'kuesioner_id' => 2,
                'alumni_id' => 1,
                'role_pengisi' => 'atasan',
                'pegawai_id' => 4, // Atasan ID previously pegawai_penilai_id
                'pertanyaan_id' => 5,
                'opsi_jawaban_id' => 12, // Meningkat
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 2,
                'alumni_id' => 1,
                'role_pengisi' => 'atasan',
                'pegawai_id' => 4,
                'pertanyaan_id' => 6,
                'opsi_jawaban_id' => 17, // Efektif
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 2,
                'alumni_id' => 1,
                'role_pengisi' => 'atasan',
                'pegawai_id' => 4,
                'pertanyaan_id' => 7,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'Alumni menunjukkan peningkatan dalam hal ketepatan waktu penyelesaian laporan dan kualitas analisis yang lebih mendalam. Komunikasi dengan tim juga menjadi lebih efektif.',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 2,
                'alumni_id' => 1,
                'role_pengisi' => 'atasan',
                'pegawai_id' => 4,
                'pertanyaan_id' => 8,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'ya',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Jawaban Rekan Kerja (Kuesioner ID: 3) untuk Alumni ID: 1
            [
                'kuesioner_id' => 3,
                'alumni_id' => 1,
                'role_pengisi' => 'rekan',
                'pegawai_id' => 6, // Rekan Kerja ID
                'pertanyaan_id' => 9,
                'opsi_jawaban_id' => 22, // Meningkat
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 3,
                'alumni_id' => 1,
                'role_pengisi' => 'rekan',
                'pegawai_id' => 6,
                'pertanyaan_id' => 10,
                'opsi_jawaban_id' => 27, // Baik
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 3,
                'alumni_id' => 1,
                'role_pengisi' => 'rekan',
                'pegawai_id' => 6,
                'pertanyaan_id' => 11,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'Rekan ini menjadi lebih proaktif dalam memberikan saran dan solusi untuk permasalahan tim. Juga lebih terbuka untuk berbagi pengetahuan baru yang didapat dari pelatihan.',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 3,
                'alumni_id' => 1,
                'role_pengisi' => 'rekan',
                'pegawai_id' => 6,
                'pertanyaan_id' => 12,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'ya',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Sample jawaban untuk Alumni ID: 2
            [
                'kuesioner_id' => 1,
                'alumni_id' => 2,
                'pegawai_id' => 2,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 1,
                'opsi_jawaban_id' => 2, // Puas
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 1,
                'alumni_id' => 2,
                'pegawai_id' => 2,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 2,
                'opsi_jawaban_id' => 5, // Sangat Membantu
                'jawaban_teks' => null,
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kuesioner_id' => 1,
                'alumni_id' => 2,
                'pegawai_id' => 2,
                'role_pengisi' => 'alumni',
                'pertanyaan_id' => 3,
                'opsi_jawaban_id' => null,
                'jawaban_teks' => 'Pelatihan membantu saya memahami pentingnya analisis data dalam pengambilan keputusan. Sekarang saya lebih sistematis dalam menyusun laporan dan presentasi.',
                'tanggal_pengisian' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('pelatihan_5_pascadiklat_jawaban')->insert($jawabanEvaluasi);

        // Update status penilaian untuk yang sudah dijawab
        // Check first if records exist to avoid errors
        if (DB::table('pelatihan_5_pascadiklat_atasan')->where('alumni_id', 1)->where('pegawai_id', 4)->exists()) {
            DB::table('pelatihan_5_pascadiklat_atasan')->where('alumni_id', 1)->where('pegawai_id', 4)
                ->update(['status_penilaian' => 'sudah_dinilai', 'updated_at' => Carbon::now()]);
        }

        if (DB::table('pelatihan_5_pascadiklat_rekankerja')->where('alumni_id', 1)->where('pegawai_id', 6)->exists()) {
            DB::table('pelatihan_5_pascadiklat_rekankerja')->where('alumni_id', 1)->where('pegawai_id', 6)
                ->update(['status_penilaian' => 'sudah_dinilai', 'updated_at' => Carbon::now()]);
        }

        $this->command->info('Data jawaban evaluasi berhasil di-seed!');
    }
}