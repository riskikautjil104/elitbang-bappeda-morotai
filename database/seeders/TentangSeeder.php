<?php

namespace Database\Seeders;

use App\Models\Tentang;
use Illuminate\Database\Seeder;

class TentangSeeder extends Seeder
{
    public function run(): void
    {
        $tentangs = [
            [
                'judul' => 'Tentang Organisasi Kami',
                'konten' => 'Kami adalah organisasi yang berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat. Dengan pengalaman bertahun-tahun di bidang kami, kami telah berhasil membantu ribuan orang dalam mencapai tujuan mereka.

Organisasi kami didirikan dengan visi untuk menjadi pemimpin di bidang penelitian dan pengembangan. Kami percaya bahwa inovasi dan dedikasi adalah kunci untuk mencapai kesuksesan berkelanjutan.

Tim kami terdiri dari para ahli yang berpengalaman dan berkompeten di bidang masing-masing. Kami terus berinovasi dan mengembangkan diri untuk memberikan layanan yang terbaik kepada masyarakat.',
                'gambar' => null,
                'status' => true,
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Sejarah dan Perjalanan Kami',
                'konten' => 'Perjalanan organisasi kami dimulai pada tahun 2010 dengan visi sederhana namun kuat. Sejak saat itu, kami telah berkembang pesat dan menjadi salah satu organisasi terkemuka di bidang kami.

Dalam perjalanan ini, kami telah menghadapi berbagai tantangan dan peluang. Setiap tantangan yang kami hadapi menjadi pembelajaran berharga yang membuat kami lebih kuat dan lebih baik.

Kami bangga dengan pencapaian yang telah kami raih selama ini. Namun, kami menyadari bahwa ini hanyalah awal dari perjalanan panjang kami. Kami berkomitmen untuk terus berkembang dan memberikan kontribusi positif bagi masyarakat.',
                'gambar' => null,
                'status' => true,
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Tim Profesional Kami',
                'konten' => 'Tim kami terdiri dari para profesional yang memiliki pengalaman dan keahlian di bidang masing-masing. Setiap anggota tim kami dipilih dengan hati-hati berdasarkan kompetensi, pengalaman, dan komitmen mereka terhadap organisasi.

Kami percaya bahwa keberhasilan organisasi ditentukan oleh kualitas timnya. Oleh karena itu, kami terus berinvestasi dalam pengembangan kompetensi anggota tim kami melalui berbagai program pelatihan dan pengembangan.

Tim kami tidak hanya ahli di bidang teknis, tetapi juga memiliki kemampuan interpersonal yang baik. Hal ini memungkinkan kami untuk bekerja sama secara efektif dan memberikan layanan yang terbaik kepada klien kami.',
                'gambar' => null,
                'status' => true,
                'urutan' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($tentangs as $tentang) {
            Tentang::create($tentang);
        }
    }
}
