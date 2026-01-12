<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_akhirs', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada, kalau belum baru tambah
            if (!Schema::hasColumn('laporan_akhirs', 'catatan_admin')) {
                $table->longText('catatan_admin')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('laporan_akhirs', 'tanggal_verifikasi')) {
                $table->timestamp('tanggal_verifikasi')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('laporan_akhirs', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->constrained('users')->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporan_akhirs', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_akhirs', 'catatan_admin')) {
                $table->dropColumn('catatan_admin');
            }
            
            if (Schema::hasColumn('laporan_akhirs', 'tanggal_verifikasi')) {
                $table->dropColumn('tanggal_verifikasi');
            }
            
            if (Schema::hasColumn('laporan_akhirs', 'verified_by')) {
                $table->dropForeign(['verified_by']);
                $table->dropColumn('verified_by');
            }
        });
    }
};