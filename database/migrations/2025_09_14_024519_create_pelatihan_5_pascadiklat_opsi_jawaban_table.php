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
        Schema::create('pelatihan_5_pascadiklat_opsi_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertanyaan_id');
            $table->foreign('pertanyaan_id', 'fk_opsi_pertanyaan')->references('id')->on('pelatihan_5_pascadiklat_pertanyaan')->onDelete('cascade');
            $table->string('teks_opsi');
            $table->integer('nilai')->nullable(); // Untuk menentukan bobot nilai jika diperlukan
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_5_pascadiklat_opsi_jawaban');
    }
};
