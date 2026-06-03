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
        Schema::create('evaluasi_users', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('email');
            $table->string('nama');
            $table->string('password');
            $table->date('tanggal_lahir');
            $table->enum('role', ['alumni', 'atasan', 'rekan', 'rekan_kerja']); 
            $table->timestamps();
            
            // Unique constraint on nip and role combination
            // Assuming a user can have different roles with the same NIP
            $table->unique(['nip', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_users');
    }
};
