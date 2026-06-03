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
        // Tambah kolom pelatihan_id ke tabel atasan
        Schema::table('pelatihan_5_pascadiklat_atasan', function (Blueprint $table) {
            if (!Schema::hasColumn('pelatihan_5_pascadiklat_atasan', 'pelatihan_id')) {
                $table->unsignedBigInteger('pelatihan_id')->nullable()->after('pegawai_id');
                $table->foreign('pelatihan_id')->references('id')->on('ref_namapelatihans')->nullOnDelete();
            }
        });

        // Tambah kolom pelatihan_id ke tabel rekan kerja
        Schema::table('pelatihan_5_pascadiklat_rekankerja', function (Blueprint $table) {
            if (!Schema::hasColumn('pelatihan_5_pascadiklat_rekankerja', 'pelatihan_id')) {
                $table->unsignedBigInteger('pelatihan_id')->nullable()->after('pegawai_id');
                $table->foreign('pelatihan_id')->references('id')->on('ref_namapelatihans')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_5_pascadiklat_atasan', function (Blueprint $table) {
            if (Schema::hasColumn('pelatihan_5_pascadiklat_atasan', 'pelatihan_id')) {
                $table->dropForeign(['pelatihan_id']);
                $table->dropColumn('pelatihan_id');
            }
        });

        Schema::table('pelatihan_5_pascadiklat_rekankerja', function (Blueprint $table) {
            if (Schema::hasColumn('pelatihan_5_pascadiklat_rekankerja', 'pelatihan_id')) {
                $table->dropForeign(['pelatihan_id']);
                $table->dropColumn('pelatihan_id');
            }
        });
    }
};
