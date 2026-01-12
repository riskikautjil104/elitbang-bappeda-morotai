<x-app>
    <div class="grid grid-cols-12 gap-6">

        {{-- 🔔 ALERT NOTIFICATIONS --}}
        @if($laporanUrgent > 0 || $opdInactive > 0)
        <div class="col-span-12">
            <div class="flex gap-4">
                @if($laporanUrgent > 0)
                <div class="flex-1 p-4 bg-warning-50 border-l-4 border-warning-500 rounded-lg">
                    <div class="flex items-center gap-3">
                        <i class="ti ti-alert-triangle text-2xl text-warning-500"></i>
                        <div>
                            <h6 class="mb-0 text-warning-700">{{ $laporanUrgent }} Laporan Menunggu > 7 Hari</h6>
                            <p class="text-sm text-warning-600 mb-0">Segera tindak lanjuti laporan pending</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($opdInactive > 0)
                <div class="flex-1 p-4 bg-danger-50 border-l-4 border-danger-500 rounded-lg">
                    <div class="flex items-center gap-3">
                        <i class="ti ti-user-off text-2xl text-danger-500"></i>
                        <div>
                            <h6 class="mb-0 text-danger-700">{{ $opdInactive }} OPD Tidak Aktif</h6>
                            <p class="text-sm text-danger-600 mb-0">Tidak submit laporan 3 bulan terakhir</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- STATS CARDS --}}
        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-primary-500/10">
                                <i class="ti ti-file-text text-2xl text-primary-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-0">Total Laporan</p>
                                <h4 class="mb-0">{{ $totalLaporan }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="total-laporan-graph"></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-warning-500/10">
                                <i class="ti ti-clock text-2xl text-warning-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-0">Pending</p>
                                <h4 class="mb-0">{{ $laporanDiajukan }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="pending-graph"></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-success-500/10">
                                <i class="ti ti-circle-check text-2xl text-success-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-0">Disetujui</p>
                                <h4 class="mb-0">{{ $laporanDisetujui }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="approved-graph"></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-info-500/10">
                                <i class="ti ti-users text-2xl text-info-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-muted mb-0">Total OPD</p>
                                <h4 class="mb-0">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="opd-graph"></div>
                </div>
            </div>
        </div>

        {{-- TREND BULANAN & STATUS CHART --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h5 class="mb-0">📈 Trend Laporan Bulanan (12 Bulan Terakhir)</h5>
                    <span class="badge bg-success">+{{ $growthPercentage }}%</span>
                </div>
                <div class="card-body">
                    <div id="trend-bulanan-chart"></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📊 Distribusi Status</h5>
                </div>
                <div class="card-body">
                    <div id="status-pie-chart"></div>
                    <div class="grid gap-2 mt-4">
                        <div class="flex items-center justify-between p-3 bg-warning-50 rounded-lg">
                            <span class="text-sm">Pending</span>
                            <span class="badge bg-warning">{{ $laporanDiajukan }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-success-50 rounded-lg">
                            <span class="text-sm">Disetujui</span>
                            <span class="badge bg-success">{{ $laporanDisetujui }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-danger-50 rounded-lg">
                            <span class="text-sm">Direvisi</span>
                            <span class="badge bg-danger">{{ $laporanDirevisi }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MONITORING PERFORMA OPD --}}
        <div class="col-span-12 lg:col-span-6">
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h5 class="mb-0">🏆 Top 10 Performa OPD</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-link-primary">Detail →</a>
                </div>
                <div class="card-body">
                    <div class="space-y-3">
                        @foreach($performaOpd as $index => $opd)
                        <div class="p-4 rounded-lg bg-theme-bodybg">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center
                                    {{ $index < 3 ? 'bg-warning text-white' : 'bg-light-primary text-primary' }}">
                                    #{{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0">{{ Str::limit($opd->nama_opd, 30) }}</h6>
                                    <p class="text-xs text-muted mb-0">Score: {{ $opd->performance_score }}/100</p>
                                </div>
                                <span class="badge bg-success">{{ $opd->disetujui }} ✓</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-success-500 h-2 rounded-full"
                                    style="width: {{ $opd->performance_score }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- WAKTU VERIFIKASI --}}
        <div class="col-span-12 lg:col-span-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">⏱️ Analisis Waktu Verifikasi</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="mb-0">{{ number_format($avgWaktuVerifikasi, 1) }} Hari</h3>
                        <p class="text-muted mb-0">Rata-rata Waktu Verifikasi</p>
                    </div>
                    <div id="waktu-verifikasi-chart"></div>
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        @foreach($distribusiWaktuVerifikasi as $item)
                        <div class="p-3 bg-theme-bodybg rounded-lg text-center">
                            <h5 class="mb-0">{{ $item->total }}</h5>
                            <p class="text-sm text-muted mb-0">{{ $item->kategori }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- STATISTIK ANGGARAN --}}
        <div class="col-span-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <i class="ti ti-coin text-4xl text-primary-500"></i>
                            <div>
                                <p class="text-sm text-muted mb-0">Total Anggaran</p>
                                <h5 class="mb-0">{{ $totalAnggaranFormatted }}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <i class="ti ti-wallet text-4xl text-success-500"></i>
                            <div>
                                <p class="text-sm text-muted mb-0">Total Realisasi</p>
                                <h5 class="mb-0">{{ $totalRealisasiFormatted }}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <i class="ti ti-chart-bar text-4xl text-warning-500"></i>
                            <div>
                                <p class="text-sm text-muted mb-0">Rata-rata Realisasi</p>
                                <h5 class="mb-0">{{ number_format($rataRealisasi, 1) }}%</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <i class="ti ti-category text-4xl text-info-500"></i>
                            <div>
                                <p class="text-sm text-muted mb-0">Jenis Kegiatan</p>
                                <h5 class="mb-0">{{ $totalJenisKegiatan }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- LAPORAN TERBARU --}}
        <div class="col-span-12">
            <div class="card">
                <div class="card-header border-bottom">
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
                </div>

                <div class="tab-content">
                    <div class="block tab-pane" id="tab-all">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>JUDUL</th>
                                        <th>OPD</th>
                                        <th>JENIS</th>
                                        <th>TAHUN</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanTerbaru as $laporan)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">{{ Str::limit($laporan->judul_kegiatan, 40) }}</h6>
                                            <small class="text-muted">{{ $laporan->penanggung_jawab }}</small>
                                        </td>
                                        <td>{{ Str::limit($laporan->user->nama_opd ?? '-', 25) }}</td>
                                        <td><span class="badge bg-info">{{ $laporan->jenis_kegiatan }}</span></td>
                                        <td><span class="badge bg-warning">{{ $laporan->tahun_pelaksanaan }}</span></td>
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
                                            @else
                                            <span class="badge bg-secondary">{{ $laporan->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('reports.admin.show', Crypt::encrypt($laporan->id)) }}"
                                                class="btn btn-icon btn-sm btn-link-info">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8 text-muted">Tidak ada data</td>
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
                                        <th>OPD</th>
                                        <th>TANGGAL</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanPending as $laporan)
                                    <tr>
                                        <td>{{ Str::limit($laporan->judul_kegiatan, 50) }}</td>
                                        <td>{{ Str::limit($laporan->user->nama_opd ?? '-', 25) }}</td>
                                        <td>{{ $laporan->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('reports.admin.show', Crypt::encrypt($laporan->id)) }}"
                                                class="btn btn-sm btn-warning">Verifikasi</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-8 text-muted">Tidak ada laporan pending
                                        </td>
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
                                        <th>OPD</th>
                                        <th>REALISASI</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanApproved as $laporan)
                                    <tr>
                                        <td>{{ Str::limit($laporan->judul_kegiatan, 50) }}</td>
                                        <td>{{ Str::limit($laporan->user->nama_opd ?? '-', 25) }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $laporan->persentase_realisasi }}%</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('reports.admin.show', Crypt::encrypt($laporan->id)) }}"
                                                class="btn btn-sm btn-link-info">Detail</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-8 text-muted">Tidak ada laporan disetujui
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Sparklines
    const sparklineOptions = {
        chart: { type: 'line', height: 60, sparkline: { enabled: true } },
        stroke: { curve: 'smooth', width: 2 },
        tooltip: { enabled: false }
    };
 
    new ApexCharts(document.querySelector("#total-laporan-graph"), {
        ...sparklineOptions, series: [{ data: [10, 20, 15, 30, {{ $totalLaporan }}] }], colors: ['#4680FF']
    }).render();
 
    new ApexCharts(document.querySelector("#pending-graph"), {
        ...sparklineOptions, series: [{ data: [5, 8, 12, {{ $laporanDiajukan }}] }], colors: ['#E58A00']
    }).render();
 
    new ApexCharts(document.querySelector("#approved-graph"), {
        ...sparklineOptions, series: [{ data: [8, 15, 20, {{ $laporanDisetujui }}] }], colors: ['#2ca87f']
    }).render();
 
    new ApexCharts(document.querySelector("#opd-graph"), {
        ...sparklineOptions, series: [{ data: [10, 15, 18, {{ $totalUsers }}] }], colors: ['#00B8D9']
    }).render();
 
    // Trend Bulanan
    const trendData = @json($trendBulanan);
    new ApexCharts(document.querySelector("#trend-bulanan-chart"), {
        chart: { type: 'area', height: 320, toolbar: { show: false } },
        series: [
            { name: 'Total', data: trendData.map(i => i.total) },
            { name: 'Disetujui', data: trendData.map(i => i.disetujui) },
            { name: 'Pending', data: trendData.map(i => i.pending) }
        ],
        xaxis: { categories: trendData.map(i => i.bulan) },
        colors: ['#4680FF', '#2ca87f', '#E58A00'],
        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1 } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 }
    }).render();
 
    // Status Pie
    new ApexCharts(document.querySelector("#status-pie-chart"), {
        chart: { type: 'donut', height: 250 },
        series: [{{ $laporanDiajukan }}, {{ $laporanDisetujui }}, {{ $laporanDirevisi }}],
        labels: ['Pending', 'Disetujui', 'Direvisi'],
        colors: ['#E58A00', '#2ca87f', '#DC2626'],
        legend: { show: false },
        plotOptions: { pie: { donut: { size: '65%' } } }
    }).render();
 
    // Waktu Verifikasi
    const waktuData = @json($distribusiWaktuVerifikasi);
    new ApexCharts(document.querySelector("#waktu-verifikasi-chart"), {
        chart: { type: 'bar', height: 200, toolbar: { show: false } },
        series: [{ data: waktuData.map(i => i.total) }],
        xaxis: { categories: waktuData.map(i => i.kategori) },
        colors: ['#4680FF'],
        plotOptions: { bar: { horizontal: true, borderRadius: 4 } }
    }).render();
    </script>
</x-app>