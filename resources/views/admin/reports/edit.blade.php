<x-app>
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-700 dark:text-gray-500">
                            Verifikasi Laporan Akhir
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.admin.index') }}">Laporan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Verifikasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Detail Laporan -->
            <div class="card mb-4">
                <div class="card-header bg-primary-500/10">
                    <h5 class="text-lg font-semibold mb-0">Detail Laporan</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Judul Kegiatan</label>
                            <p class="text-gray-800 dark:text-gray-500">{{ $laporan->judul_kegiatan }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Jenis Kegiatan</label>
                                <p class="text-gray-700 dark:text-gray-500 capitalize">
                                    {{ $laporan->jenis_kegiatan_label }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Tahun</label>
                                <p class="text-gray-700 dark:text-gray-500">{{ $laporan->tahun_pelaksanaan }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Penanggung Jawab</label>
                                <p class="text-gray-700 dark:text-gray-500">{{ $laporan->penanggung_jawab }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">OPD</label>
                                <p class="text-gray-700 dark:text-gray-500">{{ $laporan->user->name }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Periode Pelaksanaan</label>
                            <p class="text-gray-700 dark:text-gray-500">
                                {{ $laporan->tanggal_mulai->format('d M Y') }} -
                                {{ $laporan->tanggal_selesai->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Anggaran</label>
                            <p class="text-gray-700 dark:text-gray-500">Rp
                                {{ number_format($laporan->anggaran, 0, ',', '.') }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Latar Belakang</label>
                            <p class="text-gray-700 dark:text-gray-500 text-sm">{{ $laporan->latar_belakang }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Tujuan Kegiatan</label>
                            <p class="text-gray-700 dark:text-gray-500 text-sm">{{ $laporan->tujuan_kegiatan }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Hasil Kegiatan</label>
                            <p class="text-gray-700 dark:text-gray-500 text-sm">{{ $laporan->hasil_kegiatan }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Realisasi</label>
                            <div class="flex items-center gap-3">
                                <div class="flex-1 bg-gray-200 rounded-full h-3">
                                    <div class="bg-green-500 h-3 rounded-full"
                                        style="width: {{ $laporan->persentase_realisasi }}%"></div>
                                </div>
                                <span class="font-semibold">{{ $laporan->persentase_realisasi }}%</span>
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
                                        <p class="font-semibold text-sm text-gray-700 dark:text-gray-500">Laporan PDF
                                        </p>
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
                                        <p class="font-semibold text-sm text-gray-700 dark:text-gray-500">Dokumentasi
                                        </p>
                                        <p class="text-xs text-gray-700 dark:text-gray-500">
                                            {{ count($laporan->file_dokumentasi_array) }} file</p>
                                    </div>
                                </div>
                                <div class="ml-13 space-y-1">
                                    @foreach ($laporan->file_dokumentasi_array as $file)
                                        <div
                                            class="flex items-center justify-between py-1.5 px-2 bg-white dark:bg-gray-800 rounded text-xs">
                                            <span
                                                class="text-gray-700 dark:text-gray-500 truncate">{{ basename($file) }}</span>
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
                                        <p class="font-semibold text-sm text-gray-700 dark:text-gray-500">Data
                                            Pendukung</p>
                                        <p class="text-xs text-gray-500">
                                            {{ count($laporan->file_data_pendukung_array) }} file</p>
                                    </div>
                                </div>
                                <div class="ml-13 space-y-1">
                                    @foreach ($laporan->file_data_pendukung_array as $file)
                                        <div
                                            class="flex items-center justify-between py-1.5 px-2 bg-white dark:bg-gray-800 rounded text-xs">
                                            <span
                                                class="text-gray-700 dark:text-gray-500 truncate">{{ basename($file) }}</span>
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
                                        <p class="font-semibold text-sm text-gray-700 dark:text-gray-500">Surat
                                            Keputusan</p>
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
                                        <p class="font-semibold text-sm text-gray-700 dark:text-gray-500">
                                            Presentasi/Pemaparan</p>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Form Verifikasi -->
            <div class="card">
                <div class="card-header bg-warning-500/10">
                    <h5 class="text-lg font-semibold mb-0">Form Verifikasi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.admin.updateStatus', Crypt::encrypt($laporan->id)) }}"
                        method="POST">
                        @csrf

                        <!-- Status Saat Ini -->
                        <div class="mb-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <label class="text-sm font-semibold text-gray-600">Status Saat Ini</label>
                            <p class="mt-1">
                                @if ($laporan->status == 'menunggu verifikasi')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($laporan->status == 'diterima')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Diterima
                                    </span>
                                @elseif($laporan->status == 'revisi')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                                        Perlu Revisi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </p>
                        </div>

                        <!-- Pilih Status Baru -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Ubah Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="diterima">Terima Laporan</option>
                                <option value="revisi">Minta Revisi</option>
                                <option value="ditolak">Tolak Laporan</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catatan Admin -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Catatan untuk OPD <span class="text-red-500">*</span>
                            </label>
                            <textarea name="catatan_admin" class="form-control" rows="6"
                                placeholder="Berikan catatan, saran, atau alasan keputusan Anda..." required>{{ old('catatan_admin', $laporan->catatan_admin) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Minimal 10 karakter</p>
                            @error('catatan_admin')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alert Info -->
                        <div class="alert alert-info mb-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm">
                                    OPD akan menerima notifikasi setelah Anda submit keputusan ini.
                                </p>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('reports.admin.index') }}" class="btn btn-outline-secondary flex-1">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary flex-1">
                                Submit Verifikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- History Verifikasi (jika ada) -->
            @if ($laporan->catatan_admin)
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="font-semibold mb-0">Catatan Sebelumnya</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $laporan->catatan_admin }}</p>
                        @if ($laporan->tanggal_verifikasi)
                            <p class="text-xs text-gray-500 mt-2">
                                {{ $laporan->tanggal_verifikasi->format('d M Y H:i') }}
                                @if ($laporan->verifiedBy)
                                    oleh {{ $laporan->verifiedBy->name }}
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app>
