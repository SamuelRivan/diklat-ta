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
        Schema::table('evaluasi_users', function (Blueprint $table) {
            // Drop unique index on NIP + Role
            $table->dropUnique('evaluasi_users_nip_role_unique');
            
            // Drop role column
            $table->dropColumn('role');

            // Add unique index on NIP (since one login per NIP, regardless of role)
            $table->unique('nip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_users', function (Blueprint $table) {
            $table->dropUnique(['nip']);
            $table->enum('role', ['alumni', 'atasan', 'rekan', 'rekan_kerja'])->after('tanggal_lahir');
            $table->unique(['nip', 'role']);
        });
    }
};
