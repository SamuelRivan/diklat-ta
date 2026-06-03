<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pelatihan_5_pascadiklat_pertanyaan', function (Blueprint $table) {
            // Update enum untuk menambahkan lebih banyak jenis pertanyaan
            DB::statement("ALTER TABLE pelatihan_5_pascadiklat_pertanyaan MODIFY COLUMN jenis ENUM('pilihan_ganda', 'pertanyaan_singkat', 'ya_tidak', 'skala_likert', 'teks_panjang', 'checkbox')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_5_pascadiklat_pertanyaan', function (Blueprint $table) {
            // Kembalikan ke enum asli
            DB::statement("ALTER TABLE pelatihan_5_pascadiklat_pertanyaan MODIFY COLUMN jenis ENUM('pilihan_ganda', 'pertanyaan_singkat', 'ya_tidak')");
        });
    }
};
