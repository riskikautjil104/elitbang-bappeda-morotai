<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel OPD
        Schema::create('opds', function (Blueprint $table) {
            $table->id();
            $table->string('nama_opd');
            $table->string('kode_opd')->unique();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
        });

        // Update tabel users - tambah kolom role dan opd_id
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'operator', 'viewer'])->default('operator')->after('email');
            $table->foreignId('opd_id')->nullable()->constrained('opds')->onDelete('set null')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['opd_id']);
            $table->dropColumn(['role', 'opd_id']);
        });
        
        Schema::dropIfExists('opds');
    }
};