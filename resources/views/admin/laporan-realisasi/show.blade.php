<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Detail Laporan Realisasi Anggaran
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.laporan-realisasi.index') }}">Laporan
                                Realisasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-500 dark:text-gray-400">
                                Detail Laporan Realisasi Anggaran
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $laporan->nama_kegiatan }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.laporan-realisasi.edit', encrypt($laporan->id)) }}"
                                class="btn btn-primary flex items-center h-10 px-4 text-sm rounded-lg">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('admin.laporan-realisasi.index') }}"
                                class="btn btn-outline-secondary flex items-center h-10 px-4 text-sm rounded-lg">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Stats Summary -->
                    <div class="grid md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Anggaran</p>
                            <p class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Realisasi</p>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400">
                                Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">% Realisasi</p>
                            <p class="text-xl font-bold text-purple-600 dark:text-purple-400">
                                {{ $laporan->persentase_realisasi }}%
                            </p>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                <div class="bg-purple-500 h-2 rounded-full"
                                    style="width: {{ min($laporan->persentase_realisasi, 100) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Information -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <h6 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">
                                Informasi Kegiatan
                            </h6>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nama Kegiatan</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">
                                        {{ $laporan->nama_kegiatan }}</p>
                                </div>

                                @if ($laporan->tanggal_kegiatan)
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal Kegiatan</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">
                                            {{ \Carbon\Carbon::parse($laporan->tanggal_kegiatan)->format('d F Y') }}
                                        </p>
                                    </div>
                                @endif

                                @if ($laporan->lokasi)
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">
                                            {{ $laporan->lokasi }}</p>
                                    </div>
                                @endif

                                @if ($laporan->deskripsi)
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Deskripsi</p>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $laporan->deskripsi }}
                                        </p>
                                    </div>
                                @endif

                                @if ($laporan->keterangan)
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Keterangan</p>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $laporan->keterangan }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Column - Files -->
                        <div>
                            <h6 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">
                                File Pendukung
                            </h6>

                            @php
                                $files = json_decode($laporan->file_pendukung ?? '[]', true);
                            @endphp

                            @if (count($files) > 0)
                                <div class="space-y-2">
                                    @foreach ($files as $file)
                                        <div
                                            class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                @endphp

                                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <div
                                                        class="w-10 h-10 rounded bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @elseif(in_array($ext, ['mp4', 'mov', 'avi']))
                                                    <div
                                                        class="w-10 h-10 rounded bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-10 h-10 rounded bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif

                                                <div>
                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        {{ basename($file) }}</p>
                                                    @php
                                                        $filePath = public_path('storage/' . $file);
                                                        $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                                                    @endphp
                                                    <p class="text-xs text-gray-500">
                                                        {{ number_format($fileSize / 1024, 0) }} KB |
                                                        {{ strtoupper($ext) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex gap-2">
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="text-blue-500 hover:text-blue-700 p-1" title="Download">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                        </path>
                                                    </svg>
                                                </a>
                                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'mp4']))
                                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                        class="text-green-500 hover:text-green-700 p-1"
                                                        title="Preview">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-sm">Tidak ada file pendukung</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-wrap gap-4 text-xs text-gray-500 dark:text-gray-400">
                            <div>
                                <span>Created:</span>
                                <span class="font-medium">{{ $laporan->created_at->format('d F Y H:i') }}</span>
                            </div>
                            @if ($laporan->updated_at != $laporan->created_at)
                                <div>
                                    <span>Updated:</span>
                                    <span class="font-medium">{{ $laporan->updated_at->format('d F Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Footer - Delete Button -->
                <div class="card-footer border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    <div class="flex justify-between items-center">
                        <form action="{{ route('admin.laporan-realisasi.destroy', encrypt($laporan->id)) }}"
                            method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger flex items-center px-4 py-2 delete-btn">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Data
                            </button>
                        </form>

                        <a href="{{ route('admin.laporan-realisasi.index') }}"
                            class="btn btn-outline-secondary flex items-center px-4 py-2">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert untuk konfirmasi hapus
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // SweetAlert untuk notifikasi
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('
                         success ') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('
                         error ') }}',
                showConfirmButton: true,
                confirmButtonColor: '#dc2626'
            });
        @endif
    </script>
</x-app>
