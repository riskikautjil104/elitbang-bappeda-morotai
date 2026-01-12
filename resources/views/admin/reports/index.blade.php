<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-black">
                            Daftar Laporan Akhir Kegiatan
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Laporan Akhir</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 md:gap-2">
        <!-- Total Laporan -->
        <div class="col-md-3 col-sm-6 md:mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Laporan</p>
                            <h4 class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ \App\Models\LaporanAkhir::count() }}
                            </h4>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-primary-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Verifikasi -->
        <div class="col-md-3 col-sm-6 md:mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Menunggu Verifikasi</p>
                            <h4 class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                                {{ \App\Models\LaporanAkhir::whereIn('status', ['diajukan', 'menunggu verifikasi'])->count() }}
                            </h4>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-yellow-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diterima -->
        <div class="col-md-3 col-sm-6 md:mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Diterima</p>
                            <h4 class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ \App\Models\LaporanAkhir::where('status', 'diterima')->where('is_archived', false)->count() }}
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

        <!-- Diarsipkan -->
        <div class="col-md-3 col-sm-6 md:mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Diarsipkan</p>
                            <h4 class="text-2xl font-bold text-gray-600 dark:text-gray-400">
                                {{ \App\Models\LaporanAkhir::where('is_archived', true)->count() }}
                            </h4>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-gray-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Alert Notifikasi -->
    @php
        $notifications = auth()->user()->unreadNotifications;
    @endphp
    @if ($notifications->count() > 0)
        <div class="mb-4 space-y-3">
            @foreach ($notifications as $notif)
                <div class="p-4 border-l-4 border-blue-600 bg-blue-50 text-blue-800 rounded">
                    <div class="flex justify-between items-start items-center">
                        <div>
                            <strong>{{ $notif->data['title'] }}</strong>
                            <span class="text-sm text-gray-500 ml-2">
                                {{ $notif->created_at->diffForHumans() }}
                            </span>

                            <p class="mt-1">{{ $notif->data['message'] }}</p>
                        </div>

                        {{-- Tombol Tandai Dibaca --}}
                        <form action="{{ route('notifications.read', $notif->id) }}" method="POST" class="ml-4">
                            @csrf
                            <button type="submit"
                                class="text-sm px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                ✔ Tandai Dibaca
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Alert Success --}}
    {{-- @if (session('success'))
   <div class="p-3 mb-4 bg-green-100 text-green-800 border-l-4 border-green-600 rounded">
      {{ session('success') }}
   </div>
   @endif --}}



    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header with Tabs -->
                <div class="card-header border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-500 dark:text-gray-400 mb-1">
                                Data Laporan Akhir
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Kelola dan pantau semua laporan akhir kegiatan
                            </p>

                            <!-- Tab Navigation -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <a href="{{ route('reports.admin.index', ['tab' => 'semua']) }}"
                                    class="px-3 py-1.5 text-sm rounded-lg transition-colors {{ $tab == 'semua' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300' }}">
                                    Semua
                                </a>
                                <a href="{{ route('reports.admin.index', ['tab' => 'menunggu']) }}"
                                    class="px-3 py-1.5 text-sm rounded-lg transition-colors {{ $tab == 'menunggu' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300' }}">
                                    Menunggu
                                </a>
                                <a href="{{ route('reports.admin.index', ['tab' => 'diterima']) }}"
                                    class="px-3 py-1.5 text-sm rounded-lg transition-colors {{ $tab == 'diterima' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300' }}">
                                    Diterima
                                </a>
                                <a href="{{ route('reports.admin.index', ['tab' => 'archived']) }}"
                                    class="px-3 py-1.5 text-sm rounded-lg transition-colors {{ $tab == 'archived' ? 'bg-gray-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300' }}">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                        </path>
                                    </svg>
                                    Diarsipkan
                                </a>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <form method="GET" action="{{ route('reports.admin.index') }}"
                                class="flex flex-wrap gap-2">
                                <!-- Hidden tab parameter -->
                                @if (request('tab'))
                                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                                @endif

                                <!-- Search -->
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control h-10 pl-10 pr-4 w-full md:w-64 text-sm"
                                        placeholder="Cari laporan..." />
                                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Filter Year -->
                                <select name="tahun" class="form-select h-10 text-sm w-auto"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Tahun</option>
                                    @foreach ($tahunList as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
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
                                @if (request('search') || request('tahun'))
                                    <a href="{{ route('reports.admin.index', ['tab' => request('tab', 'semua')]) }}"
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

                            <div class="flex gap-2">
                                <!-- Export -->
                                <a href="{{ route('reports.admin.export', request()->all()) }}"
                                    class="btn flex items-center btn-outline-success h-10 px-4 text-sm rounded-lg">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Export
                                </a>

                                <!-- Add -->
                                <a href="{{ route('reports.admin.create') }}"
                                    class="btn btn-primary flex items-center h-10 px-4 text-sm rounded-lg font-semibold">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4">
                                        </path>
                                    </svg>
                                    Tambah
                                </a>
                            </div>
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
                                    <th class="py-4 px-6">
                                        <input type="checkbox" class="form-check-input" id="selectAll" />
                                    </th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Kegiatan</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Jenis</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        OPD</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        PJ</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Periode</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Realisasi</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                        Status</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase text-center">
                                        Arsip</th>
                                    <th
                                        class="py-4 px-6 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase text-center">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($laporans as $laporan)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                                        <td class="py-4 px-6">
                                            <input type="checkbox" class="form-check-input laporan-checkbox"
                                                value="{{ $laporan->id }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                                {{ str($laporan->judul_kegiatan)->limit(30) }}</p>
                                            <p class="text-xs text-gray-500">{{ $laporan->tahun_pelaksanaan }}</p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">{{ $laporan->jenis_kegiatan_label }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 dark:text-gray-600">
                                                {{ $laporan->user->name }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 dark:text-gray-600">
                                                {{ $laporan->penanggung_jawab }}</p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 dark:text-gray-600">
                                                {{ $laporan->tahun_pelaksanaan }}</p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="flex-1 bg-gray-200 rounded-full h-2 dark:bg-gray-700 max-w-[80px]">
                                                    <div class="bg-green-500 h-2 rounded-full"
                                                        style="width: {{ $laporan->persentase_realisasi }}%"></div>
                                                </div>
                                                <span
                                                    class="text-xs font-semibold">{{ $laporan->persentase_realisasi }}%</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($laporan->status == 'menunggu verifikasi')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                                    <span
                                                        class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>Menunggu
                                                </span>
                                            @elseif ($laporan->status == 'diterima')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                    <span
                                                        class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>Diterima
                                                </span>
                                            @elseif ($laporan->status == 'revisi')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                                    <span
                                                        class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1.5"></span>Revisi
                                                </span>
                                            @elseif ($laporan->status == 'ditolak')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                    <span
                                                        class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>Ditolak
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300">
                                                    {{ ucfirst($laporan->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if ($laporan->is_archived)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                                        </path>
                                                    </svg>
                                                    Diarsipkan
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <!-- View -->
                                                <a href="{{ route('reports.admin.show', Crypt::encrypt($laporan->id)) }}"
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
                                                <a href="{{ route('reports.admin.edit', Crypt::encrypt($laporan->id)) }}"
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

                                                <!-- Toggle Archive -->
                                                <form
                                                    action="{{ route('reports.admin.toggleArchive', Crypt::encrypt($laporan->id)) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @if ($laporan->is_archived)
                                                        <button type="submit"
                                                            class="text-orange-600 hover:bg-orange-50 p-1.5 rounded"
                                                            title="Buka Arsip"
                                                            onclick="return confirm('Yakin ingin membuka arsip data ini?')">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <button type="submit"
                                                            class="text-gray-600 hover:bg-gray-100 p-1.5 rounded"
                                                            title="Arsipkan"
                                                            onclick="return confirm('Yakin ingin mengarsipkan data ini?')">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                </form>

                                                <!-- Export PDF -->
                                                <a href="{{ route('laporan.export.pdf', Crypt::encrypt($laporan->id)) }}"
                                                    class="text-red-600 hover:bg-red-50 p-1.5 rounded"
                                                    title="Export PDF" target="_blank">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <!-- Delete -->
                                                <form
                                                    action="{{ route('reports.admin.destroy', Crypt::encrypt($laporan->id)) }}"
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
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7 16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="py-8 px-6 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400">Tidak ada data laporan</p>
                                                @if (isset($tab) && $tab == 'archived')
                                                    <p class="text-sm text-gray-400 mt-1">Tidak ada data yang
                                                        diarsipkan</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="block lg:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Card 1 -->
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                            <div class="flex items-start justify-between mb-3">
                                <input type="checkbox" class="form-check-input mt-1" />
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>Selesai
                                </span>
                            </div>
                            <div>
                                <h6 class="text-base font-semibold text-gray-800 dark:text-white mb-1">
                                    Penelitian Kualitas Air Bersih
                                </h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    ID: LP-2024-001
                                </p>
                                <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Jenis</p>
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Penelitian</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">OPD</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Dinas
                                            Kesehatan</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Penanggung Jawab</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Dr. Ahmad
                                            Fauzi</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Periode</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Jan-Des
                                            2024</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 mb-1.5">Realisasi</p>
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 95%">
                                            </div>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">95%</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 text-blue-600 py-2 px-3 text-sm font-medium bg-blue-50 hover:bg-blue-100 rounded-lg">Detail</button>
                                    <button
                                        class="flex-1 text-green-600 py-2 px-3 text-sm font-medium bg-green-50 hover:bg-green-100 rounded-lg">Download</button>
                                    <button
                                        class="flex-1 text-orange-600 py-2 px-3 text-sm font-medium bg-orange-50 hover:bg-orange-100 rounded-lg">Edit</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                            <div class="flex items-start justify-between mb-3">
                                <input type="checkbox" class="form-check-input mt-1" />
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                    <span
                                        class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 animate-pulse"></span>Review
                                </span>
                            </div>
                            <div>
                                <h6 class="text-base font-semibold text-gray-800 dark:text-white mb-1">
                                    Kajian Ekonomi Kreatif
                                </h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    ID: LP-2024-002
                                </p>
                                <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Jenis</p>
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Kajian</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">OPD</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Bappeda
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Penanggung Jawab</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Siti
                                            Rahmawati</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Periode</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Mar-Nov
                                            2024</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 mb-1.5">Realisasi</p>
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 68%">
                                            </div>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">68%</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 text-blue-600 py-2 px-3 text-sm font-medium bg-blue-50 hover:bg-blue-100 rounded-lg">Detail</button>
                                    <button
                                        class="flex-1 text-green-600 py-2 px-3 text-sm font-medium bg-green-50 hover:bg-green-100 rounded-lg">Download</button>
                                    <button
                                        class="flex-1 text-orange-600 py-2 px-3 text-sm font-medium bg-orange-50 hover:bg-orange-100 rounded-lg">Edit</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                            <div class="flex items-start justify-between mb-3">
                                <input type="checkbox" class="form-check-input mt-1" />
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>Selesai
                                </span>
                            </div>
                            <div>
                                <h6 class="text-base font-semibold text-gray-800 dark:text-white mb-1">
                                    Pengembangan Sistem Informasi Desa
                                </h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    ID: LP-2024-003
                                </p>
                                <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Jenis</p>
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Pengembangan</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">OPD</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Dinas
                                            Kominfo</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Penanggung Jawab</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Ir. Budi
                                            Santoso</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-0.5">Periode</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Feb-Okt
                                            2024</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 mb-1.5">Realisasi</p>
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 100%">
                                            </div>
                                        </div>
                                        <span
                                            class="text-sm font-semibold text-gray-700 dark:text-gray-300">100%</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 text-blue-600 py-2 px-3 text-sm font-medium bg-blue-50 hover:bg-blue-100 rounded-lg">Detail</button>
                                    <button
                                        class="flex-1 text-green-600 py-2 px-3 text-sm font-medium bg-green-50 hover:bg-green-100 rounded-lg">Download</button>
                                    <button
                                        class="flex-1 text-orange-600 py-2 px-3 text-sm font-medium bg-orange-50 hover:bg-orange-100 rounded-lg">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer - Pagination -->
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
                            laporan
                        </div>

                        @if ($laporans->hasPages())
                            <nav class="flex items-center gap-2">
                                {{-- Previous Button --}}
                                @if ($laporans->onFirstPage())
                                    <span
                                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-800 dark:border-gray-600">
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $laporans->previousPageUrl() }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                                        Previous
                                    </a>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($laporans->getUrlRange(1, $laporans->lastPage()) as $page => $url)
                                    @if ($page == $laporans->currentPage())
                                        <span
                                            class="px-3 py-2 text-sm font-medium text-white bg-primary-500 border border-primary-500 rounded-lg">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Button --}}
                                @if ($laporans->hasMorePages())
                                    <a href="{{ $laporans->nextPageUrl() }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                                        Next
                                    </a>
                                @else
                                    <span
                                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-800 dark:border-gray-600">
                                        Next
                                    </span>
                                @endif
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
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
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'px-4 py-2 rounded-lg font-medium',
                        cancelButton: 'px-4 py-2 rounded-lg font-medium'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // SweetAlert untuk notifikasi success/error
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('
                         success ') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'colored-toast'
                }
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

    <style>
        .colored-toast.swal2-icon-success {
            background-color: #10b981 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #ef4444 !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
</x-app>
