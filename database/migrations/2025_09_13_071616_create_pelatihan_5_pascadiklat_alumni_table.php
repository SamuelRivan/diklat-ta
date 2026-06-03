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
        Schema::create('pelatihan_5_pascadiklat_alumni', function (Blueprint $table) {
            $table->id('alumni_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('pelatihan_id');
            $table->date('tanggal_mulai_pelatihan')->nullable();
            $table->date('tanggal_selesai_pelatihan')->nullable();
            $table->enum('status_alumni', ['belum_dinilai', 'sedang_dinilai', 'sudah_dinilai'])->default('belum_dinilai');
            $table->timestamps();

            // Foreign keys
            $table->foreign('pegawai_id')->references('id')->on('ref_pegawais')->onDelete('cascade');
            $table->foreign('pelatihan_id')->references('id')->on('ref_namapelatihans')->onDelete('cascade');
            
            // Index untuk performance
            $table->index(['pegawai_id', 'pelatihan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_5_pascadiklat_alumni');
    }
};
