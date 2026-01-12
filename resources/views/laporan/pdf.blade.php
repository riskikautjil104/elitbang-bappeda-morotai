<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Akhir - {{ $laporan->judul_kegiatan }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .header p {
            font-size: 11pt;
            margin: 3px 0;
        }
        
        .title {
            text-align: center;
            margin: 30px 0;
        }
        
        .title h2 {
            font-size: 16pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
        }
        
        .title h3 {
            font-size: 14pt;
            font-weight: bold;
            margin-top: 15px;
        }
        
        .section {
            margin: 25px 0;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            color: #1F4788;
            margin-bottom: 10px;
            border-bottom: 2px solid #1F4788;
            padding-bottom: 5px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        .info-table td {
            padding: 8px;
            border: 1px solid #000;
        }
        
        .info-table td:first-child {
            width: 35%;
            font-weight: bold;
            background-color: #f5f5f5;
        }
        
        .content {
            text-align: justify;
            margin: 10px 0;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 11pt;
        }
        
        .status-diterima {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-revisi {
            background-color: #ffeaa7;
            color: #d63031;
        }
        
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10pt;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        @page {
            margin: 2cm;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <h1>Laporan Akhir Kegiatan E-Litbang</h1>
        <p>Pemerintah Kota - Badan Penelitian dan Pengembangan</p>
        <p>Jl. Contoh No. 123, Kota, Provinsi</p>
    </div>
    
    <!-- TITLE -->
    <div class="title">
        <h2>LAPORAN AKHIR KEGIATAN</h2>
        <h3>{{ strtoupper($laporan->judul_kegiatan) }}</h3>
    </div>
    
    <!-- INFORMASI DASAR -->
    <div class="section">
        <div class="section-title">I. INFORMASI DASAR</div>
        <table class="info-table">
            <tr>
                <td>Jenis Kegiatan</td>
                <td>{{ ucfirst($laporan->jenis_kegiatan) }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td>{{ $laporan->penanggung_jawab }}</td>
            </tr>
            <tr>
                <td>OPD</td>
                <td>{{ $laporan->user->nama_opd ?? $laporan->user->name }}</td>
            </tr>
            <tr>
                <td>Tahun Pelaksanaan</td>
                <td>{{ $laporan->tahun_pelaksanaan }}</td>
            </tr>
            <tr>
                <td>Lokasi Kegiatan</td>
                <td>{{ $laporan->lokasi_kegiatan }}</td>
            </tr>
            <tr>
                <td>Periode Pelaksanaan</td>
                <td>{{ $laporan->tanggal_mulai->format('d/m/Y') }} s/d {{ $laporan->tanggal_selesai->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Anggaran</td>
                <td>Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Persentase Realisasi</td>
                <td><strong>{{ $laporan->persentase_realisasi }}%</strong></td>
            </tr>
            <tr>
                <td>Realisasi Anggaran</td>
                <td>Rp {{ number_format(($laporan->anggaran * $laporan->persentase_realisasi) / 100, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span class="status-badge status-{{ $laporan->status }}">
                        {{ strtoupper($laporan->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- LATAR BELAKANG -->
    <div class="section">
        <div class="section-title">II. LATAR BELAKANG</div>
        <div class="content">
            {{ $laporan->latar_belakang }}
        </div>
    </div>
    
    <!-- TUJUAN -->
    <div class="section">
        <div class="section-title">III. TUJUAN KEGIATAN</div>
        <div class="content">
            {{ $laporan->tujuan_kegiatan }}
        </div>
    </div>
    
    <!-- METODE -->
    <div class="section">
        <div class="section-title">IV. METODE PELAKSANAAN</div>
        <div class="content">
            {{ $laporan->metode_pelaksanaan }}
        </div>
    </div>
    
    <!-- TAHAPAN -->
    <div class="section">
        <div class="section-title">V. TAHAPAN PELAKSANAAN</div>
        <div class="content">
            {{ $laporan->tahapan_pelaksanaan }}
        </div>
    </div>
    
    <div class="page-break"></div>
    
    <!-- OUTPUT -->
    <div class="section">
        <div class="section-title">VI. OUTPUT KEGIATAN</div>
        <div class="content">
            {{ $laporan->output_kegiatan }}
        </div>
    </div>
    
    <!-- HASIL -->
    <div class="section">
        <div class="section-title">VII. HASIL KEGIATAN</div>
        <div class="content">
            {{ $laporan->hasil_kegiatan }}
        </div>
    </div>
    
    <!-- KENDALA -->
    <div class="section">
        <div class="section-title">VIII. KENDALA PELAKSANAAN</div>
        <div class="content">
            {{ $laporan->kendala_pelaksanaan }}
        </div>
    </div>
    
    <!-- SOLUSI -->
    <div class="section">
        <div class="section-title">IX. SOLUSI KENDALA</div>
        <div class="content">
            {{ $laporan->solusi_kendala }}
        </div>
    </div>
    
    @if($laporan->tanggal_verifikasi)
    <!-- VERIFIKASI -->
    <div class="section page-break">
        <div class="section-title">X. VERIFIKASI</div>
        <table class="info-table">
            <tr>
                <td>Tanggal Verifikasi</td>
                <td>{{ $laporan->tanggal_verifikasi->format('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <td>Diverifikasi Oleh</td>
                <td>{{ $laporan->verifiedBy->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Catatan Admin</td>
                <td>{{ $laporan->catatan_admin ?? '-' }}</td>
            </tr>
        </table>
    </div>
    @endif
    
    <!-- FOOTER -->
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem E-Litbang</p>
        <p>Tanggal Cetak: {{ date('d F Y, H:i') }} WIB</p>
        <p>© {{ date('Y') }} Pemerintah Kota - Badan Penelitian dan Pengembangan</p>
    </div>
</body>
</html>