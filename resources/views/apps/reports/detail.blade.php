<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Detail Laporan Akhir Kegiatan
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('apps.reports.index') }}">Laporan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail Laporan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Alert -->
    @if ($laporan->status == 'menunggu verifikasi')
        <div class="alert alert-warning border-yellow-500/20 bg-yellow-500/10 mb-6" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm">
                    <strong class="font-semibold">Status: Menunggu Verifikasi</strong> - Laporan sedang dalam proses peninjauan.
                </div>
            </div>
        </div>
    @elseif($laporan->status == 'diterima')
        <div class="alert alert-success border-green-500/20 bg-green-500/10 mb-6" role="alert">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm">
                    <strong class="font-semibold">Status: Diterima</strong> - Laporan telah diverifikasi dan disetujui.
                    @if($laporan->catatan_admin)
                        <p class="mt-2"><strong>Catatan Admin:</strong> {{ $laporan->catatan_admin }}</p>
                    @endif
                </div>
            </div>
        </div>
    @elseif($laporan->status == 'revisi')
        <div class="alert alert-warning border-orange-500/20 bg-orange-500/10 mb-6" role="alert">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-orange-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm">
                    <strong class="font-semibold">Status: Perlu Revisi</strong>
                    @if($laporan->catatan_admin)
                        <p class="mt-2"><strong>Catatan Admin:</strong> {{ $laporan->catatan_admin }}</p>
                    @endif
                </div>
            </div>
        </div>
    @elseif($laporan->status == 'ditolak')
        <div class="alert alert-danger border-red-500/20 bg-red-500/10 mb-6" role="alert">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm">
                    <strong class="font-semibold">Status: Ditolak</strong>
                    @if($laporan->catatan_admin)
                        <p class="mt-2"><strong>Alasan:</strong> {{ $laporan->catatan_admin }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-3 mb-6">
        <button onclick="window.print()" class="btn btn-outline-primary rounded-lg px-6 h-11">
            <i class="ti ti-printer mr-2"></i> Cetak
        </button>
        <a href="{{ route('apps.reports.index') }}" class="btn btn-outline-secondary rounded-lg px-6 h-11">
            <i class="ti ti-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Section 1: Informasi Umum -->
            <div class="card mb-6">
                <div class="card-header bg-primary-500/10 border-b border-primary-500/20">
                    <div class="flex items-center">
                        <div class="h-8 w-1 bg-primary-500 mr-3"></div>
                        <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-0">
                            Informasi Umum Kegiatan
                        </h5>
                    </div>
                </div>
                <div class="card-body p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Judul Kegiatan</label>
                            <p class="text-base text-gray-800 dark:text-white font-medium">
                                {{ $laporan->judul_kegiatan }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Jenis Kegiatan</label>
                            <span class="badge {{ $laporan->jenis_kegiatan == 'penelitian' ? 'bg-blue-500' : 'bg-purple-500' }} text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ ucfirst($laporan->jenis_kegiatan) }}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">OPD Pengusul</label>
                            <p class="text-base text-gray-800 dark:text-white">{{ $laporan->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Penanggung Jawab</label>
                            <p class="text-base text-gray-800 dark:text-white">{{ $laporan->penanggung_jawab }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Tahun Pelaksanaan</label>
                            <p class="text-base text-gray-800 dark:text-white">{{ $laporan->tahun_pelaksanaan }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Lokasi Kegiatan</label>
                            <p class="text-base text-gray-800 dark:text-white">{{ $laporan->lokasi_kegiatan }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Periode Pelaksanaan</label>
                            <p class="text-base text-gray-800 dark:text-white">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_mulai)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 block">Anggaran</label>
                            <p class="text-base text-gray-800 dark:text-white font-semibold">
                                Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Detail Kegiatan -->
            <div class="card mb-6">
                <div class="card-header bg-primary-500/10 border-b border-primary-500/20">
                    <div class="flex items-center">
                        <div class="h-8 w-1 bg-primary-500 mr-3"></div>
                        <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-0">
                            Detail Kegiatan
                        </h5>
                    </div>
                </div>
                <div class="card-body p-6">
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Latar Belakang</label>
                            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                <p class="text-justify leading-relaxed">{{ $laporan->latar_belakang }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Tujuan Kegiatan</label>
                            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                <p class="text-justify leading-relaxed">{{ $laporan->tujuan_kegiatan }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Metode Pelaksanaan</label>
                            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                <p class="text-justify leading-relaxed">{{ $laporan->metode_pelaksanaan }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Tahapan Pelaksanaan</label>
                            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                <p class="text-justify leading-relaxed">{{ $laporan->tahapan_pelaksanaan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Hasil dan Evaluasi -->
            <div class="card mb-6">
                <div class="card-header bg-primary-500/10 border-b border-primary-500/20">
                    <div class="flex items-center">
                        <div class="h-8 w-1 bg-primary-500 mr-3"></div>
                        <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-0">
                            Hasil dan Evaluasi
                        </h5>
                    </div>
                </div>
                <div class="card-body p-6">
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Output Kegiatan</label>
                            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                <p class="text-justify leading-relaxed">{{ $laporan->output_kegiatan }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Hasil Kegiatan</label>
                            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                <p class="text-justify leading-relaxed">{{ $laporan->hasil_kegiatan }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Persentase Realisasi</label>
                            <div class="flex items-center">
                                <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-8 mr-4">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-8 rounded-full flex items-center justify-center text-white font-semibold text-sm"
                                        style="width: {{ $laporan->persentase_realisasi }}%">
                                        {{ $laporan->persentase_realisasi }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($laporan->kendala_pelaksanaan)
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Kendala Pelaksanaan</label>
                                <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                    <p class="text-justify leading-relaxed">{{ $laporan->kendala_pelaksanaan }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($laporan->solusi_kendala)
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2 block">Solusi Kendala</label>
                                <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                    <p class="text-justify leading-relaxed">{{ $laporan->solusi_kendala }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

     
            <!-- Section 4: Lampiran Dokumen -->
<div class="card mb-6">
    <div class="card-header bg-primary-500/10 border-b border-primary-500/20">
        <div class="flex items-center">
            <div class="h-8 w-1 bg-primary-500 mr-3"></div>
            <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-0">
                Lampiran Dokumen
            </h5>
        </div>
    </div>
    <div class="card-body p-6">
        <div class="space-y-4">
            <!-- File Laporan PDF -->
            @if ($laporan->file_laporan)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">Laporan PDF</p>
                            <p class="text-sm text-gray-500">{{ basename($laporan->file_laporan) }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $laporan->file_laporan) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </a>
                </div>
            @endif

            <!-- File Dokumentasi (PERBAIKAN) -->
            @if (!empty($laporan->file_dokumentasi_array))
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-white">Dokumentasi</p>
                                <p class="text-sm text-gray-500">{{ count($laporan->file_dokumentasi_array) }} file(s)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- List file dokumentasi -->
                    <div class="mt-3 space-y-2 pl-16">
                        @foreach ($laporan->file_dokumentasi_array as $index => $file)
                            <div class="flex items-center justify-between py-2 px-3 bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ basename($file) }}</span>
                                </div>
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Lihat
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- File Data Pendukung (PERBAIKAN) -->
            @if (!empty($laporan->file_data_pendukung_array))
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-white">Data Pendukung</p>
                                <p class="text-sm text-gray-500">{{ count($laporan->file_data_pendukung_array) }} file(s)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- List file data pendukung -->
                    <div class="mt-3 space-y-2 pl-16">
                        @foreach ($laporan->file_data_pendukung_array as $index => $file)
                            <div class="flex items-center justify-between py-2 px-3 bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ basename($file) }}</span>
                                </div>
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Download
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- File SK -->
            @if ($laporan->file_sk)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">Surat Keputusan</p>
                            <p class="text-sm text-gray-500">{{ basename($laporan->file_sk) }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $laporan->file_sk) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </a>
                </div>
            @endif

            <!-- File Pemaparan -->
            @if ($laporan->file_pemaparan)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">Presentasi/Pemaparan</p>
                            <p class="text-sm text-gray-500">{{ basename($laporan->file_pemaparan) }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $laporan->file_pemaparan) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

            <!-- Section 5: Informasi Tambahan -->
            <div class="card">
                <div class="card-header bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-0">
                        Informasi Tambahan
                    </h5>
                </div>
                <div class="card-body p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <label class="text-gray-500 dark:text-gray-400 mb-1 block">Status Verifikasi</label>
                            <span class="badge
                                @if ($laporan->status == 'menunggu verifikasi') bg-yellow-500
                                @elseif($laporan->status == 'diterima') bg-green-500
                                @elseif($laporan->status == 'revisi') bg-orange-500
                                @else bg-red-500 @endif text-white px-3 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </div>
                        @if($laporan->tanggal_verifikasi)
                        <div>
                            <label class="text-gray-500 dark:text-gray-400 mb-1 block">Tanggal Verifikasi</label>
                            <p class="text-gray-800 dark:text-white font-medium">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_verifikasi)->format('d M Y H:i') }}
                            </p>
                        </div>
                        @endif
                        @if($laporan->verifiedBy)
                        <div>
                            <label class="text-gray-500 dark:text-gray-400 mb-1 block">Diverifikasi Oleh</label>
                            <p class="text-gray-800 dark:text-white font-medium">
                                {{ $laporan->verifiedBy->name }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .page-header, .breadcrumb, .btn, button, .modal {
                display: none !important;
            }
            .card {
                border: 1px solid #ddd !important;
                box-shadow: none !important;
                page-break-inside: avoid;
            }
        }
    </style>
</x-app>