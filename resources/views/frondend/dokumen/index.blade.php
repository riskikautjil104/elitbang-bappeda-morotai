@extends('frondend.layout.app')

@section('title', 'Dokumen Perencanaan')

@section('content')
<!-- Hero Section -->
<section class="dokumen-hero" style="padding: 100px 0 80px; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); position: relative; overflow: hidden;">
    <!-- Wave Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.15;">
        <svg style="position: absolute; bottom: 0; width: 100%; height: 200px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C300,60 600,60 900,0 L900,120 L0,120 Z" fill="rgba(255,255,255,0.1)"/>
        </svg>
        <svg style="position: absolute; bottom: 0; width: 100%; height: 240px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,20 C400,80 800,80 1200,20 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.05)"/>
        </svg>
    </div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div style="margin-bottom: 25px; animation: bounceIn 1s ease;">
                    <div style="width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 3px solid rgba(255,255,255,0.3); margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                        <i class="lni-files" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                </div>
                <h1 style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2); animation: fadeInUp 0.8s ease;">
                    Dokumen Perencanaan
                </h1>
                <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto; animation: fadeInUp 1s ease;">
                    Akses dokumen RPJMD, RPJPD, RKPD, RENSTRA, dan dokumen perencanaan lainnya
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section style="padding: 40px 0; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <div style="padding: 20px;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="lni-files" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h3 style="color: #1A5F7A; font-weight: 700; margin-bottom: 5px;">{{ $totalDokumen }}</h3>
                    <p style="color: #777; margin: 0;">Total Dokumen</p>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div style="padding: 20px;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #159895, #1A5F7A); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="lni-calendar" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h3 style="color: #1A5F7A; font-weight: 700; margin-bottom: 5px;">{{ date('Y') }}</h3>
                    <p style="color: #777; margin: 0;">Tahun Berjalan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div style="padding: 20px;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="lni-download" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h3 style="color: #1A5F7A; font-weight: 700; margin-bottom: 5px;">Gratis</h3>
                    <p style="color: #777; margin: 0;">Download Dokumen</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Content Section -->
