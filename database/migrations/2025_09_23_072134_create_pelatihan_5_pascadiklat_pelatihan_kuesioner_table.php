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
        Schema::create('pelatihan_5_pascadiklat_pelatihan_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelatihan_id');
            $table->unsignedBigInteger('kuesioner_id');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('pelatihan_id')->references('id')->on('ref_namapelatihans')->onDelete('cascade');
            $table->foreign('kuesioner_id')->references('id')->on('pelatihan_5_pascadiklat_kuesioner')->onDelete('cascade');
            
            // Unique constraint
            $table->unique(['pelatihan_id', 'kuesioner_id'], 'p5_pasca_pel_kues_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_5_pascadiklat_pelatihan_kuesioner');
    }
};
