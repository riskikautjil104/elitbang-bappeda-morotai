<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Laporan Realisasi Anggaran
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Laporan Realisasi Anggaran</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 md:gap-4 mb-6">
        <!-- Total Anggaran -->
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Anggaran</p>
                            <h4 class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($totalAnggaran, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-blue-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Realisasi -->
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Realisasi</p>
                            <h4 class="text-2xl font-bold text-green-600 dark:text-green-400">
                                Rp {{ number_format($totalRealisasi, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-green-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persentase -->
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">% Realisasi</p>
                            <h4 class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                {{ $totalPersen }}%
                            </h4>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-purple-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-500 dark:text-gray-400 mb-1">
                                Data Laporan Realisasi Anggaran
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Kelola data laporan realisasi anggaran dan dokumentasi kegiatan
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <form method="GET" action="{{ route('admin.laporan-realisasi.index') }}"
                                class="flex flex-wrap gap-2">
                                <!-- Search -->
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control h-10 pl-10 pr-4 w-full md:w-64 text-sm"
                                        placeholder="Cari kegiatan..." />
                                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Filter Bulan -->
                                <select name="bulan" class="form-select h-10 text-sm w-auto"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('bulan') == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create(null, $i)->locale('id')->monthName }}
                                        </option>
                                    @endfor
                                </select>

                                <!-- Filter Tahun -->
                                <select name="tahun" class="form-select h-10 text-sm w-auto"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Tahun</option>
                                    @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                                        <option value="{{ $year }}"
                                            {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>

                                <!-- Search Button -->
                                <button type="submit" class="btn btn-primary h-10 px-4 text-sm rounded-lg">
                                    <svg class="w-4 h-4 mr-1.5 inline" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>

                                <!-- Reset Button -->
                                @if (request('search') || request('bulan') || request('tahun'))
                                    <a href="{{ route('admin.laporan-realisasi.index') }}"
                                        class="btn btn-outline-secondary h-10 px-4 text-sm rounded-lg">
                                        <svg class="w-4 h-4 mr-1.5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </form>

                            <!-- Add Button -->
                            <a href="{{ route('admin.laporan-realisasi.create') }}"
                                class="btn btn-primary flex items-center h-10 px-4 text-sm rounded-lg font-semibold">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <!-- Desktop Table -->
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="table table-hover mb-0">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        No</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Kegiatan</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Anggaran</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Realisasi</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        %</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Tanggal</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        File</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase text-center">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($laporans as $index => $laporan)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                                        <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $laporans->firstItem() + $index }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                                {{ $laporan->nama_kegiatan }}</p>
                                            @if ($laporan->lokasi)
                                                <p class="text-xs text-gray-500">{{ $laporan->lokasi }}</p>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm font-medium text-green-600 dark:text-green-400">
                                                Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="flex-1 bg-gray-200 rounded-full h-2 dark:bg-gray-700 max-w-[60px]">
                                                    <div class="bg-{{ $laporan->persentase_realisasi >= 80 ? 'green' : ($laporan->persentase_realisasi >= 50 ? 'yellow' : 'red') }}-500 h-2 rounded-full"
                                                        style="width: {{ min($laporan->persentase_realisasi, 100) }}%">
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-xs font-semibold">{{ $laporan->persentase_realisasi }}%</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $laporan->tanggal_kegiatan ? \Carbon\Carbon::parse($laporan->tanggal_kegiatan)->format('d/m/Y') : '-' }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            @php
                                                $files = json_decode($laporan->file_pendukung ?? '[]', true);
                                            @endphp
                                            @if (count($files) > 0)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                    {{ count($files) }}
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <!-- View -->
                                                <a href="{{ route('admin.laporan-realisasi.show', encrypt($laporan->id)) }}"
                                                    class="text-gray-600 hover:bg-gray-50 p-1.5 rounded"
                                                    title="Lihat">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
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

                                                <!-- Edit -->
                                                <a href="{{ route('admin.laporan-realisasi.edit', encrypt($laporan->id)) }}"
                                                    class="text-blue-600 hover:bg-blue-50 p-1.5 rounded"
                                                    title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <!-- Delete -->
                                                <form
                                                    action="{{ route('admin.laporan-realisasi.destroy', encrypt($laporan->id)) }}"
                                                    method="POST" class="inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-red-600 hover:bg-red-50 p-1.5 rounded delete-btn"
                                                        title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-8 px-6 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400">Belum ada data laporan</p>
                                                <a href="{{ route('admin.laporan-realisasi.create') }}"
                                                    class="text-primary-500 hover:underline text-sm mt-2">
                                                    Tambah data pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Card Footer - Pagination -->
                <div class="card-footer border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 py-2">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Menampilkan <span
                                class="font-semibold text-gray-800 dark:text-white">{{ $laporans->firstItem() ?? 0 }}</span>
                            sampai
                            <span
                                class="font-semibold text-gray-800 dark:text-white">{{ $laporans->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-semibold text-gray-800 dark:text-white">{{ $laporans->total() }}</span>
                            data
                        </div>

                        @if ($laporans->hasPages())
                            <nav class="flex items-center gap-2">
                                {{ $laporans->appends(request()->all())->links('pagination::tailwind') }}
                            </nav>
                        @endif
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
