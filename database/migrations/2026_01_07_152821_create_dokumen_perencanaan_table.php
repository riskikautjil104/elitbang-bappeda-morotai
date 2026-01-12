<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumen_perencanaan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('jenis', ['RPJMD', 'RPJPD', 'RKPD', 'RENSTRA', 'RENJA', 'Lainnya']);
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->integer('file_size');
            $table->year('tahun');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_online')->default(false);
            $table->enum('visibility', ['semua_opd', 'opd_terpilih', 'tidak_dikirim'])->default('tidak_dikirim');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabel pivot untuk dokumen yang dikirim ke OPD tertentu
        Schema::create('dokumen_opd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumen_id')->constrained('dokumen_perencanaan')->onDelete('cascade');
            $table->foreignId('opd_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            $table->unique(['dokumen_id', 'opd_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_opd');
        Schema::dropIfExists('dokumen_perencanaan');
    }
};