<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ref_pegawais;
use App\Models\ref_namapelatihan;
use App\Models\eva_1_alumni;
use App\Models\eva_2_atasan;
use App\Models\eva_3_rekansejawat;

class EvaluasiPascadiklatTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data pegawai dummy jika belum ada
        $this->createPegawaiDummy();
        
        // Buat data pelatihan dummy jika belum ada
        $this->createPelatihanDummy();
        
        // Buat data alumni dummy
        $this->createAlumniData();
    }
    
    private function createPegawaiDummy()
    {
        // Pegawai 1: Alumni
        ref_pegawais::updateOrCreate(
            ['nip' => '198901012015031001'],
            [
                'nama' => 'Budi Santoso',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/a',
                'jabatan' => 'Analis SDM',
                'unit_kerja' => 'Bagian Kepegawaian',
                'kode_unitkerja' => 'BKP001',
                'email' => 'budi@example.com',
                'id_atasan' => null, // Akan diset setelah atasan dibuat
            ]
        );
        
        // Pegawai 2: Atasan
        $atasan = ref_pegawais::updateOrCreate(
            ['nip' => '197801011999031002'],
            [
                'nama' => 'Siti Rahayu',
                'pangkat' => 'Penata',
                'golongan' => 'III/c',
                'jabatan' => 'Kabag Kepegawaian',
                'unit_kerja' => 'Bagian Kepegawaian',
                'kode_unitkerja' => 'BKP001',
                'email' => 'siti@example.com',
                'id_atasan' => null,
            ]
        );
        
        // Pegawai 3: Rekan Kerja
        ref_pegawais::updateOrCreate(
            ['nip' => '199002022017031003'],
            [
                'nama' => 'Ahmad Wijaya',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/a',
                'jabatan' => 'Analis Kepegawaian',
                'unit_kerja' => 'Bagian Kepegawaian',
                'kode_unitkerja' => 'BKP001',
                'email' => 'ahmad@example.com',
                'id_atasan' => $atasan->id,
            ]
        );
        
        // Update alumni dengan atasan
        $alumni = ref_pegawais::where('nip', '198901012015031001')->first();
        $alumni->update(['id_atasan' => $atasan->id]);
        
        echo "✓ Data pegawai dummy berhasil dibuat\n";
    }
    
    private function createPelatihanDummy()
    {
        ref_namapelatihan::updateOrCreate(
            ['nama' => 'Pelatihan Manajemen SDM'],
            [
                'deskripsi' => 'Pelatihan tentang manajemen sumber daya manusia modern',
                'durasi' => '3 hari',
                'jenis_pelatihan' => 'Teknis',
            ]
        );
        
        ref_namapelatihan::updateOrCreate(
            ['nama' => 'Pelatihan Leadership'],
            [
                'deskripsi' => 'Pelatihan kepemimpinan untuk pegawai senior',
                'durasi' => '5 hari',
                'jenis_pelatihan' => 'Kepemimpinan',
            ]
        );
        
        echo "✓ Data pelatihan dummy berhasil dibuat\n";
    }
    
    private function createAlumniData()
    {
        // Ambil data yang diperlukan
        $pegawaiBudi = ref_pegawais::where('nip', '198901012015031001')->first();
        $pegawaiSiti = ref_pegawais::where('nip', '197801011999031002')->first();
        $pegawaiAhmad = ref_pegawais::where('nip', '199002022017031003')->first();
        $pelatihan = ref_namapelatihan::where('nama', 'Pelatihan Manajemen SDM')->first();
        
        if (!$pegawaiBudi || !$pegawaiSiti || !$pegawaiAhmad || !$pelatihan) {
            echo "✗ Data pegawai atau pelatihan tidak lengkap\n";
            return;
        }
        
        // Buat data alumni
        $alumni = eva_1_alumni::updateOrCreate(
            [
                'pegawai_id' => $pegawaiBudi->id,
                'pelatihan_id' => $pelatihan->id,
            ],
            [
                'tanggal_mulai_pelatihan' => '2024-01-15',
                'tanggal_selesai_pelatihan' => '2024-01-17',
                'status_alumni' => 'belum_dinilai',
            ]
        );
        
        // Buat data atasan sebagai evaluator
        eva_2_atasan::updateOrCreate(
            [
                'alumni_id' => $alumni->alumni_id,
                'pegawai_id' => $pegawaiSiti->id,
            ],
            [
                'status_penilaian' => eva_2_atasan::STATUS_BELUM_DINILAI,
            ]
        );
        
        // Buat data rekan kerja sebagai evaluator
        eva_3_rekansejawat::updateOrCreate(
            [
                'alumni_id' => $alumni->alumni_id,
                'pegawai_id' => $pegawaiAhmad->id,
            ],
            [
                'status_penilaian' => eva_3_rekansejawat::STATUS_BELUM_DINILAI,
            ]
        );
        
        echo "✓ Data alumni dan evaluator berhasil dibuat\n";
        echo "   - Alumni: {$pegawaiBudi->nama} (NIP: {$pegawaiBudi->nip})\n";
        echo "   - Atasan: {$pegawaiSiti->nama} (NIP: {$pegawaiSiti->nip})\n";
        echo "   - Rekan: {$pegawaiAhmad->nama} (NIP: {$pegawaiAhmad->nip})\n";
    }
}