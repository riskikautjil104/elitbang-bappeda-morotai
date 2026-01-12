<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('label'); // Email, Telepon, Alamat, dll
            $table->text('nilai'); // Nilai kontak (email, nomor, alamat)
            $table->string('icon')->nullable(); // Icon tabler/lineicons
            $table->integer('urutan')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};