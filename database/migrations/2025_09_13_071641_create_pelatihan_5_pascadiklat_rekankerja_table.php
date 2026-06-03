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
        Schema::create('pelatihan_5_pascadiklat_rekankerja', function (Blueprint $table) {
            $table->id('rekankerja_id');
            $table->unsignedBigInteger('alumni_id');
            $table->unsignedBigInteger('pegawai_id'); // ID pegawai yang menjadi rekan kerja
            $table->enum('status_penilaian', ['belum_dinilai', 'sudah_dinilai'])->default('belum_dinilai');
            $table->timestamps();

            // Foreign keys
            $table->foreign('alumni_id')->references('alumni_id')->on('pelatihan_5_pascadiklat_alumni')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('ref_pegawais')->onDelete('cascade');
            
            // Index untuk performance
            $table->index(['alumni_id']);
            $table->index(['pegawai_id']);
            
            // Constraint: satu alumni hanya boleh punya satu rekan kerja
            $table->unique(['alumni_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_5_pascadiklat_rekankerja');
    }
};
