<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Script ini memindahkan file-file lama dari storage/app/private ke storage/app/public
     * agar bisa diakses via asset('storage/...')
     */
    public function up(): void
    {
        $directories = ['laporan', 'sk', 'pemaparan', 'dokumentasi', 'data_pendukung'];
        
        foreach ($directories as $dir) {
            $privatePath = storage_path('app/private/' . $dir);
            $publicPath = storage_path('app/public/' . $dir);
            
            // Jika direktori private ada, copy ke public
            if (File::exists($privatePath)) {
                // Buat direktori public jika belum ada
                if (!File::exists($publicPath)) {
                    File::makeDirectory($publicPath, 0755, true);
                }
                
                // Copy semua file
                $files = File::files($privatePath);
                foreach ($files as $file) {
                    $filename = $file->getFilename();
                    $destination = $publicPath . '/' . $filename;
                    
                    if (!File::exists($destination)) {
                        File::copy($file->getPathname(), $destination);
                        echo "Copied: {$dir}/{$filename}\n";
                    }
                }
            }
        }
        
        echo "File migration completed!\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu reverse, biarkan file di public
    }
};

