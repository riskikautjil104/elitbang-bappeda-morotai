<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800">
                            Manajemen Laporan Akhir
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Laporan Akhir Kegiatan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header with Actions -->
                <div class="card-header border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-800 mb-1">
                                Daftar Laporan Akhir Kegiatan E-Litbang
                            </h5>
                            <p class="text-sm text-gray-500">
                                Total: <span class="font-semibold text-primary-500" id="totalLaporan">{{ count($laporans) }} Laporan</span>
                            </p>
                        </div>
                        <div class="flex flex-between gap-2">
                            <!-- Search -->
                            <div class="relative">
                                <input type="text" class="form-control h-10 pl-10 pr-4 w-full md:w-64 text-sm"
                                    placeholder="Cari laporan..." id="searchLaporan" />
                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <div class="flex gap-2 items-center">
                                <!-- Filter Button -->
                                <button class="btn btn-outline-secondary flex items-center h-10 px-4 text-sm rounded-lg">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                        </path>
                                    </svg>
                                    Filter
                                </button>

                                <!-- Add Report Button -->
                                <a href="{{ route('apps.reports.create') }}"
                                    class="btn btn-primary h-10 px-4 flex items-center text-sm rounded-lg font-semibold">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Laporan Akhir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <!-- Desktop Table View -->
                    <div class="md:block overflow-x-auto">
                        <table class="table table-hover mb-0">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-4 px-6 text-left">
                                        <input type="checkbox" class="form-check-input" id="selectAll" />
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Judul Kegiatan
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Peneliti
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        OPD
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tahun
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Upload
                                    </th>
                                    <th class="py-4 px-6 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" id="laporanTableBody">
                                @forelse ($laporans as $laporan)
                                    <tr class="hover:bg-gray-50 transition-colors laporan-row" 
                                        data-judul="{{ strtolower($laporan->judul_kegiatan) }}"
                                        data-peneliti="{{ strtolower($laporan->penanggung_jawab) }}"
                                        data-opd="{{ strtolower($laporan->user->name) }}"
                                        data-tahun="{{ $laporan->tahun_pelaksanaan }}"
                                        data-status="{{ strtolower($laporan->status) }}">
                                        <td class="py-4 px-6">
                                            <input type="checkbox" class="form-check-input" />
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-lg bg-blue-500 flex items-center justify-center text-white">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-semibold text-gray-800 capitalize">
                                                        {{ str($laporan->judul_kegiatan)->limit(30) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ ucfirst($laporan->jenis_kegiatan) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 font-medium">
                                                {{ $laporan->penanggung_jawab }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700">
                                                {{ $laporan->user->name }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 font-medium">
                                                {{ $laporan->tahun_pelaksanaan }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($laporan->status == 'diterima')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                                    Diterima
                                                </span>
                                            @elseif ($laporan->status == 'menunggu verifikasi')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                                    Menunggu Verifikasi
                                                </span>
                                            @elseif ($laporan->status == 'revisi')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1.5"></span>
                                                    Perlu Revisi
                                                </span>
                                            @elseif ($laporan->status == 'ditolak')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700">
                                                {{ date('d M Y H:i', strtotime($laporan->updated_at)) }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Download -->
                                                <a href="{{ asset('storage/' . $laporan->file_laporan) }}" target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 rounded-lg transition-colors"
                                                    title="Download">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                
                                                <!-- Detail -->
                                                <a href="{{ route('apps.reports.show', Crypt::encrypt($laporan->id)) }}"
                                                    class="text-green-600 hover:text-green-800 p-1.5 hover:bg-green-50 rounded-lg transition-colors"
                                                    title="Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                
                                                <!-- Edit (hanya untuk status revisi) -->
                                                @if($laporan->status == 'revisi')
                                                    <a href="{{ route('apps.reports.edit', Crypt::encrypt($laporan->id)) }}"
                                                        class="text-orange-600 hover:text-orange-800 p-1.5 hover:bg-orange-50 rounded-lg transition-colors"
                                                        title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
                                                
                                                <!-- Move to Draft -->
                                                <form action="{{ route('apps.reports.moveToDraft', Crypt::encrypt($laporan->id)) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-purple-600 hover:text-purple-800 p-1.5 hover:bg-purple-50 rounded-lg transition-colors"
                                                        title="Pindah ke Draf"
                                                        onclick="return confirm('Pindahkan laporan ini ke draf?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="noDataRow">
                                        <td colspan="8" class="py-12 px-6 text-center text-gray-700">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">Belum ada laporan</p>
                                                <p class="text-gray-400 text-sm mt-1">Buat laporan akhir baru untuk memulai</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <!-- No Results Message (hidden by default) -->
                        <div id="noResultsMessage" class="hidden py-12 px-6 text-center text-gray-700">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <p class="text-gray-500 text-lg font-medium">Tidak ada hasil pencarian</p>
                                <p class="text-gray-400 text-sm mt-1">Coba kata kunci lain</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchLaporan');
            const tableBody = document.getElementById('laporanTableBody');
            const totalLaporan = document.getElementById('totalLaporan');
            const noResultsMessage = document.getElementById('noResultsMessage');
            const allRows = document.querySelectorAll('.laporan-row');
            const totalAwal = {{ count($laporans) }};

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let visibleCount = 0;

                allRows.forEach(row => {
                    const judul = row.dataset.judul || '';
                    const peneliti = row.dataset.peneliti || '';
                    const opd = row.dataset.opd || '';
                    const tahun = row.dataset.tahun || '';
                    const status = row.dataset.status || '';

                    // Cek apakah search term cocok dengan salah satu field
                    const isMatch = judul.includes(searchTerm) || 
                                  peneliti.includes(searchTerm) || 
                                  opd.includes(searchTerm) || 
                                  tahun.includes(searchTerm) ||
                                  status.includes(searchTerm);

                    if (isMatch) {
                        row.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                });

                // Update total count
                if (totalAwal > 0) {
                    totalLaporan.textContent = `${visibleCount} Laporan`;
                }

                // Show/hide no results message
                if (visibleCount === 0 && totalAwal > 0) {
                    noResultsMessage.classList.remove('hidden');
                } else {
                    noResultsMessage.classList.add('hidden');
                }
            });

            // Select All Checkbox
            const selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.laporan-row:not(.hidden) .form-check-input');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }
        });
    </script>
</x-app>