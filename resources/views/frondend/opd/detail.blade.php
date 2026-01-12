@extends('frondend.layout.app')

@section('title', 'Detail OPD - E-Litbang')

@section('content')
<!-- Banner Start -->
<div class="hero-section" style="background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%); position: relative; overflow: hidden; padding: 80px 0 60px;">
    <!-- Decorative Circles -->
    <div style="position: absolute; width: 400px; height: 400px; background: rgba(255,255,255,0.08); border-radius: 50%; top: -150px; right: -100px;"></div>
    <div style="position: absolute; width: 250px; height: 250px; background: rgba(255,255,255,0.05); border-radius: 50%; bottom: -80px; left: 15%;"></div>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-content" style="position: relative; z-index: 2; text-align: center;">
                    <a href="{{ route('frontend.opd') }}" class="btn btn-light mb-4" style="border-radius: 25px; padding: 10px 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <i class="lni-arrow-left mr-2"></i> Kembali ke Daftar OPD
                    </a>
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: white; margin: 0; text-shadow: 2px 2px 8px rgba(0,0,0,0.2); line-height: 1.3;">
                        <i class="lni-apartment mr-2"></i>{{ $opd->nama_opd ?? $opd->name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Content Section Start -->
<section class="section-padding" style="background: #f8f9fa; padding: 60px 0;">
    <div class="container">
        <!-- Statistik Cards -->
        <div class="row mb-5">
            <!-- Total Laporan -->
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stat-card card h-100 text-center" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="icon-wrapper mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, rgba(26,95,122,0.1) 0%, rgba(26,95,122,0.2) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="lni-files" style="font-size: 32px; color: #1a5f7a;"></i>
                        </div>
                        <h2 class="mb-2" style="color: #1a5f7a; font-weight: 700; font-size: 2.2rem;">{{ $totalLaporan }}</h2>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-weight: 500;">Total Laporan</p>
                    </div>
                </div>
            </div>

            <!-- Diterima -->
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stat-card card h-100 text-center" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="icon-wrapper mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, rgba(40,167,69,0.1) 0%, rgba(40,167,69,0.2) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="lni-checkmark-circle" style="font-size: 32px; color: #28a745;"></i>
                        </div>
                        <h2 class="mb-2" style="color: #28a745; font-weight: 700; font-size: 2.2rem;">{{ $diterima }}</h2>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-weight: 500;">Diterima</p>
                    </div>
                </div>
            </div>

            <!-- Menunggu Verifikasi -->
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stat-card card h-100 text-center" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="icon-wrapper mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(255,193,7,0.2) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="lni-hourglass" style="font-size: 32px; color: #ffc107;"></i>
                        </div>
                        <h2 class="mb-2" style="color: #ffc107; font-weight: 700; font-size: 2.2rem;">{{ $menunggu }}</h2>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-weight: 500;">Menunggu</p>
                    </div>
                </div>
            </div>

            <!-- Revisi -->
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stat-card card h-100 text-center" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="icon-wrapper mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, rgba(253,126,20,0.1) 0%, rgba(253,126,20,0.2) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="lni-reload" style="font-size: 32px; color: #fd7e14;"></i>
                        </div>
                        <h2 class="mb-2" style="color: #fd7e14; font-weight: 700; font-size: 2.2rem;">{{ $revisi }}</h2>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-weight: 500;">Revisi</p>
                    </div>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stat-card card h-100 text-center" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="icon-wrapper mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, rgba(220,53,69,0.1) 0%, rgba(220,53,69,0.2) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="lni-close" style="font-size: 32px; color: #dc3545;"></i>
                        </div>
                        <h2 class="mb-2" style="color: #dc3545; font-weight: 700; font-size: 2.2rem;">{{ $ditolak }}</h2>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-weight: 500;">Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info OPD Card -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="card-header" style="background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%); padding: 25px 30px; border: none;">
                        <h5 class="mb-0" style="color: white; font-weight: 600; font-size: 1.3rem;">
                            <i class="lni-information mr-2"></i>Informasi OPD
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper mr-3" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, rgba(26,95,122,0.1) 0%, rgba(26,95,122,0.2) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="lni-apartment" style="font-size: 24px; color: #1a5f7a;"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1" style="font-size: 0.85rem;">Nama OPD</p>
                                        <p class="mb-0" style="font-weight: 600; font-size: 1.05rem; color: #333;">{{ $opd->nama_opd ?? $opd->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper mr-3" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, rgba(21,152,149,0.1) 0%, rgba(21,152,149,0.2) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="lni-envelope" style="font-size: 24px; color: #159895;"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1" style="font-size: 0.85rem;">Email</p>
                                        <p class="mb-0" style="font-weight: 600; font-size: 1.05rem; color: #333;">{{ $opd->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Laporan -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="card-header" style="background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%); padding: 25px 30px; border: none;">
                        <h5 class="mb-0" style="color: white; font-weight: 600; font-size: 1.3rem;">
                            <i class="lni-list mr-2"></i>Daftar Laporan Penelitian
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @if($laporans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="border: none;">
                                <thead style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                    <tr>
                                        <th class="text-center" style="width: 60px; padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none;">No</th>
                                        <th style="padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none;">Judul Kegiatan</th>
                                        <th style="padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none; width: 100px;">Tahun</th>
                                        <th style="padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none; width: 120px;">Jenis</th>
                                        <th class="text-center" style="padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none; width: 140px;">Status</th>
                                        <th class="text-center" style="padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none; width: 120px;">Tanggal</th>
                                        <th class="text-center" style="padding: 18px 15px; font-weight: 600; color: #1a5f7a; border: none; width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporans as $index => $laporan)
                                    <tr style="border-bottom: 1px solid #f0f0f0;">
                                        <td class="text-center" style="padding: 20px 15px; vertical-align: middle;">
                                            <span style="font-weight: 600; color: #666;">{{ $index + 1 }}</span>
                                        </td>
                                        <td style="padding: 20px 15px; vertical-align: middle;">
                                            <p class="mb-1" style="font-weight: 600; color: #333; font-size: 0.95rem;">{{ $laporan->judul_kegiatan }}</p>
                                            <small class="text-muted" style="font-size: 0.85rem;">{{ Str::limit($laporan->latar_belakang, 100) }}</small>
                                        </td>
                                        <td style="padding: 20px 15px; vertical-align: middle;">
                                            <span style="font-weight: 600; color: #666;">{{ $laporan->tahun_pelaksanaan }}</span>
                                        </td>
                                        <td style="padding: 20px 15px; vertical-align: middle;">
                                            <span class="badge" style="padding: 8px 15px; border-radius: 20px; font-weight: 500; font-size: 0.85rem; {{ $laporan->jenis_kegiatan == 'penelitian' ? 'background: linear-gradient(135deg, #17a2b8, #138496); color: white;' : 'background: linear-gradient(135deg, #007bff, #0056b3); color: white;' }}">
                                                {{ ucfirst($laporan->jenis_kegiatan) }}
                                            </span>
                                        </td>
                                        <td class="text-center" style="padding: 20px 15px; vertical-align: middle;">
                                            @php
                                            $statusConfig = match($laporan->status) {
                                                'menunggu verifikasi' => ['color' => '#ffc107', 'label' => 'Menunggu', 'icon' => 'hourglass'],
                                                'diterima' => ['color' => '#28a745', 'label' => 'Diterima', 'icon' => 'checkmark-circle'],
                                                'revisi' => ['color' => '#fd7e14', 'label' => 'Revisi', 'icon' => 'reload'],
                                                'ditolak' => ['color' => '#dc3545', 'label' => 'Ditolak', 'icon' => 'close'],
                                                default => ['color' => '#6c757d', 'label' => ucfirst($laporan->status), 'icon' => 'circle']
                                            };
                                            @endphp
                                            <span class="badge" style="padding: 8px 15px; border-radius: 20px; font-weight: 500; font-size: 0.85rem; background: {{ $statusConfig['color'] }}; color: white;">
                                                <i class="lni-{{ $statusConfig['icon'] }}" style="margin-right: 4px;"></i>{{ $statusConfig['label'] }}
                                            </span>
                                        </td>
                                        <td class="text-center" style="padding: 20px 15px; vertical-align: middle;">
                                            <span style="font-size: 0.9rem; color: #666;">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}</span>
                                        </td>
                                        <td class="text-center" style="padding: 20px 15px; vertical-align: middle;">
                                            <a href="{{ route('frontend.data-detail', $laporan->id) }}" class="btn btn-sm" style="padding: 8px 16px; border-radius: 8px; background: linear-gradient(135deg, #1a5f7a, #159895); color: white; border: none; transition: all 0.3s ease;">
                                                <i class="lni-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5" style="padding: 80px 20px;">
                            <div class="empty-icon mb-4" style="width: 80px; height: 80px; background: linear-gradient(135deg, rgba(26,95,122,0.1) 0%, rgba(21,152,149,0.1) 100%); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                <i class="lni-inbox" style="font-size: 40px; color: #159895;"></i>
                            </div>
                            <h5 style="color: #666; font-weight: 600; margin-bottom: 10px;">Belum Ada Laporan</h5>
                            <p class="text-muted" style="font-size: 0.95rem;">OPD ini belum mengirimkan laporan penelitian</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Stat Card Hover Effect */
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    /* Table Row Hover Effect */
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    /* Button Hover Effect */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Badge Hover Effect */
    .badge {
        transition: all 0.3s ease;
    }

    /* Responsive Table */
    @media (max-width: 991px) {
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .stat-card {
            margin-bottom: 20px;
        }
    }

    /* Remove default table borders */
    .table td, .table th {
        border: none;
    }
</style>
@endsection