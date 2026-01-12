@extends('frondend.layout.app')

@section('title', 'Daftar OPD - E-Litbang')

@section('content')
    <!-- Banner Start -->
    <div class="hero-section"
        style="background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%); position: relative; overflow: hidden; padding: 80px 0;">
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
                            style="font-size: 2.8rem; font-weight: 700; color: white; margin-bottom: 15px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); line-height: 1.2;">
                            <i class="lni-apartment mr-3"></i>Daftar Organisasi Perangkat Daerah
                        </h1>
                        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 25px; max-width: 600px;">
                            Informasikan dan statistik laporan penelitian dan pengembangan dari seluruh OPD Pemerintah Kota
                        </p>
                        <div class="hero-stats" style="display: flex; gap: 30px; margin-bottom: 25px;">
                            <div style="text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $opds->total() }}</div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Total OPD</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $totalLaporan }}</div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Total Laporan</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $totalDiterima }}</div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Laporan Diterima</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-image" style="text-align: center; position: relative; z-index: 2;">
                        <i class="lni-users" style="font-size: 120px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Top Performers Section Start -->
    @if (count($topOpds) > 0)
        <section class="section-padding"
            style="background: #fff; margin-top: -30px; position: relative; z-index: 10; border-bottom: 1px solid #eee;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4
                            style="color: #1a5f7a; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center;">
                            <i class="lni-apartment mr-2" style="color: #1a5f7a;"></i> OPD
                        </h4>
                    </div>
                </div>
                <div class="row">
                    @foreach ($topOpds as $index => $opd)
                        <div class="col-lg-4 col-md-6 col-xs-12 mb-3">
                            <div class="top-performer-card"
                                style="background: linear-gradient(135deg, {{ $index == 0 ? '#f59e0b' : '#1a5f7a' }} 0%, {{ $index == 0 ? '#d97706' : '#159895' }} 100%); border-radius: 15px; padding: 25px; color: white; position: relative; overflow: hidden;">
                                @if ($index == 0)
                                    <div
                                        style="position: absolute; top: 10px; right: 10px; background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 20px; font-size: 0.8rem;">
                                        <i class="lni-crown"></i> Top
                                    </div>
                                @endif
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div
                                        style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700;">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">{{ $opd->nama_opd }}</h5>
                                        <small style="opacity: 0.9;">{{ $opd->users_count }} Pengguna</small>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.2);">
                                    <div style="text-align: center;">
                                        <div style="font-size: 1.5rem; font-weight: 700;">{{ $opd->laporans_count }}</div>
                                        <small>Total Laporan</small>
                                    </div>
                                    <div style="text-align: center;">
                                        <div style="font-size: 1.5rem; font-weight: 700;">
                                            {{ $opd->laporans_diterima_count }}</div>
                                        <small>Diterima</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- Top Performers Section End -->

    <!-- OPD List Section Start -->
    <section class="section-padding" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-header text-center mb-4">
                        <h2 class="section-title">Semua OPD</h2>
                        <p>Daftar lengkap Organisasi Perangkat Daerah</p>
                    </div>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="row mb-4">
                <div class="col-lg-6 mx-auto">
                    <form action="{{ route('frontend.opd') }}" method="GET" class="search-form"
                        style="display: flex; gap: 10px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari OPD..."
                            value="{{ request('search') }}"
                            style="padding: 12px 20px; border-radius: 50px; border: 1px solid #ddd;">
                        <button type="submit" class="btn btn-primary" style="padding: 12px 25px; border-radius: 50px;">
                            <i class="lni-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="row">
                @forelse($opds as $opd)
                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <div class="opd-card"
                            style="background: white; border-radius: 15px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; border-left: 4px solid #1a5f7a;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <h4 style="color: #333; font-weight: 600; margin-bottom: 5px;">{{ $opd->nama_opd }}
                                    </h4>
                                    <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;">
                                        <i class="lni-user mr-1"></i> {{ $opd->users_count }} Pengguna Terdaftar
                                    </p>
                                </div>
                                <div style="text-align: right;">
                                    <span class="badge"
                                        style="background: {{ $opd->laporans_diterima_count > 0 ? '#10b981' : '#6b7280' }}; padding: 8px 15px; border-radius: 20px;">
                                        {{ $opd->laporans_diterima_count }} Laporan Diterima
                                    </span>
                                </div>
                            </div>

                            <!-- Stats Bar -->
                            <div style="margin-top: 20px;">
                                @php
                                    $laporansMenungguCount = \App\Models\LaporanAkhir::where(
                                        'status',
                                        'menunggu
                  verifikasi',
                                    )
                                        ->whereHas('user', function ($q) use ($opd) {
                                            $q->where('nama_opd', $opd->nama_opd);
                                        })
                                        ->count();
                                    $laporansDitolakCount = \App\Models\LaporanAkhir::where('status', 'ditolak')
                                        ->whereHas('user', function ($q) use ($opd) {
                                            $q->where('nama_opd', $opd->nama_opd);
                                        })
                                        ->count();
                                @endphp
                                <div
                                    style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.85rem; color: #666;">
                                    <span>Total: <strong>{{ $opd->laporans_count }}</strong></span>
                                    <span>Menunggu: <strong>{{ $laporansMenungguCount }}</strong></span>
                                    <span>Ditolak: <strong>{{ $laporansDitolakCount }}</strong></span>
                                </div>
                                <div
                                    style="background: #e5e7eb; border-radius: 10px; height: 10px; overflow: hidden; display: flex;">
                                    @php
                                        $diterimaWidth =
                                            $opd->laporans_count > 0
                                                ? ($opd->laporans_diterima_count / $opd->laporans_count) * 100
                                                : 0;
                                        $menungguWidth =
                                            $opd->laporans_count > 0
                                                ? ($laporansMenungguCount / $opd->laporans_count) * 100
                                                : 0;
                                        $ditolakWidth =
                                            $opd->laporans_count > 0
                                                ? ($laporansDitolakCount / $opd->laporans_count) * 100
                                                : 0;
                                    @endphp
                                    <div style="background: #10b981; height: 100%; width: {{ $diterimaWidth }}%;"></div>
                                    <div style="background: #f59e0b; height: 100%; width: {{ $menungguWidth }}%;"></div>
                                    <div style="background: #ef4444; height: 100%; width: {{ $ditolakWidth }}%;"></div>
                                </div>
                                <div style="display: flex; gap: 15px; margin-top: 8px; font-size: 0.75rem;">
                                    <span style="display: flex; align-items: center;"><span
                                            style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; margin-right: 5px;"></span>
                                        Diterima ({{ $opd->laporans_diterima_count }})</span>
                                    <span style="display: flex; align-items: center;"><span
                                            style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; margin-right: 5px;"></span>
                                        Menunggu ({{ $laporansMenungguCount }})</span>
                                    <span style="display: flex; align-items: center;"><span
                                            style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; margin-right: 5px;"></span>
                                        Ditolak ({{ $laporansDitolakCount }})</span>
                                </div>
                            </div>

                            @if ($opd->laporans_count > 0)
                                <div style="margin-top: 15px;">
                                    <a href="{{ route('frontend.opd-detail', encrypt($opd->id)) }}"
                                        class="btn btn-sm btn-outline-primary" style="border-radius: 20px;">
                                        <i class="lni-building mr-1"></i> Detail OPD
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info" style="padding: 40px; border-radius: 15px;">
                            <i class="lni-inbox" style="font-size: 3rem; color: #1a5f7a;"></i>
                            <h4 class="mt-3">Tidak ada OPD ditemukan</h4>
                            <p>Coba ubah kata kunci pencarian</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        {{ $opds->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- OPD List Section End -->

    <style>
        .opd-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .search-form input:focus {
            border-color: #1a5f7a;
            box-shadow: 0 0 0 3px rgba(26, 95, 122, 0.1);
        }
    </style>
@endsection
