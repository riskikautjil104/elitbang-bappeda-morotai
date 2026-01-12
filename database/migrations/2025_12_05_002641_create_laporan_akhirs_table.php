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
        Schema::create('laporan_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_kegiatan');
            $table->string('jenis_kegiatan')->default('penelitian');
            $table->string('penanggung_jawab');
            $table->year('tahun_pelaksanaan');
            $table->text('lokasi_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('anggaran', 15, 2);
            $table->longText('latar_belakang');
            $table->longText('tujuan_kegiatan');
            $table->longText('metode_pelaksanaan');
            $table->longText('tahapan_pelaksanaan');
            $table->longText('output_kegiatan');
            $table->longText('hasil_kegiatan');
            $table->tinyInteger('persentase_realisasi')->default(0);
            $table->longText('kendala_pelaksanaan');
            $table->longText('solusi_kendala');
            $table->string('file_laporan');
            $table->json('file_dokumentasi');
            $table->json('file_data_pendukung')->nullable();
            $table->string('file_sk');
            $table->string('file_pemaparan');
            $table->string('status')->default('menunggu verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_akhirs');
    }
};
