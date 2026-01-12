<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800">
                            Draf Laporan Akhir
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Draf Laporan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Alert Success -->
    @if (session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-800 border-l-4 border-green-600 rounded">
            {{ session('success') }}
        </div>
    @endif
 
    @if (session('error'))
        <div class="p-3 mb-4 bg-red-100 text-red-800 border-l-4 border-red-600 rounded">
            {{ session('error') }}
        </div>
    @endif
 
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-800 mb-1">
                                Daftar Draf Laporan & Arsip
                            </h5>
                            <p class="text-sm text-gray-500">
                                Total: <span class="font-semibold text-primary-500">{{ count($drafts) }} Item</span>
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <!-- Search -->
                            <div class="relative">
                                <input type="text" class="form-control h-10 pl-10 pr-4 w-full md:w-64 text-sm"
                                    placeholder="Cari draf..." id="searchDraft" />
                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
 
                            <!-- Back to Reports -->
                            <a href="{{ route('apps.reports.index') }}"
                                class="btn btn-outline-secondary h-10 px-4 flex items-center text-sm rounded-lg">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Laporan
                            </a>
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
                                        Tahun
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Update
                                    </th>
                                    <th class="py-4 px-6 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($drafts as $draft)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-6">
                                            <input type="checkbox" class="form-check-input" />
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-lg 
                                                        @if($draft->status == 'draft') bg-gray-500 
                                                        @elseif($draft->status == 'diterima') bg-green-500
                                                        @elseif($draft->status == 'ditolak') bg-red-500
                                                        @endif 
                                                        flex items-center justify-center text-white">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-semibold text-gray-800 capitalize">
                                                        {{ str($draft->judul_kegiatan)->limit(30) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ ucfirst($draft->jenis_kegiatan) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 font-medium">
                                                {{ $draft->penanggung_jawab }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700 font-medium">
                                                {{ $draft->tahun_pelaksanaan }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($draft->status == 'draft')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span>
                                                    Draft
                                                </span>
                                            @elseif ($draft->status == 'diterima')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                                    Diterima
                                                </span>
                                            @elseif ($draft->status == 'ditolak')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-gray-700">
                                                {{ $draft->updated_at->format('d M Y H:i') }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Detail -->
                                                <a href="{{ route('apps.reports.show', Crypt::encrypt($draft->id)) }}"
                                                    class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 rounded-lg transition-colors"
                                                    title="Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
 
                                                <!-- Edit (jika masih draft) -->
                                                @if($draft->status == 'draft')
                                                    <a href="{{ route('apps.reports.edit', Crypt::encrypt($draft->id)) }}"
                                                        class="text-orange-600 hover:text-orange-800 p-1.5 hover:bg-orange-50 rounded-lg transition-colors"
                                                        title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
 
                                                <!-- Export PDF (hanya jika diterima) -->
                                                @if($draft->status == 'diterima')
                                                    <a href="{{ route('apps.reports.export.pdf', Crypt::encrypt($draft->id)) }}"
                                                        class="text-red-600 hover:text-red-800 p-1.5 hover:bg-red-50 rounded-lg transition-colors"
                                                        title="Export PDF">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
 
                                                <!-- Export Word (hanya jika diterima) -->
                                                @if($draft->status == 'diterima')
                                                    <a href="{{ route('apps.reports.export.word', Crypt::encrypt($draft->id)) }}"
                                                        class="text-blue-700 hover:text-blue-900 p-1.5 hover:bg-blue-50 rounded-lg transition-colors"
                                                        title="Export Word">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
 
                                                <!-- Download File Laporan -->
                                                @if($draft->file_laporan)
                                                    <a href="{{ asset('storage/' . $draft->file_laporan) }}" target="_blank"
                                                        class="text-green-600 hover:text-green-800 p-1.5 hover:bg-green-50 rounded-lg transition-colors"
                                                        title="Download File">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
 
                                                <!-- Delete -->
                                                <form action="{{ route('apps.reports.destroy', Crypt::encrypt($draft->id)) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 p-1.5 hover:bg-red-50 rounded-lg transition-colors"
                                                        title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                        <td colspan="7" class="py-12 px-6 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">Belum ada draf laporan</p>
                                                <p class="text-gray-400 text-sm mt-1">Draf dan arsip laporan akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </x-app>