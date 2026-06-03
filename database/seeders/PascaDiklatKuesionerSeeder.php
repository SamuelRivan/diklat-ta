<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelatihan_5_Pascadiklat_Kuesioner;
use App\Models\Pelatihan_5_Pascadiklat_Pertanyaan;
use App\Models\Pelatihan_5_Pascadiklat_OpsiJawaban;

class PascaDiklatKuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kuesioner untuk Alumni
        $this->createKuesionerAlumni();
        
        // Kuesioner untuk Atasan
        $this->createKuesionerAtasan();
        
        // Kuesioner untuk Rekan Kerja
        $this->createKuesionerRekanKerja();
    }
    
    private function createKuesionerAlumni()
    {
        // Kuesioner Alumni 1: Evaluasi Kepuasan Pelatihan
        $kuesioner1 = Pelatihan_5_Pascadiklat_Kuesioner::create([
            'judul' => 'Evaluasi Kepuasan Alumni Pascadiklat',
            'deskripsi' => 'Kuesioner untuk mengukur tingkat kepuasan alumni terhadap pelatihan yang telah diikuti',
            'role_target' => 'alumni',
            'is_active' => true,
        ]);
        
        // Pertanyaan untuk Kuesioner Alumni 1
        $pertanyaan1_1 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Bagaimana tingkat kepuasan Anda terhadap materi pelatihan yang diberikan?',
            'jenis' => 'skala_likert',
            'urutan' => 1,
            'wajib' => true,
        ]);
        
        // Opsi jawaban untuk pertanyaan 1.1 (Skala Likert 1-5)
        $opsiLikert = [
            ['teks_opsi' => 'Sangat Tidak Puas', 'urutan' => 1],
            ['teks_opsi' => 'Tidak Puas', 'urutan' => 2],
            ['teks_opsi' => 'Cukup Puas', 'urutan' => 3],
            ['teks_opsi' => 'Puas', 'urutan' => 4],
            ['teks_opsi' => 'Sangat Puas', 'urutan' => 5],
        ];
        
        foreach ($opsiLikert as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan1_1->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan1_2 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Sejauh mana pelatihan ini membantu meningkatkan kemampuan kerja Anda?',
            'jenis' => 'pilihan_ganda',
            'urutan' => 2,
            'wajib' => true,
        ]);
        
        $opsiPG1 = [
            ['teks_opsi' => 'Sangat membantu', 'urutan' => 1],
            ['teks_opsi' => 'Cukup membantu', 'urutan' => 2],
            ['teks_opsi' => 'Sedikit membantu', 'urutan' => 3],
            ['teks_opsi' => 'Tidak membantu', 'urutan' => 4],
        ];
        
        foreach ($opsiPG1 as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan1_2->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan1_3 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Saran dan masukan untuk perbaikan pelatihan ke depan:',
            'jenis' => 'teks_panjang',
            'urutan' => 3,
            'wajib' => false,
        ]);
        
        // Kuesioner Alumni 2: Evaluasi Implementasi Ilmu
        $kuesioner2 = Pelatihan_5_Pascadiklat_Kuesioner::create([
            'judul' => 'Evaluasi Implementasi Ilmu Alumni',
            'deskripsi' => 'Kuesioner untuk mengukur sejauh mana alumni mengimplementasikan ilmu yang diperoleh dari pelatihan',
            'role_target' => 'alumni',
            'is_active' => true,
        ]);
        
        $pertanyaan2_1 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Apakah Anda sudah menerapkan ilmu dari pelatihan dalam pekerjaan sehari-hari?',
            'jenis' => 'pilihan_ganda',
            'urutan' => 1,
            'wajib' => true,
        ]);
        
        $opsiPG2 = [
            ['teks_opsi' => 'Ya, sudah diterapkan sepenuhnya', 'urutan' => 1],
            ['teks_opsi' => 'Ya, sudah diterapkan sebagian', 'urutan' => 2],
            ['teks_opsi' => 'Baru mulai menerapkan', 'urutan' => 3],
            ['teks_opsi' => 'Belum diterapkan', 'urutan' => 4],
        ];
        
        foreach ($opsiPG2 as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan2_1->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan2_2 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Kendala apa saja yang Anda hadapi dalam menerapkan ilmu dari pelatihan? (Boleh pilih lebih dari satu)',
            'jenis' => 'checkbox',
            'urutan' => 2,
            'wajib' => false,
        ]);
        
        $opsiCB = [
            ['teks_opsi' => 'Kurangnya dukungan dari atasan', 'urutan' => 1],
            ['teks_opsi' => 'Keterbatasan waktu', 'urutan' => 2],
            ['teks_opsi' => 'Kurangnya fasilitas pendukung', 'urutan' => 3],
            ['teks_opsi' => 'Resistensi dari rekan kerja', 'urutan' => 4],
            ['teks_opsi' => 'Tidak ada kendala', 'urutan' => 5],
        ];
        
        foreach ($opsiCB as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan2_2->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
    }
    
    private function createKuesionerAtasan()
    {
        // Kuesioner Atasan 1: Evaluasi Kinerja Alumni
        $kuesioner1 = Pelatihan_5_Pascadiklat_Kuesioner::create([
            'judul' => 'Evaluasi Kinerja Alumni oleh Atasan',
            'deskripsi' => 'Kuesioner untuk menilai perubahan kinerja alumni setelah mengikuti pelatihan',
            'role_target' => 'atasan',
            'is_active' => true,
        ]);
        
        $pertanyaan1_1 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Bagaimana penilaian Anda terhadap peningkatan kinerja alumni setelah mengikuti pelatihan?',
            'jenis' => 'skala_likert',
            'urutan' => 1,
            'wajib' => true,
        ]);
        
        // Opsi jawaban untuk pertanyaan atasan 1.1 (Skala Likert 1-5)
        $opsiLikert = [
            ['teks_opsi' => 'Sangat Tidak Puas', 'urutan' => 1],
            ['teks_opsi' => 'Tidak Puas', 'urutan' => 2],
            ['teks_opsi' => 'Cukup Puas', 'urutan' => 3],
            ['teks_opsi' => 'Puas', 'urutan' => 4],
            ['teks_opsi' => 'Sangat Puas', 'urutan' => 5],
        ];
        
        foreach ($opsiLikert as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan1_1->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan1_2 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Apakah alumni menunjukkan penerapan ilmu dari pelatihan dalam tugasnya?',
            'jenis' => 'pilihan_ganda',
            'urutan' => 2,
            'wajib' => true,
        ]);
        
        $opsiAtasan1 = [
            ['teks_opsi' => 'Ya, sangat terlihat penerapannya', 'urutan' => 1],
            ['teks_opsi' => 'Ya, cukup terlihat', 'urutan' => 2],
            ['teks_opsi' => 'Sedikit terlihat', 'urutan' => 3],
            ['teks_opsi' => 'Tidak terlihat', 'urutan' => 4],
        ];
        
        foreach ($opsiAtasan1 as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan1_2->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan1_3 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Catatan khusus tentang perkembangan alumni:',
            'jenis' => 'teks_panjang',
            'urutan' => 3,
            'wajib' => false,
        ]);
        
        // Kuesioner Atasan 2: Evaluasi Kontribusi Alumni
        $kuesioner2 = Pelatihan_5_Pascadiklat_Kuesioner::create([
            'judul' => 'Evaluasi Kontribusi Alumni dalam Tim',
            'deskripsi' => 'Kuesioner untuk menilai kontribusi alumni terhadap tim dan organisasi setelah pelatihan',
            'role_target' => 'atasan',
            'is_active' => true,
        ]);
        
        $pertanyaan2_1 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Seberapa besar kontribusi alumni terhadap pencapaian target tim?',
            'jenis' => 'skala_likert',
            'urutan' => 1,
            'wajib' => true,
        ]);
        
        // Opsi jawaban untuk kontribusi (modifikasi dari likert)
        $opsiKontribusi = [
            ['teks_opsi' => 'Sangat Tidak Berkontribusi', 'urutan' => 1],
            ['teks_opsi' => 'Tidak Berkontribusi', 'urutan' => 2],
            ['teks_opsi' => 'Cukup Berkontribusi', 'urutan' => 3],
            ['teks_opsi' => 'Berkontribusi', 'urutan' => 4],
            ['teks_opsi' => 'Sangat Berkontribusi', 'urutan' => 5],
        ];
        
        foreach ($opsiKontribusi as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan2_1->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan2_2 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Aspek mana yang paling meningkat pada alumni setelah pelatihan?',
            'jenis' => 'pilihan_ganda',
            'urutan' => 2,
            'wajib' => true,
        ]);
        
        $opsiAtasan2 = [
            ['teks_opsi' => 'Kemampuan teknis', 'urutan' => 1],
            ['teks_opsi' => 'Kemampuan komunikasi', 'urutan' => 2],
            ['teks_opsi' => 'Kemampuan leadership', 'urutan' => 3],
            ['teks_opsi' => 'Kemampuan analisis', 'urutan' => 4],
            ['teks_opsi' => 'Tidak ada peningkatan', 'urutan' => 5],
        ];
        
        foreach ($opsiAtasan2 as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan2_2->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
    }
    
    private function createKuesionerRekanKerja()
    {
        // Kuesioner Rekan Kerja 1: Evaluasi Kolaborasi
        $kuesioner1 = Pelatihan_5_Pascadiklat_Kuesioner::create([
            'judul' => 'Evaluasi Kolaborasi dengan Alumni',
            'deskripsi' => 'Kuesioner untuk menilai kemampuan kolaborasi dan kerjasama alumni setelah pelatihan',
            'role_target' => 'rekan',
            'is_active' => true,
        ]);
        
        $pertanyaan1_1 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Bagaimana penilaian Anda terhadap kemampuan kerjasama alumni dalam tim?',
            'jenis' => 'skala_likert',
            'urutan' => 1,
            'wajib' => true,
        ]);
        
        $opsiLikert = [
            ['teks_opsi' => 'Sangat Buruk', 'urutan' => 1],
            ['teks_opsi' => 'Buruk', 'urutan' => 2],
            ['teks_opsi' => 'Cukup Baik', 'urutan' => 3],
            ['teks_opsi' => 'Baik', 'urutan' => 4],
            ['teks_opsi' => 'Sangat Baik', 'urutan' => 5],
        ];
        
        foreach ($opsiLikert as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan1_1->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan1_2 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Apakah alumni berbagi pengetahuan dari pelatihan kepada rekan kerja?',
            'jenis' => 'pilihan_ganda',
            'urutan' => 2,
            'wajib' => true,
        ]);
        
        $opsiRekan1 = [
            ['teks_opsi' => 'Ya, selalu berbagi dengan antusias', 'urutan' => 1],
            ['teks_opsi' => 'Ya, sering berbagi', 'urutan' => 2],
            ['teks_opsi' => 'Kadang-kadang berbagi', 'urutan' => 3],
            ['teks_opsi' => 'Jarang berbagi', 'urutan' => 4],
            ['teks_opsi' => 'Tidak pernah berbagi', 'urutan' => 5],
        ];
        
        foreach ($opsiRekan1 as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan1_2->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan1_3 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner1->id,
            'pertanyaan' => 'Aspek positif apa yang Anda amati dari alumni setelah pelatihan?',
            'jenis' => 'teks_panjang',
            'urutan' => 3,
            'wajib' => false,
        ]);
        
        // Kuesioner Rekan Kerja 2: Evaluasi Soft Skills
        $kuesioner2 = Pelatihan_5_Pascadiklat_Kuesioner::create([
            'judul' => 'Evaluasi Soft Skills Alumni',
            'deskripsi' => 'Kuesioner untuk menilai perkembangan soft skills alumni setelah mengikuti pelatihan',
            'role_target' => 'rekan',
            'is_active' => true,
        ]);
        
        $pertanyaan2_1 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Bagaimana penilaian Anda terhadap kemampuan komunikasi alumni?',
            'jenis' => 'skala_likert',
            'urutan' => 1,
            'wajib' => true,
        ]);
        
        // Opsi jawaban untuk kemampuan komunikasi
        $opsiKomunikasi = [
            ['teks_opsi' => 'Sangat Buruk', 'urutan' => 1],
            ['teks_opsi' => 'Buruk', 'urutan' => 2],
            ['teks_opsi' => 'Cukup Baik', 'urutan' => 3],
            ['teks_opsi' => 'Baik', 'urutan' => 4],
            ['teks_opsi' => 'Sangat Baik', 'urutan' => 5],
        ];
        
        foreach ($opsiKomunikasi as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan2_1->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan2_2 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Kemampuan apa yang paling terlihat perubahannya pada alumni? (Boleh pilih lebih dari satu)',
            'jenis' => 'checkbox',
            'urutan' => 2,
            'wajib' => false,
        ]);
        
        $opsiRekan2 = [
            ['teks_opsi' => 'Kemampuan presentasi', 'urutan' => 1],
            ['teks_opsi' => 'Kemampuan negosiasi', 'urutan' => 2],
            ['teks_opsi' => 'Kemampuan problem solving', 'urutan' => 3],
            ['teks_opsi' => 'Kemampuan adaptasi', 'urutan' => 4],
            ['teks_opsi' => 'Kemampuan kepemimpinan', 'urutan' => 5],
        ];
        
        foreach ($opsiRekan2 as $opsi) {
            Pelatihan_5_Pascadiklat_OpsiJawaban::create([
                'pertanyaan_id' => $pertanyaan2_2->id,
                'teks_opsi' => $opsi['teks_opsi'],
                'urutan' => $opsi['urutan'],
            ]);
        }
        
        $pertanyaan2_3 = Pelatihan_5_Pascadiklat_Pertanyaan::create([
            'kuesioner_id' => $kuesioner2->id,
            'pertanyaan' => 'Saran untuk pengembangan alumni selanjutnya:',
            'jenis' => 'teks_panjang',
            'urutan' => 3,
            'wajib' => false,
        ]);
    }
}