<section style="padding: 60px 0; background: #f8f9fa;">
    <div class="container">
        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <form method="GET" action="{{ route('frontend.dokumen') }}" class="filter-form" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <select name="jenis" class="form-control" style="height: 50px; border-radius: 10px; border: 2px solid #e0e0e0;">
                                <option value="">Semua Jenis Dokumen</option>
                                <option value="RPJMD" {{ request('jenis') == 'RPJMD' ? 'selected' : '' }}>RPJMD</option>
                                <option value="RPJPD" {{ request('jenis') == 'RPJPD' ? 'selected' : '' }}>RPJPD</option>
                                <option value="RKPD" {{ request('jenis') == 'RKPD' ? 'selected' : '' }}>RKPD</option>
                                <option value="RENSTRA" {{ request('jenis') == 'RENSTRA' ? 'selected' : '' }}>RENSTRA</option>
                                <option value="RENJA" {{ request('jenis') == 'RENJA' ? 'selected' : '' }}>RENJA</option>
                                <option value="Lainnya" {{ request('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <select name="tahun" class="form-control" style="height: 50px; border-radius: 10px; border: 2px solid #e0e0e0;">
                                <option value="">Semua Tahun</option>
                                @foreach($tahuns as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <input type="text" name="search" class="form-control" placeholder="Cari dokumen..." value="{{ request('search') }}" style="height: 50px; border-radius: 10px; border: 2px solid #e0e0e0;">
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-block" style="height: 50px; background: linear-gradient(135deg, #1A5F7A, #159895); color: white; border: none; border-radius: 10px; font-weight: 600;">
                                <i class="lni-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Document Table -->
        @if($dokumens->count() > 0)
        <div class="row">
            <div class="col-lg-12">
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <div class="table-responsive">
                        <table class="table" style="margin-bottom: 0;">
                            <thead style="background: linear-gradient(135deg, #1A5F7A, #159895);">
                                <tr>
                                    <th style="color: white; padding: 20px; border: none; font-weight: 600;">NO</th>
                                    <th style="color: white; padding: 20px; border: none; font-weight: 600;">JUDUL DOKUMEN</th>
                                    <th style="color: white; padding: 20px; border: none; font-weight: 600;">JENIS</th>
                                    <th style="color: white; padding: 20px; border: none; font-weight: 600;">TAHUN</th>
                                    <th style="color: white; padding: 20px; border: none; font-weight: 600;">UKURAN FILE</th>
                                    <th style="color: white; padding: 20px; border: none; font-weight: 600; text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumens as $index => $dokumen)
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                                    <td style="padding: 20px; vertical-align: middle;">
                                        <span style="display: inline-block; width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); color: white; text-align: center; line-height: 35px; font-weight: 600;">
                                            {{ $loop->iteration + ($dokumens->currentPage() - 1) * $dokumens->perPage() }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        <h6 style="margin: 0 0 5px 0; color: #1A5F7A; font-weight: 600;">{{ Str::limit($dokumen->judul, 60) }}</h6>
                                        <small style="color: #999;">
                                            <i class="lni-calendar" style="font-size: 12px;"></i> 
                                            {{ $dokumen->published_at->format('d M Y') }}
                                        </small>
                                    </td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        <span style="display: inline-block; padding: 6px 15px; background: linear-gradient(135deg, rgba(26,95,122,0.1), rgba(21,152,149,0.1)); color: #1A5F7A; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                            {{ $dokumen->jenis }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        <span style="display: inline-block; padding: 6px 15px; background: #f0f0f0; color: #555; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                            {{ $dokumen->tahun }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        <span style="color: #777; font-size: 14px;">
                                            <i class="lni-archive" style="color: #159895;"></i> 
                                            {{ $dokumen->getFileSizeFormatted() }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px; vertical-align: middle; text-align: center;">
                                        <a href="{{ route('frontend.dokumen.detail', $dokumen->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #1A5F7A, #159895); color: white; border-radius: 8px; padding: 8px 20px; margin-right: 5px; text-decoration: none; display: inline-block; transition: all 0.3s ease;">
                                            <i class="lni-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('frontend.dokumen.download', $dokumen->id) }}" class="btn btn-sm" style="background: white; color: #1A5F7A; border: 2px solid #1A5F7A; border-radius: 8px; padding: 8px 20px; text-decoration: none; display: inline-block; transition: all 0.3s ease;">
                                            <i class="lni-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($dokumens->hasPages())
                    <div style="padding: 20px; border-top: 1px solid #f0f0f0;">
                        {{ $dokumens->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-lg-12">
                <div style="background: white; border-radius: 15px; padding: 80px 20px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, rgba(26,95,122,0.1), rgba(21,152,149,0.1)); margin: 0 auto 25px; display: flex; align-items: center; justify-content: center;">
                        <i class="lni-files" style="font-size: 3rem; color: #1A5F7A; opacity: 0.5;"></i>
                    </div>
                    <h4 style="color: #1A5F7A; font-weight: 600; margin-bottom: 15px;">Dokumen Tidak Ditemukan</h4>
                    <p style="color: #777; font-size: 1.05rem; margin-bottom: 25px;">Tidak ada dokumen yang sesuai dengan filter yang dipilih.</p>
                    <a href="{{ route('frontend.dokumen') }}" style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #1A5F7A, #159895); color: white; text-decoration: none; border-radius: 25px; font-weight: 600; transition: all 0.3s ease;">
                        <i class="lni-reload"></i> Reset Filter
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table tbody tr:hover .btn {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(26, 95, 122, 0.3);
    }

    @media (max-width: 768px) {
        .dokumen-hero h1 {
            font-size: 2rem !important;
        }
        
        .dokumen-hero p {
            font-size: 1rem !important;
        }

        .table {
            font-size: 14px;
        }

        .table td, .table th {
            padding: 15px 10px !important;
        }

        .btn-sm {
            padding: 6px 12px !important;
            font-size: 12px;
        }
    }
</style>
@endsection