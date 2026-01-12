@extends('frondend.layout.app')

@section('title', $laporan->judul_kegiatan . ' - E-Litbang')

@section('content')
<!-- Page Header Start -->
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
         <div class="col-md-8">
            <div class="header-content" style="position: relative; z-index: 2;">
               <div class="mb-3">
                  @if($laporan->jenis_kegiatan == 'penelitian')
                  <span class="badge badge-jenis-penelitian">
                     <i class="lni-book"></i> Penelitian
                  </span>
                  @else
                  <span class="badge badge-jenis-pengembangan">
                     <i class="lni-cog"></i> Pengembangan
                  </span>
                  @endif
               </div>
               <h2 class="page-title" style="color: white; font-weight: 700; margin-bottom: 15px;">
                  {{ $laporan->judul_kegiatan }}
               </h2>
               <p class="page-subtitle" style="color: rgba(255,255,255,0.9); margin-bottom: 0;">
                  <i class="lni-user mr-2"></i> {{ $laporan->user->nama_opd ?? $laporan->user->name }}
               </p>
            </div>
         </div>
         <div class="col-md-4 text-right">
            <a href="{{ route('frontend.data') }}" class="btn btn-back">
               <i class="lni-arrow-left mr-1"></i> Kembali
            </a>
         </div>
      </div>
   </div>
</div>
<!-- Page Header End -->

<!-- Detail Section Start -->
<section class="section-padding" style="padding: 60px 0; background: #f8f9fa;">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-12">
            <!-- Informasi Umum -->
            <div class="detail-card mb-4">
               <div class="detail-card-header">
                  <i class="lni-information mr-2"></i>
                  <h5>Informasi Umum</h5>
               </div>
               <div class="detail-card-body">
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <div class="info-item">
                           <label>Jenis Kegiatan</label>
                           <div>
                              @if($laporan->jenis_kegiatan == 'penelitian')
                              <span class="badge badge-info-penelitian">
                                 <i class="lni-book"></i> Penelitian
                              </span>
                              @else
                              <span class="badge badge-info-pengembangan">
                                 <i class="lni-cog"></i> Pengembangan
                              </span>
                              @endif
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="info-item">
                           <label>Tahun Pelaksanaan</label>
                           <p><i class="lni-calendar mr-2"></i>{{ $laporan->tahun_pelaksanaan }}</p>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="info-item">
                           <label>Penanggung Jawab</label>
                           <p><i class="lni-user mr-2"></i>{{ $laporan->penanggung_jawab }}</p>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="info-item">
                           <label>Lokasi Kegiatan</label>
                           <p><i class="lni-map-marker mr-2"></i>{{ $laporan->lokasi_kegiatan }}</p>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="info-item">
                           <label>Periode Pelaksanaan</label>
                           <p><i class="lni-calendar mr-2"></i>{{ \Carbon\Carbon::parse($laporan->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->format('d M Y') }}</p>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="info-item">
                           <label>Anggaran</label>
                           <p class="text-success"><i class="lni-money-protection mr-2"></i><strong>{{ $laporan->anggaranFormatted }}</strong></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Latar Belakang -->
            <div class="detail-card mb-4">
               <div class="detail-card-header">
                  <i class="lni-text-format mr-2"></i>
                  <h5>Latar Belakang</h5>
               </div>
               <div class="detail-card-body">
                  <p class="text-justify content-text">{{ $laporan->latar_belakang }}</p>
               </div>
            </div>

            <!-- Tujuan Kegiatan -->
            <div class="detail-card mb-4">
               <div class="detail-card-header">
                  <i class="lni-target mr-2"></i>
                  <h5>Tujuan Kegiatan</h5>
               </div>
               <div class="detail-card-body">
                  <p class="text-justify content-text">{{ $laporan->tujuan_kegiatan }}</p>
               </div>
            </div>

            <!-- Metode Pelaksanaan -->
            <div class="detail-card mb-4">
               <div class="detail-card-header">
                  <i class="lni-cog mr-2"></i>
                  <h5>Metode Pelaksanaan</h5>
               </div>
               <div class="detail-card-body">
                  <p class="text-justify content-text">{{ $laporan->metode_pelaksanaan }}</p>
               </div>
            </div>

            <!-- Tahapan Pelaksanaan -->
            <div class="detail-card mb-4">
               <div class="detail-card-header">
                  <i class="lni-layers mr-2"></i>
                  <h5>Tahapan Pelaksanaan</h5>
               </div>
               <div class="detail-card-body">
                  <p class="text-justify content-text">{{ $laporan->tahapan_pelaksanaan }}</p>
               </div>
            </div>

            <!-- Output & Hasil -->
            <div class="detail-card mb-4">
               <div class="detail-card-header header-success">
                  <i class="lni-checkmark-circle mr-2"></i>
                  <h5>Output & Hasil</h5>
               </div>
               <div class="detail-card-body">
                  <div class="mb-4">
                     <label class="section-label">Output Kegiatan</label>
                     <p class="text-justify content-text">{{ $laporan->output_kegiatan }}</p>
                  </div>
                  <div class="mb-4">
                     <label class="section-label">Hasil Kegiatan</label>
                     <p class="text-justify content-text">{{ $laporan->hasil_kegiatan }}</p>
                  </div>
                  <div>
                     <label class="section-label">Persentase Realisasi</label>
                     <div class="progress-wrapper">
                        <div class="progress">
                           <div class="progress-bar" role="progressbar" style="width: {{ $laporan->persentase_realisasi }}%">
                              {{ $laporan->persentase_realisasi }}%
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Dokumen Lampiran -->
            
         </div>

         <!-- Sidebar -->
         <div class="col-lg-4 col-md-12">
            <!-- Info Box -->
            <div class="sidebar-card mb-4">
               <div class="sidebar-card-header">
                  <i class="lni-information mr-2"></i>
                  <h5>Informasi</h5>
               </div>
               <div class="sidebar-card-body">
                  <div class="sidebar-info-item">
                     <label>OPD</label>
                     <p><i class="lni-user mr-2"></i>{{ $laporan->user->nama_opd ?? $laporan->user->name }}</p>
                  </div>
                  <div class="sidebar-info-item">
                     <label>Status</label>
                     @php
                        $statusClass = match($laporan->status) {
                            'menunggu verifikasi' => 'status-warning',
                            'diterima' => 'status-success',
                            'revisi' => 'status-orange',
                            'ditolak' => 'status-danger',
                            default => 'status-secondary'
                        };
                        $statusLabel = match($laporan->status) {
                            'menunggu verifikasi' => 'Menunggu Verifikasi',
                            'diterima' => 'Diterima',
                            'revisi' => 'Revisi',
                            'ditolak' => 'Ditolak',
                            default => ucfirst($laporan->status ?? 'N/A')
                        };
                     @endphp
                     <p><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></p>
                  </div>
                  <div class="sidebar-info-item">
                     <label>Tanggal Publish</label>
                     <p><i class="lni-calendar mr-2"></i>{{ $laporan->tanggal_verifikasi ? \Carbon\Carbon::parse($laporan->tanggal_verifikasi)->format('d M Y') : '-' }}</p>
                  </div>
               </div>
            </div>

      
         </div>
      </div>
   </div>
</section>
<!-- Detail Section End -->

@include('frondend.data.style')
@endsection