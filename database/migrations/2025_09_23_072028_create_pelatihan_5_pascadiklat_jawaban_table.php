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
        Schema::create('pelatihan_5_pascadiklat_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('kuesioner_id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('opsi_jawaban_id')->nullable();
            $table->text('jawaban_teks')->nullable();
            $table->unsignedBigInteger('pelatihan_id')->nullable();
            $table->enum('role_pengisi', ['alumni', 'atasan', 'rekan']);
            $table->timestamp('tanggal_pengisian');
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('pegawai_id')->references('id')->on('ref_pegawais')->onDelete('cascade');
            $table->foreign('kuesioner_id')->references('id')->on('pelatihan_5_pascadiklat_kuesioner')->onDelete('cascade');
            $table->foreign('pertanyaan_id')->references('id')->on('pelatihan_5_pascadiklat_pertanyaan')->onDelete('cascade');
            $table->foreign('opsi_jawaban_id')->references('id')->on('pelatihan_5_pascadiklat_opsi_jawaban')->onDelete('cascade');
            $table->foreign('pelatihan_id')->references('id')->on('ref_namapelatihans')->onDelete('cascade');
            
            // Indexes
            $table->index(['pegawai_id', 'kuesioner_id']);
            $table->index(['kuesioner_id', 'pertanyaan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_5_pascadiklat_jawaban');
    }
};
