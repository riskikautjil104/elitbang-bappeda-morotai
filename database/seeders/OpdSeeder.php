<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opd;

class OpdSeeder extends Seeder
{
    public function run(): void
    {
        $opds = [
            ['nama_opd' => 'Dinas Pendidikan', 'kode_opd' => 'DISDIK', 'alamat' => 'Jl. Pendidikan No. 1', 'telepon' => '0411-123456'],
            ['nama_opd' => 'Dinas Kesehatan', 'kode_opd' => 'DINKES', 'alamat' => 'Jl. Kesehatan No. 2', 'telepon' => '0411-234567'],
            ['nama_opd' => 'Dinas Pekerjaan Umum', 'kode_opd' => 'DISPU', 'alamat' => 'Jl. PU No. 3', 'telepon' => '0411-345678'],
            ['nama_opd' => 'Badan Perencanaan Pembangunan Daerah', 'kode_opd' => 'BAPPEDA', 'alamat' => 'Jl. Perencanaan No. 4', 'telepon' => '0411-456789'],
            ['nama_opd' => 'Dinas Komunikasi dan Informatika', 'kode_opd' => 'DISKOMINFO', 'alamat' => 'Jl. Teknologi No. 5', 'telepon' => '0411-567890'],
        ];

        foreach ($opds as $opd) {
            Opd::create($opd);
        }
    }
}