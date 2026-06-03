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
        Schema::create('pelatihan_5_pascadiklat_pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuesioner_id');
            $table->foreign('kuesioner_id', 'fk_pertanyaan_kuesioner')->references('id')->on('pelatihan_5_pascadiklat_kuesioner')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->enum('jenis', ['pilihan_ganda', 'pertanyaan_singkat', 'ya_tidak']);
            $table->integer('urutan')->default(0);
            $table->boolean('wajib')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_5_pascadiklat_pertanyaan');
    }
};
