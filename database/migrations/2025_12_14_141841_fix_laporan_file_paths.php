<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\LaporanAkhir;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $laporans = LaporanAkhir::all();
        
        foreach ($laporans as $laporan) {
            // Fix dokumentasi
            if ($laporan->file_dokumentasi) {
                $files = json_decode($laporan->file_dokumentasi, true);
                $fixedFiles = array_map(function($file) {
                    return strpos($file, 'dokumentasi/') === false 
                        ? 'dokumentasi/' . $file 
                        : $file;
                }, $files);
                $laporan->file_dokumentasi = json_encode($fixedFiles);
            }
            
            // Fix data pendukung
            if ($laporan->file_data_pendukung) {
                $files = json_decode($laporan->file_data_pendukung, true);
                $fixedFiles = array_map(function($file) {
                    return strpos($file, 'data_pendukung/') === false 
                        ? 'data_pendukung/' . $file 
                        : $file;
                }, $files);
                $laporan->file_data_pendukung = json_encode($fixedFiles);
            }
            
            $laporan->save();
        }
    }
};
