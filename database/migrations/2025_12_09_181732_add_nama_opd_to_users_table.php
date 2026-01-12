<?php
// File: database/migrations/xxxx_xx_xx_add_nama_opd_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom lama 'opd' kalau ada
            if (Schema::hasColumn('users', 'opd')) {
                $table->dropColumn('opd');
            }
            
            // Tambah kolom baru 'nama_opd'
            if (!Schema::hasColumn('users', 'nama_opd')) {
                $table->string('nama_opd')->nullable()->after('password');
            }
            
            // Tambah opd_id jika belum ada (untuk relasi ke table opds)
            if (!Schema::hasColumn('users', 'opd_id')) {
                $table->foreignId('opd_id')->nullable()->after('password')->constrained('opds')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['opd_id']);
            $table->dropColumn(['opd_id', 'nama_opd']);
            $table->string('opd')->nullable();
        });
    }
};