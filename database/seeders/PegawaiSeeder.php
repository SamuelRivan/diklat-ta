<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert contoh data pegawai jika diperlukan
        $pegawaiData = [
            [
                'id' => 1,
                'nip' => 19850101,
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1985-01-01',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/a',
                'jabatan' => 'Analis Kebijakan',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Fungsional',
                'kode_unitkerja' => 1,
                'email' => 'budi.santoso@bkpsdm.go.id',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 1',
                'tmt' => '2010-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'nip' => 19850202,
                'nama' => 'Siti Rahayu',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-02-02',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/b',
                'jabatan' => 'Analis SDM',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Fungsional',
                'kode_unitkerja' => 1,
                'email' => 'siti.rahayu@bkpsdm.go.id',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Sudirman No. 2',
                'tmt' => '2010-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'nip' => 19850303,
                'nama' => 'Ahmad Wijaya',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1985-03-03',
                'pangkat' => 'Penata',
                'golongan' => 'III/c',
                'jabatan' => 'Analis Kinerja',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Fungsional',
                'kode_unitkerja' => 1,
                'email' => 'ahmad.wijaya@bkpsdm.go.id',
                'no_hp' => '081234567892',
                'alamat' => 'Jl. Diponegoro No. 3',
                'tmt' => '2010-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'nip' => 19750404,
                'nama' => 'Dr. Indra Gunawan',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1975-04-04',
                'pangkat' => 'Pembina',
                'golongan' => 'IV/a',
                'jabatan' => 'Kepala Bagian Perencanaan',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Struktural',
                'kode_unitkerja' => 1,
                'email' => 'indra.gunawan@bkpsdm.go.id',
                'no_hp' => '081234567893',
                'alamat' => 'Jl. Ahmad Yani No. 4',
                'tmt' => '2005-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'nip' => 19760505,
                'nama' => 'Dra. Sari Wulandari',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1976-05-05',
                'pangkat' => 'Pembina',
                'golongan' => 'IV/a',
                'jabatan' => 'Kepala Bagian Pengembangan SDM',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Struktural',
                'kode_unitkerja' => 1,
                'email' => 'sari.wulandari@bkpsdm.go.id',
                'no_hp' => '081234567894',
                'alamat' => 'Jl. Pahlawan No. 5',
                'tmt' => '2005-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'nip' => 19860606,
                'nama' => 'Eko Prasetyo',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1986-06-06',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/b',
                'jabatan' => 'Analis Pelatihan',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Fungsional',
                'kode_unitkerja' => 1,
                'email' => 'eko.prasetyo@bkpsdm.go.id',
                'no_hp' => '081234567895',
                'alamat' => 'Jl. Kartini No. 6',
                'tmt' => '2010-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'nip' => 19870707,
                'nama' => 'Maya Sari',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1987-07-07',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/a',
                'jabatan' => 'Analis Kompetensi',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Fungsional',
                'kode_unitkerja' => 1,
                'email' => 'maya.sari@bkpsdm.go.id',
                'no_hp' => '081234567896',
                'alamat' => 'Jl. Imam Bonjol No. 7',
                'tmt' => '2010-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'nip' => 19880808,
                'nama' => 'Rizki Ramadhan',
                'tempat_lahir' => 'Depok',
                'tanggal_lahir' => '1988-08-08',
                'pangkat' => 'Penata Muda',
                'golongan' => 'III/a',
                'jabatan' => 'Analis Mutasi',
                'jenis_asn' => 'PNS',
                'kategori_jabatanasn' => 'Fungsional',
                'kode_unitkerja' => 1,
                'email' => 'rizki.ramadhan@bkpsdm.go.id',
                'no_hp' => '081234567897',
                'alamat' => 'Jl. Thamrin No. 8',
                'tmt' => '2010-01-01',
                'foto' => 'default.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert to ref_pegawais
        if (DB::getSchemaBuilder()->hasTable('ref_pegawais')) {
            DB::table('ref_pegawais')->insertOrIgnore($pegawaiData);
            $this->command->info("Data pegawai berhasil di-seed ke tabel: ref_pegawais!");
        } else {
            $this->command->warn('Tabel ref_pegawais tidak ditemukan. Silakan jalankan migrasi terlebih dahulu.');
        }

        // Insert user accounts for login (if users table exists)
        if (DB::getSchemaBuilder()->hasTable('users')) {
            $userData = [
                [
                    'id' => 1,
                    'name' => 'Admin System',
                    'email' => 'admin@bkpsdm.go.id',
                    'password' => Hash::make('password123'),
                    'role' => 'admin',
                    'pegawai_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id' => 2,
                    'name' => 'Budi Santoso',
                    'email' => 'budi.santoso@bkpsdm.go.id',
                    'password' => Hash::make('password123'),
                    'role' => 'alumni',
                    'pegawai_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id' => 3,
                    'name' => 'Siti Rahayu',
                    'email' => 'siti.rahayu@bkpsdm.go.id',
                    'password' => Hash::make('password123'),
                    'role' => 'alumni',
                    'pegawai_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id' => 4,
                    'name' => 'Dr. Indra Gunawan',
                    'email' => 'indra.gunawan@bkpsdm.go.id',
                    'password' => Hash::make('password123'),
                    'role' => 'atasan',
                    'pegawai_id' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id' => 5,
                    'name' => 'Eko Prasetyo',
                    'email' => 'eko.prasetyo@bkpsdm.go.id',
                    'password' => Hash::make('password123'),
                    'role' => 'rekan_kerja',
                    'pegawai_id' => 6,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ];

            DB::table('users')->insertOrIgnore($userData);
            $this->command->info('Data users berhasil di-seed!');
        }
    }
}