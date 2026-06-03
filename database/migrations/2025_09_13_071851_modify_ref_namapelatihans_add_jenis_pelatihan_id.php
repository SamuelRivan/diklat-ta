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
        Schema::table('ref_namapelatihans', function (Blueprint $table) {
            // Drop kolom jenis_pelatihan lama
            $table->dropColumn('jenis_pelatihan');
            
            // Tambah kolom jenis_pelatihan_id sebagai foreign key
            $table->unsignedBigInteger('jenis_pelatihan_id')->after('id');
            
            // Tambah foreign key constraint
            $table->foreign('jenis_pelatihan_id')->references('id')->on('ref_jenispelatihans')->onDelete('cascade');
            
            // Index untuk performance
            $table->index('jenis_pelatihan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ref_namapelatihans', function (Blueprint $table) {
            // Drop foreign key constraint dan kolom jenis_pelatihan_id
            $table->dropForeign(['jenis_pelatihan_id']);
            $table->dropIndex(['jenis_pelatihan_id']);
            $table->dropColumn('jenis_pelatihan_id');
            
            // Tambah kembali kolom jenis_pelatihan sebagai string
            $table->string('jenis_pelatihan')->nullable();
        });
    }
};
