<x-app>
    <div class="grid grid-cols-12 gap-6">
        
        {{-- 🎯 RANKING & PERFORMANCE SCORE --}}
        <div class="col-span-12">
            <div class="card bg-gradient-to-r from-primary-500 to-primary-600 text-white">
                <div class="card-body">
                    <h2>Selamat Datang</h2>
                    <span style="color: black">OPD {{ Auth::user()->name }} 🖖</span>
                </div>
            </div>
        </div>
 
        {{-- 🔔 NOTIFICATIONS --}}
        @if($laporanPerluRevisi > 0 || $laporanMenungguLama > 0)
        <div class="col-span-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($laporanPerluRevisi > 0)
                <div class="p-4 bg-warning-50 border-l-4 border-warning-500 rounded-lg">
                    <div class="flex items-center gap-3">
                        <i class="ti ti-edit text-2xl text-warning-500"></i>
                        <div class="flex-1">
                            <h6 class="mb-0 text-warning-700">{{ $laporanPerluRevisi }} Laporan Perlu Direvisi</h6>
                            <p class="text-sm text-warning-600 mb-0">Segera perbaiki dan submit kembali</p>
                        </div>
                        <a href="{{ route('apps.reports.drafts') }}" class="btn btn-sm btn-warning">
                            Lihat <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endif
                
                @if($laporanMenungguLama > 0)
                <div class="p-4 bg-info-50 border-l-4 border-info-500 rounded-lg">
                    <div class="flex items-center gap-3">
                        <i class="ti ti-clock-pause text-2xl text-info-500"></i>
                        <div class="flex-1">
                            <h6 class="mb-0 text-info-700">{{ $laporanMenungguLama }} Laporan Menunggu > 7 Hari</h6>
                            <p class="text-sm text-info-600 mb-0">Dalam proses verifikasi admin</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
 
        {{-- STATS CARDS --}}
        <div class="col-span-12 md:col-span-6 xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-primary-500/10">
                            <i class="ti ti-file-text text-2xl text-primary-500"></i>
                        </div>
                        <div>
                            <p class="text-sm text-muted mb-0">Total Laporan</p>
                            <h4 class="mb-0">{{ $totalLaporan }}</h4>
                        </div>
                    </div>
                    <div id="total-laporan-graph"></div>
                </div>
            </div>
        </div>
 
        <div class="col-span-12 md:col-span-6 xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-warning-500/10">
                            <i class="ti ti-clock text-2xl text-warning-500"></i>
                        </div>
                        <div>
                            <p class="text-sm text-muted mb-0">Pending</p>
                            <h4 class="mb-0">{{ $laporanDiajukan }}</h4>
                        </div>
                    </div>
                    <div id="pending-graph"></div>
                </div>
            </div>
        </div>
 
        <div class="col-span-12 md:col-span-6 xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-success-500/10">
                            <i class="ti ti-circle-check text-2xl text-success-500"></i>
                        </div>
                        <div>
                            <p class="text-sm text-muted mb-0">Disetujui</p>
                            <h4 class="mb-0">{{ $laporanDisetujui }}</h4>
                        </div>
                    </div>
                    <div id="approved-graph"></div>
                </div>
            </div>
        </div>
 
        <div class="col-span-12 md:col-span-6 xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-danger-500/10">
                            <i class="ti ti-alert-circle text-2xl text-danger-500"></i>
                        </div>
                        <div>
                            <p class="text-sm text-muted mb-0">Direvisi</p>
                            <h4 class="mb-0">{{ $laporanDirevisi }}</h4>
                        </div>
                    </div>
                    <div id="revision-graph"></div>
                </div>
            </div>
        </div>
 
        {{-- ANGGARAN STATS --}}
        <div class="col-span-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="card border-l-4 border-primary-500">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-primary-500/10">
                                <i class="ti ti-coin text-2xl text-primary-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-1">Total Anggaran</p>
                                <h5 class="mb-0">{{ $totalAnggaranFormatted }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border-l-4 border-success-500">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-success-500/10">
                                <i class="ti ti-wallet text-2xl text-success-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-1">Total Realisasi</p>
                                <h5 class="mb-0">{{ $totalRealisasiFormatted }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border-l-4 border-warning-500">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-warning-500/10">
                                <i class="ti ti-chart-bar text-2xl text-warning-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-1">Rata² Realisasi</p>
                                <h5 class="mb-0">{{ number_format($rataRealisasi, 1) }}%</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border-l-4 border-info-500">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-info-500/10">
                                <i class="ti ti-category text-2xl text-info-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-1">Jenis Kegiatan</p>
                                <h5 class="mb-0">{{ $totalJenisKegiatan }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        {{-- TREND BULANAN --}}
        <div class="col-span-12 xl:col-span-8">
            <div class="card h-full">
                <div class="card-header flex items-center justify-between">
                    <h5 class="mb-0">📊 Trend Laporan Bulanan {{ date('Y') }}</h5>
                    <span class="badge bg-{{ $growthPercentage >= 0 ? 'success' : 'danger' }}">
                        {{ $growthPercentage >= 0 ? '+' : '' }}{{ $growthPercentage }}%
                    </span>
                </div>
                <div class="card-body">
                    <div id="trend-bulanan-chart"></div>
                </div>
            </div>
        </div>
 
        {{-- DISTRIBUSI REALISASI --}}
        <div class="col-span-12 xl:col-span-4">
            <div class="card h-full">
                <div class="card-header">
                    <h5 class="mb-0">🎯 Distribusi Realisasi</h5>
                </div>
                <div class="card-body">
                    <div id="realisasi-donut-chart"></div>
                    <div class="space-y-2 mt-4">
                        @foreach($distribusiRealisasi as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm">{{ $item->kategori }}</span>
                            <span class="badge bg-primary">{{ $item->total }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
 
        {{-- PERFORMA METRICS --}}
        <div class="col-span-12 lg:col-span-6">
            <div class="card h-full">
                <div class="card-header">
                    <h5 class="mb-0">📈 Analisis Performa</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium">Tingkat Keberhasilan</span>
                                <span class="text-sm font-bold text-success-500">{{ number_format($tingkatKeberhasilan, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-success-500 h-3 rounded-full transition-all" style="width: {{ $tingkatKeberhasilan }}%"></div>
                            </div>
                        </div>
 
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium">Tingkat Revisi</span>
                                <span class="text-sm font-bold text-danger-500">{{ number_format($tingkatRevisi, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-danger-500 h-3 rounded-full transition-all" style="width: {{ $tingkatRevisi }}%"></div>
                            </div>
                        </div>
 
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium">Rata² Realisasi</span>
                                <span class="text-sm font-bold text-primary-500">{{ number_format($rataRealisasi, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-primary-500 h-3 rounded-full transition-all" style="width: {{ $rataRealisasi }}%"></div>
                            </div>
                        </div>
 
                        <div class="pt-4 border-t">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-muted mb-0">Rata² Waktu Verifikasi</p>
                                    <h4 class="mb-0">{{ number_format($avgWaktuVerifikasi, 1) }} Hari</h4>
                                </div>
                                <i class="ti ti-clock text-4xl text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        {{-- TOP JENIS KEGIATAN --}}
        <div class="col-span-12 lg:col-span-6">
            <div class="card h-full">
                <div class="card-header">
                    <h5 class="mb-0">🏆 Top Jenis Kegiatan</h5>
                </div>
                <div class="card-body">
                    <div class="space-y-3">
                        @forelse($topJenisKegiatan as $index => $item)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold
                                {{ $index === 0 ? 'bg-warning text-white' : 'bg-primary-100 text-primary-600' }}">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h6 class="mb-1 truncate">{{ $item->jenis_kegiatan }}</h6>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all" 
                                         style="width: {{ ($item->total / $totalLaporan) * 100 }}%"></div>
                                </div>
                            </div>
                            <span class="badge bg-primary">{{ $item->total }}</span>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <i class="ti ti-trophy-off" style="font-size: 48px; opacity: 0.2;"></i>
                            <p class="text-muted mb-0 mt-2">Belum ada data kegiatan</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
 
        {{-- LAPORAN TERBARU --}}
        <div class="col-span-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <ul class="flex gap-4 nav-tabs">
                            <li class="group active">
                                <a href="javascript:void(0);" data-pc-toggle="tab" data-pc-target="tab-all"
                                   class="pb-3 border-b-2 transition-colors group-[.active]:border-primary-500 group-[.active]:text-primary-500">
                                    Semua ({{ $laporanTerbaru->count() }})
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-pc-toggle="tab" data-pc-target="tab-pending"
                                   class="pb-3 border-b-2 transition-colors group-[.active]:border-primary-500 group-[.active]:text-primary-500">
                                    Pending ({{ $laporanPending->count() }})
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-pc-toggle="tab" data-pc-target="tab-approved"
                                   class="pb-3 border-b-2 transition-colors group-[.active]:border-primary-500 group-[.active]:text-primary-500">
                                    Disetujui ({{ $laporanApproved->count() }})
                                </a>
                            </li>
                        </ul>
                        <a href="{{ route('apps.reports.create') }}" class="btn btn-primary whitespace-nowrap">
                            <i class="ti ti-plus"></i> Buat Laporan
                        </a>
                    </div>
                </div>
 
                <div class="tab-content">
                    <div class="block tab-pane" id="tab-all">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>JUDUL</th>
                                        <th>JENIS</th>
                                        <th>TAHUN</th>
                                        <th>REALISASI</th>
                                        <th>STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanTerbaru as $laporan)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">{{ Str::limit($laporan->judul_kegiatan, 40) }}</h6>
                                            <small class="text-muted">{{ $laporan->penanggung_jawab }}</small>
                                        </td>
                                        <td><span class="badge bg-info">{{ $laporan->jenis_kegiatan }}</span></td>
                                        <td><span class="badge bg-warning">{{ $laporan->tahun_pelaksanaan }}</span></td>
                                        <td>
                                            <span class="badge bg-{{ $laporan->persentase_realisasi >= 75 ? 'success' : 'warning' }}">
                                                {{ $laporan->persentase_realisasi }}%
                                            </span>
                                        </td>
                                        <td>
                                            @if($laporan->status === 'menunggu verifikasi')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($laporan->status === 'diterima')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif($laporan->status === 'revisi')
                                                <span class="badge bg-danger">Direvisi</span>
                                            @elseif($laporan->status === 'ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @elseif($laporan->status === 'draft')
                                                <span class="badge bg-info">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex items-center justify-center gap-1">
                                                <a href="{{ route('apps.reports.show', Crypt::encrypt($laporan->id)) }}" 
                                                   class="btn btn-icon btn-sm btn-link-info" title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                @if(in_array($laporan->status, ['revisi', 'draft']))
                                                <a href="{{ route('apps.reports.edit', Crypt::encrypt($laporan->id)) }}" 
                                                   class="btn btn-icon btn-sm btn-link-warning" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8">
                                            <i class="ti ti-file-off" style="font-size: 48px; opacity: 0.2;"></i>
                                            <p class="text-muted mb-0">Belum ada laporan</p>
                                            <a href="{{ route('apps.reports.create') }}" class="btn btn-sm btn-primary mt-2">
                                                Buat Laporan Pertama
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                    <div class="hidden tab-pane" id="tab-pending">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>JUDUL</th>
                                        <th>TANGGAL</th>
                                        <th>STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanPending as $laporan)
                                    <tr>
                                        <td>{{ Str::limit($laporan->judul_kegiatan, 50) }}</td>
                                        <td>{{ $laporan->created_at->diffForHumans() }}</td>
                                        <td><span class="badge bg-warning">Menunggu Verifikasi</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('apps.reports.show', Crypt::encrypt($laporan->id)) }}" 
                                               class="btn btn-sm btn-link-info">Detail</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-8 text-muted">Tidak ada laporan pending</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                    <div class="hidden tab-pane" id="tab-approved">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>JUDUL</th>
                                        <th>REALISASI</th>
                                        <th>VERIFIKASI</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanApproved as $laporan)
                                    <tr>
                                        <td>{{ Str::limit($laporan->judul_kegiatan, 50) }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $laporan->persentase_realisasi }}%</span>
                                        </td>
                                        <td>
                                            {{ $laporan->tanggal_verifikasi ? \Carbon\Carbon::parse($laporan->tanggal_verifikasi)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('apps.reports.show', Crypt::encrypt($laporan->id)) }}" 
                                               class="btn btn-sm btn-link-info">Detail</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-8 text-muted">Belum ada laporan disetujui</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
    // Sparklines
    const sparklineOpts = {
        chart: { type: 'line', height: 60, sparkline: { enabled: true } },
        stroke: { curve: 'smooth', width: 2 },
        tooltip: { enabled: false }
    };
 
    new ApexCharts(document.querySelector("#total-laporan-graph"), {
        ...sparklineOpts, series: [{ data: [5, 10, 15, 20, {{ $totalLaporan }}] }], colors: ['#4680FF']
    }).render();
 
    new ApexCharts(document.querySelector("#pending-graph"), {
        ...sparklineOpts, series: [{ data: [2, 5, 8, {{ $laporanDiajukan }}] }], colors: ['#E58A00']
    }).render();
 
    new ApexCharts(document.querySelector("#approved-graph"), {
        ...sparklineOpts, series: [{ data: [3, 8, 12, {{ $laporanDisetujui }}] }], colors: ['#2ca87f']
    }).render();
 
    new ApexCharts(document.querySelector("#revision-graph"), {
        ...sparklineOpts, series: [{ data: [1, 3, 5, {{ $laporanDirevisi }}] }], colors: ['#DC2626']
    }).render();
 
    // Trend Bulanan
    const bulanData = @json($laporanPerBulan);
    const allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const dataTotal = Array(12).fill(0);
    const dataDisetujui = Array(12).fill(0);
    
    bulanData.forEach(item => {
        const idx = allMonths.indexOf(item.bulan);
        if (idx !== -1) {
            dataTotal[idx] = item.total;
            dataDisetujui[idx] = item.disetujui;
        }
    });
 
    new ApexCharts(document.querySelector("#trend-bulanan-chart"), {
        chart: { type: 'area', height: 320, toolbar: { show: false } },
        series: [
            { name: 'Total Laporan', data: dataTotal },
            { name: 'Disetujui', data: dataDisetujui }
        ],
        xaxis: { categories: allMonths },
        colors: ['#4680FF', '#2ca87f'],
        fill: { type: 'gradient', gradient: { opacityFrom: 0.4, opacityTo: 0.1 } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        legend: { position: 'top' }
    }).render();
 
    // Realisasi Donut
    const realisasiData = @json($distribusiRealisasi);
    new ApexCharts(document.querySelector("#realisasi-donut-chart"), {
        chart: { type: 'donut', height: 250 },
        series: realisasiData.map(i => i.total),
        labels: realisasiData.map(i => i.kategori.split(' ')[0]),
        colors: ['#2ca87f', '#4680FF', '#E58A00', '#DC2626'],
        legend: { show: false },
        plotOptions: { pie: { donut: { size: '65%' } } },
        dataLabels: { enabled: true }
    }).render();
    </script>
</x-app>