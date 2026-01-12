<x-app>
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-700 ">
                            Detail Laporan Akhir
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.admin.index') }}">Laporan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success mb-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mb-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <!-- Informasi Umum -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Informasi Umum</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Judul Kegiatan</label>
                            <p class="text-gray-600  mt-1">{{ $laporan->judul_kegiatan }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600 ">Jenis Kegiatan</label>
                                <p class="text-gray-600  capitalize">{{ $laporan->jenis_kegiatan_label }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600 ">Tahun Pelaksanaan</label>
                                <p class="text-gray-600  mt-1">{{ $laporan->tahun_pelaksanaan }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600 ">Penanggung Jawab</label>
                                <p class="text-gray-600  mt-1">{{ $laporan->penanggung_jawab }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600 ">OPD</label>
                                <p class="text-gray-600  mt-1">{{ $laporan->user->name }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600 ">Periode Pelaksanaan</label>
                            <p class="text-gray-600  mt-1">
                                {{ $laporan->tanggal_mulai->format('d M Y') }} -
                                {{ $laporan->tanggal_selesai->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Eksekutif -->
            @if ($laporan->ringkasan_eksekutif)
                <div class="card mb-4">
                    <div class="card-header bg-primary-500/10">
                        <h5 class="text-lg font-semibold mb-0">Ringkasan Eksekutif</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->ringkasan_eksekutif }}</p>
                    </div>
                </div>
            @endif

            <!-- Latar Belakang -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Latar Belakang</h5>
                </div>
                <div class="card-body">
                    <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->latar_belakang }}</p>
                </div>
            </div>

            <!-- Tujuan Kegiatan -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Tujuan Kegiatan</h5>
                </div>
                <div class="card-body">
                    <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->tujuan_kegiatan }}</p>
                </div>
            </div>

            <!-- Metodologi -->
            @if ($laporan->metodologi)
                <div class="card mb-4">
                    <div class="card-header bg-primary-500/10">
                        <h5 class="text-lg font-semibold mb-0">Metodologi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->metodologi }}</p>
                    </div>
                </div>
            @endif

            <!-- Hasil Kegiatan -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Hasil Kegiatan</h5>
                </div>
                <div class="card-body">
                    <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->hasil_kegiatan }}</p>
                </div>
            </div>

            <!-- Hasil & Pembahasan -->
            @if ($laporan->hasil_pembahasan)
                <div class="card mb-4">
                    <div class="card-header bg-primary-500/10">
                        <h5 class="text-lg font-semibold mb-0">Hasil & Pembahasan</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->hasil_pembahasan }}</p>
                    </div>
                </div>
            @endif

            <!-- Kesimpulan -->
            @if ($laporan->kesimpulan)
                <div class="card mb-4">
                    <div class="card-header bg-primary-500/10">
                        <h5 class="text-lg font-semibold mb-0">Kesimpulan</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->kesimpulan }}</p>
                    </div>
                </div>
            @endif

            <!-- Rekomendasi -->
            @if ($laporan->rekomendasi)
                <div class="card mb-4">
                    <div class="card-header bg-primary-500/10">
                        <h5 class="text-lg font-semibold mb-0">Rekomendasi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600  mt-1 text-sm leading-relaxed">{{ $laporan->rekomendasi }}</p>
                    </div>
                </div>
            @endif

            <!-- Anggaran & Realisasi -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Anggaran & Realisasi</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Anggaran</label>
                                <p class="text-gray-700 ">Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Realisasi
                                    Anggaran</label>
                                <p class="text-gray-700 dark:text-gray-300">Rp
                                    {{ number_format($laporan->realisasi_anggaran ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-2 block">Persentase
                                Realisasi</label>
                            <div class="flex items-center gap-3">
                                <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                    <div class="bg-green-500 h-3 rounded-full transition-all duration-300"
                                        style="width: {{ $laporan->persentase_realisasi }}%"></div>
                                </div>
                                <span
                                    class="font-semibold text-gray-700 dark:text-gray-300">{{ $laporan->persentase_realisasi }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lampiran Dokumen -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Lampiran Dokumen</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-3">
                        <!-- File Laporan PDF -->
                        @if ($laporan->file_laporan)
                            <div
                                class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/10 rounded-lg border border-red-200 dark:border-red-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-gray-600">Laporan PDF</p>
                                        <p class="text-xs text-gray-500">{{ basename($laporan->file_laporan) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $laporan->file_laporan) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endif

                        <!-- File Dokumentasi -->
                        @if (!empty($laporan->file_dokumentasi_array))
                            <div
                                class="p-3 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-200 dark:border-blue-800">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-gray-600">Dokumentasi</p>
                                        <p class="text-xs text-gray-500">{{ count($laporan->file_dokumentasi_array) }}
                                            file</p>
                                    </div>
                                </div>
                                <div class="ml-13 space-y-1">
                                    @foreach ($laporan->file_dokumentasi_array as $file)
                                        <div
                                            class="flex items-center justify-between py-1.5 px-2 bg-white dark:bg-gray-800 rounded text-xs">
                                            <span class="text-gray-600 truncate">{{ basename($file) }}</span>
                                            <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 ml-2">
                                                Lihat
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- File Data Pendukung -->
                        @if (!empty($laporan->file_data_pendukung_array))
                            <div
                                class="p-3 bg-green-50 dark:bg-green-900/10 rounded-lg border border-green-200 dark:border-green-800">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-gray-600">Data Pendukung</p>
                                        <p class="text-xs text-gray-500">
                                            {{ count($laporan->file_data_pendukung_array) }} file</p>
                                    </div>
                                </div>
                                <div class="ml-13 space-y-1">
                                    @foreach ($laporan->file_data_pendukung_array as $file)
                                        <div
                                            class="flex items-center justify-between py-1.5 px-2 bg-white dark:bg-gray-800 rounded text-xs">
                                            <span class="text-gray-600 truncate">{{ basename($file) }}</span>
                                            <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 ml-2">
                                                Download
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- File SK -->
                        @if ($laporan->file_sk)
                            <div
                                class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/10 rounded-lg border border-purple-200 dark:border-purple-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-gray-600">Surat Keputusan</p>
                                        <p class="text-xs text-gray-500">{{ basename($laporan->file_sk) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $laporan->file_sk) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endif

                        <!-- File Pemaparan -->
                        @if ($laporan->file_pemaparan)
                            <div
                                class="flex items-center justify-between p-3 bg-orange-50 dark:bg-orange-900/10 rounded-lg border border-orange-200 dark:border-orange-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-gray-600">Presentasi/Pemaparan</p>
                                        <p class="text-xs text-gray-500">{{ basename($laporan->file_pemaparan) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $laporan->file_pemaparan) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endif

                        <!-- File Pendukung Lainnya -->
                        @if ($laporan->file_pendukung)
                            <div
                                class="flex items-center justify-between p-3 bg-indigo-50 dark:bg-indigo-900/10 rounded-lg border border-indigo-200 dark:border-indigo-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-gray-600">File Pendukung</p>
                                        <p class="text-xs text-gray-500">{{ basename($laporan->file_pendukung) }}</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($laporan->file_pendukung) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    Download
                                </a>
                            </div>
                        @endif

                        @if (
                            !$laporan->file_laporan &&
                                empty($laporan->file_dokumentasi_array) &&
                                empty($laporan->file_data_pendukung_array) &&
                                !$laporan->file_sk &&
                                !$laporan->file_pemaparan &&
                                !$laporan->file_pendukung)
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="text-gray-500">Tidak ada file lampiran</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Status Laporan</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Status Saat Ini</label>
                            <div class="mt-2">
                                @if ($laporan->status == 'menunggu verifikasi')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($laporan->status == 'diterima')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Diterima
                                    </span>
                                @elseif($laporan->status == 'revisi')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                                        Perlu Revisi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Publish Status -->
                        <div class="mt-4">
                            <label class="text-sm font-semibold text-gray-600">Status Publikasi</label>
                            <div class="mt-2">
                                @if ($laporan->is_published)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Dipublikasikan
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                        Tidak Dipublikasikan
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Tanggal
                                Dibuat</label>
                            <p class="text-gray-700 dark:text-gray-300 mt-1">
                                {{ $laporan->created_at->format('d M Y H:i') }}</p>
                        </div>

                        @if ($laporan->tanggal_verifikasi)
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Tanggal
                                    Verifikasi</label>
                                <p class="text-gray-700 dark:text-gray-300 mt-1">
                                    {{ $laporan->tanggal_verifikasi->format('d M Y H:i') }}</p>
                            </div>
                        @endif

                        @if ($laporan->verifiedBy)
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Diverifikasi
                                    Oleh</label>
                                <p class="text-gray-700 dark:text-gray-300 mt-1">{{ $laporan->verifiedBy->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Catatan Admin -->
            @if ($laporan->catatan_admin)
                <div class="card mb-4">
                    <div class="card-header bg-warning-500/10">
                        <h5 class="text-lg font-semibold mb-0">Catatan Admin</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $laporan->catatan_admin }}</p>
                        </div>
                        @if ($laporan->tanggal_verifikasi)
                            <p class="text-xs text-gray-500 mt-3">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $laporan->tanggal_verifikasi->format('d M Y H:i') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-2">
                        @if ($laporan->status == 'menunggu verifikasi')
                            <a href="{{ route('reports.admin.verifikasi', Crypt::encrypt($laporan->id)) }}"
                                class="btn btn-warning w-full flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Verifikasi Laporan
                            </a>
                        @endif

                        <!-- Publish/Unpublish Button -->
                        <form action="{{ route('reports.admin.togglePublish', Crypt::encrypt($laporan->id)) }}"
                            method="POST">
                            @csrf
                            @if ($laporan->is_published)
                                <button type="submit"
                                    class="btn btn-outline-danger w-full flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                        </path>
                                    </svg>
                                    Sembunyikan dari Frontend
                                </button>
                            @else
                                <button type="submit"
                                    class="btn btn-outline-success w-full flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                    Publikasikan ke Frontend
                                </button>
                            @endif
                        </form>

                        <a href="{{ route('reports.admin.edit', Crypt::encrypt($laporan->id)) }}"
                            class="btn btn-outline-primary w-full flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Laporan
                        </a>

                        <a href="{{ route('laporan.export.pdf', Crypt::encrypt($laporan->id)) }}" target="_blank"
                            class="btn btn-outline-danger w-full flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export PDF
                        </a>

                        <a href="{{ route('laporan.export.word', Crypt::encrypt($laporan->id)) }}"
                            class="btn btn-outline-info w-full flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export Word
                        </a>

                        <a href="{{ route('reports.admin.index') }}"
                            class="btn btn-outline-secondary w-full flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Timeline -->
            <div class="card">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <!-- Dibuat -->
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Laporan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $laporan->created_at->format('d M Y H:i') }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Oleh
                                    {{ $laporan->user->name }}</p>
                            </div>
                        </div>

                        @if ($laporan->tanggal_verifikasi)
                            <!-- Diverifikasi -->
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Diverifikasi</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $laporan->tanggal_verifikasi->format('d M Y H:i') }}</p>
                                    @if ($laporan->verifiedBy)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Oleh
                                            {{ $laporan->verifiedBy->name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($laporan->updated_at->ne($laporan->created_at))
                            <!-- Terakhir Diupdate -->
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Terakhir Diupdate
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $laporan->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
