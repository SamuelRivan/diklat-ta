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
        Schema::create('pegawai_auth', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai')->unique();
            $table->string('password');
            $table->timestamps();

            // Foreign key ke ref_pegawais
            $table->foreign('id_pegawai')->references('id')->on('ref_pegawais')->onDelete('cascade');
            
            // Index untuk performance
            $table->index('id_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_auth');
    }
};
