<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pelatihan_5_pascadiklat_jawaban', function (Blueprint $table) {
            // Tambah kolom alumni_id nullable jika belum ada
            if (!Schema::hasColumn('pelatihan_5_pascadiklat_jawaban', 'alumni_id')) {
                $table->unsignedBigInteger('alumni_id')->nullable()->after('pegawai_id');
                $table->foreign('alumni_id')->references('id')->on('ref_pegawais')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_5_pascadiklat_jawaban', function (Blueprint $table) {
            if (Schema::hasColumn('pelatihan_5_pascadiklat_jawaban', 'alumni_id')) {
                $table->dropForeign(['alumni_id']);
                $table->dropColumn('alumni_id');
            }
        });
    }
};
