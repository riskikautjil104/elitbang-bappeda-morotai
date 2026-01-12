@extends('frondend.layout.app')

@section('title', 'Laporan Realisasi Anggaran - E-Litbang')

@section('content')
    <!-- Banner Start -->
    <div class="hero-section"
        style="background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%); position: relative; overflow: hidden; padding: 80px 0;">
        <!-- Decorative circles -->
        <div
            style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -100px; right: -50px;">
        </div>
        <div
            style="position: absolute; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%; bottom: -50px; left: 20%;">
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content" style="position: relative; z-index: 2;">
                        <h1
                            style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); line-height: 1.2;">
                            <i class="lni-wallet" style="margin-right: 15px;"></i>Laporan Realisasi Anggaran
                        </h1>
                        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 25px; max-width: 600px;">
                            Transparansi pengelolaan anggaran untuk kegiatan penelitian dan pengembangan di Lingkungan
                            Pemerintah Kota
                        </p>
                        <div class="hero-stats" style="display: flex; gap: 30px; margin-bottom: 25px;">
                            <div style="text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">
                                    Rp {{ number_format($totalAnggaran, 0, ',', '.') }}
                                </div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Total Anggaran</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">
                                    Rp {{ number_format($totalRealisasi, 0, ',', '.') }}
                                </div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Total Realisasi</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $totalPersen }}%</div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">% Realisasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-image" style="text-align: center; position: relative; z-index: 2;">
                        <i class="lni-stats-up" style="font-size: 120px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Filter Section Start -->
    <div class="filter-section section-padding"
        style="background: #f8f9fa; padding: 30px 0; border-bottom: 1px solid #e9ecef;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="GET" action="{{ route('frontend.laporan-realisasi') }}" class="filter-form">
                        <div class="row align-items-end g-3">
                            <!-- Search -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Cari Kegiatan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="lni-search text-muted"></i>
                                    </span>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control border-start-0 ps-0" placeholder="Nama kegiatan...">
                                </div>
                            </div>

                            <!-- Filter Bulan -->
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Bulan</label>
                                <select name="bulan" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create(null, $i)->locale('id')->monthName }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filter Tahun -->
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Tahun</label>
                                <select name="tahun" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Tahun</option>
                                    @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                                        <option value="{{ $year }}"
                                            {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="lni-search mr-1"></i> Cari
                                    </button>
                                    @if (request('search') || request('bulan') || request('tahun'))
                                        <a href="{{ route('frontend.laporan-realisasi') }}"
                                            class="btn btn-outline-secondary">
                                            <i class="lni-reload"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Section End -->

    <!-- Data Section Start -->
    <div class="section-padding" style="padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h4 class="fw-bold text-dark">
                        <i class="lni-list mr-2"></i>Daftar Laporan Realisasi Anggaran
                        <span class="badge bg-primary ms-2">{{ $laporans->total() }}</span>
                    </h4>
                </div>
            </div>

            @forelse ($laporans as $index => $laporan)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 40px rgba(0,0,0,0.1)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <!-- No -->
                                    <div class="col-auto">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 45px; height: 45px; font-weight: 600;">
                                            {{ $loop->iteration + ($laporans->currentPage() - 1) * $laporans->perPage() }}
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="col">
                                        <div class="row">
                                            <!-- Main Info -->
                                            <div class="col-lg-8">
                                                <h5 class="card-title mb-2">
                                                    <a href="{{ route('frontend.laporan-realisasi.detail', $laporan->id) }}"
                                                        class="text-dark text-decoration-none stretched-link">
                                                        {{ $laporan->nama_kegiatan }}
                                                    </a>
                                                </h5>
                                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                                    <i
                                                        class="lni-map-marker mr-1"></i>{{ $laporan->lokasi ?: 'Tidak ada lokasi' }}
                                                </p>
                                                <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                                    <i class="lni-calendar mr-1"></i>
                                                    {{ $laporan->tanggal_kegiatan ? \Carbon\Carbon::parse($laporan->tanggal_kegiatan)->format('d F Y') : '-' }}
                                                </p>
                                            </div>

                                            <!-- Stats -->
                                            <div class="col-lg-4 mt-3 mt-lg-0">
                                                <div class="row text-center">
                                                    <div class="col-6 border-end">
                                                        <div class="text-muted" style="font-size: 0.8rem;">Anggaran</div>
                                                        <div class="fw-bold text-primary">
                                                            Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-muted" style="font-size: 0.8rem;">Realisasi</div>
                                                        <div class="fw-bold text-success">
                                                            Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Progress Bar -->
                                                <div class="mt-3">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <span class="text-muted" style="font-size: 0.8rem;">%
                                                            Realisasi</span>
                                                        <span class="fw-bold"
                                                            style="font-size: 0.85rem; color: {{ $laporan->persentase_realisasi >= 80 ? '#198754' : ($laporan->persentase_realisasi >= 50 ? '#fd7e14' : '#dc3545') }}">
                                                            {{ $laporan->persentase_realisasi }}%
                                                        </span>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ min($laporan->persentase_realisasi, 100) }}%; background: {{ $laporan->persentase_realisasi >= 80 ? '#198754' : ($laporan->persentase_realisasi >= 50 ? '#fd7e14' : '#dc3545') }}"
                                                            aria-valuenow="{{ $laporan->persentase_realisasi }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <i class="lni-inbox" style="font-size: 64px; color: #dee2e6;"></i>
                        <h5 class="mt-3 text-muted">Belum ada data laporan realisasi anggaran</h5>
                        <p class="text-muted">Data akan muncul setelah ditambahkan oleh administrator</p>
                    </div>
                </div>
            @endforelse

            <!-- Pagination -->
            @if ($laporans->hasPages())
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $laporans->appends(request()->all())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Data Section End -->
@endsection
