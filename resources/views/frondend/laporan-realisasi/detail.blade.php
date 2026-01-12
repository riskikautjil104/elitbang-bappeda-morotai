@extends('frondend.layout.app')

@section('title', 'Detail Laporan Realisasi Anggaran - E-Litbang')

@section('content')
    <!-- Banner Start -->
    <div class="hero-section"
        style="background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%); position: relative; overflow: hidden; padding: 60px 0;">
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
                        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; margin-bottom: 15px;">
                            <ol class="breadcrumb"
                                style="background: rgba(255,255,255,0.15); padding: 8px 15px; border-radius: 20px; display: inline-flex;">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}"
                                        class="text-white">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('frontend.laporan-realisasi') }}"
                                        class="text-white">Laporan Realisasi Anggaran</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                        <h1
                            style="font-size: 2.5rem; font-weight: 700; color: white; margin-bottom: 15px; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); line-height: 1.2;">
                            <i class="lni-wallet" style="margin-right: 12px;"></i>Detail Laporan
                        </h1>
                        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.9); margin-bottom: 0; max-width: 600px;">
                            {{ $laporan->nama_kegiatan }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-image" style="text-align: center; position: relative; z-index: 2;">
                        <i class="lni-clipboard" style="font-size: 100px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Detail Section Start -->
    <div class="section-padding" style="padding: 60px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 mb-4">
                    <!-- Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="lni-information mr-2"></i>Informasi Kegiatan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small fw-semibold">Nama Kegiatan</label>
                                    <p class="mb-0 fw-medium">{{ $laporan->nama_kegiatan }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small fw-semibold">Tanggal Kegiatan</label>
                                    <p class="mb-0 fw-medium">
                                        {{ $laporan->tanggal_kegiatan ? \Carbon\Carbon::parse($laporan->tanggal_kegiatan)->format('d F Y') : '-' }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small fw-semibold">Lokasi</label>
                                    <p class="mb-0 fw-medium">{{ $laporan->lokasi ?: '-' }}</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="text-muted small fw-semibold">Deskripsi</label>
                                    <p class="mb-0">{{ $laporan->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                                </div>
                                @if ($laporan->keterangan)
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small fw-semibold">Keterangan</label>
                                        <p class="mb-0">{{ $laporan->keterangan }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- File Pendukung -->
                    @php
                        $files = json_decode($laporan->file_pendukung ?? '[]', true);
                    @endphp
                    @if (count($files) > 0)
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="lni-paperclip mr-2"></i>File Pendukung ({{ count($files) }})
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($files as $index => $file)
                                        @php
                                            $filename = basename($file);
                                            $fileUrl = asset('storage/' . $file);
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="lni-file" style="font-size: 32px; color: #1a5f7a;"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2 fw-medium text-truncate" title="{{ $filename }}"
                                                            style="max-width: 200px;">
                                                            {{ $filename }}
                                                        </p>
                                                        <a href="{{ $fileUrl }}" target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="lni-download mr-1"></i> Download
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Anggaran Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="lni-money-protection mr-2"></i>Ringkasan Anggaran
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div class="text-muted small mb-1">Persentase Realisasi</div>
                                <div class="display-4 fw-bold"
                                    style="color: {{ $laporan->persentase_realisasi >= 80 ? '#198754' : ($laporan->persentase_realisasi >= 50 ? '#fd7e14' : '#dc3545') }}">
                                    {{ $laporan->persentase_realisasi }}%
                                </div>
                            </div>

                            <div class="progress mb-4" style="height: 12px;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ min($laporan->persentase_realisasi, 100) }}%; background: {{ $laporan->persentase_realisasi >= 80 ? '#198754' : ($laporan->persentase_realisasi >= 50 ? '#fd7e14' : '#dc3545') }}"
                                    aria-valuenow="{{ $laporan->persentase_realisasi }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Anggaran</span>
                                <span class="fw-bold text-primary">
                                    Rp {{ number_format($laporan->anggaran, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Realisasi</span>
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Sisa Anggaran</span>
                                <span class="fw-bold text-danger">
                                    Rp {{ number_format($laporan->anggaran - $laporan->realisasi, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <a href="{{ route('frontend.laporan-realisasi') }}" class="btn btn-outline-secondary w-100">
                        <i class="lni-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Section End -->
@endsection
