<section class="section-padding">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="section-title-header text-center mb-4">
               <h2 class="section-title">Hasil Pencarian</h2>
               <p>Ditemukan {{ $laporans->total() }} data penelitian</p>
            </div>
         </div>
      </div>
      <div class="row">
         @forelse($laporans as $laporan)
         <div class="col-lg-4 col-md-6 col-xs-12 mb-4">
            <div class="research-card">
               <div class="card-image">
                  <a href="{{ route('frontend.data-detail', $laporan->id) }}" class="card-link-overlay">
                     <div class="icon-placeholder">
                        @if($laporan->jenis_kegiatan == 'penelitian')
                        <i class="lni-book"></i>
                        @else
                        <i class="lni-cog"></i>
                        @endif
                     </div>
                  </a>
                  
                  <!-- Jenis Badge dengan Icon -->
                  <div class="jenis-badge">
                     @if($laporan->jenis_kegiatan == 'penelitian')
                     <span class="badge badge-penelitian">
                        <i class="lni-book"></i> Penelitian
                     </span>
                     @else
                     <span class="badge badge-pengembangan">
                        <i class="lni-cog"></i> Pengembangan
                     </span>
                     @endif
                  </div>

                  <!-- Status Badge -->
                  <div class="status-badge-wrapper">
                     @php
                     $statusClass = match($laporan->status) {
                        'menunggu verifikasi' => 'status-warning',
                        'diterima' => 'status-success',
                        'revisi' => 'status-orange',
                        'ditolak' => 'status-danger',
                        default => 'status-secondary'
                     };
                     $statusLabel = match($laporan->status) {
                        'menunggu verifikasi' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'revisi' => 'Revisi',
                        'ditolak' => 'Ditolak',
                        default => ucfirst($laporan->status)
                     };
                     @endphp
                     <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                  </div>
               </div>

               <div class="card-body">
                  <h3 class="card-title">
                     <a href="{{ route('frontend.data-detail', $laporan->id) }}">
                        {{ Str::limit($laporan->judul_kegiatan, 55) }}
                     </a>
                  </h3>
                  
                  <div class="card-info">
                     <div class="info-item">
                        <i class="lni-user"></i>
                        <span>{{ $laporan->user->nama_opd ?? $laporan->user->name }}</span>
                     </div>
                     <div class="info-item">
                        <i class="lni-map-marker"></i>
                        <span>{{ $laporan->lokasi_kegiatan }}</span>
                     </div>
                  </div>

                  <div class="card-footer-info">
                     <div class="year-info">
                        <i class="lni-calendar"></i>
                        <span>{{ $laporan->tahun_pelaksanaan }}</span>
                     </div>
                     <div class="badges-info">
                        <span class="badge badge-realisasi">
                           <i class="lni-pie-chart"></i> {{ $laporan->persentase_realisasi }}%
                        </span>
                        <span class="badge badge-anggaran">
                           <i class="lni-money-protection"></i> {{ $laporan->anggaranFormatted }}
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @empty
         <div class="col-12 text-center">
            <div class="empty-state">
               <i class="lni-inbox"></i>
               <h4>Tidak Ada Data</h4>
               <p>Tidak ada data penelitian yang ditemukan.</p>
            </div>
         </div>
         @endforelse
      </div>

      <!-- Pagination -->
      <div class="row mt-4">
         <div class="col-12">
            <nav aria-label="Page navigation">
               {{ $laporans->appends(request()->query())->links('pagination::bootstrap-4') }}
            </nav>
         </div>
      </div>
   </div>
</section>
<style>
   /* Filter Form Styling */
   .filter-form .form-control {
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 10px 15px;
      transition: all 0.3s ease;
   }

   .filter-form .form-control:focus {
      border-color: #159895;
      box-shadow: 0 0 0 0.2rem rgba(21, 152, 149, 0.15);
   }

   .filter-form label {
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
      font-size: 0.9rem;
   }

   /* Research Card Styling */
   .research-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
   }

   .research-card:hover {
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
      transform: translateY(-5px);
   }

   .card-image {
      position: relative;
      overflow: hidden;
      height: 200px;
      background: linear-gradient(135deg, #e8f4f8 0%, #d4e9f0 100%);
      display: flex;
      align-items: center;
      justify-content: center;
   }

   .card-link-overlay {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
   }

   .icon-placeholder {
      font-size: 80px;
      color: rgba(21, 152, 149, 0.3);
      transition: all 0.3s ease;
   }

   .research-card:hover .icon-placeholder {
      color: rgba(21, 152, 149, 0.5);
      transform: scale(1.1);
   }

   /* Jenis Badge dengan Icon */
   .jenis-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      z-index: 2;
   }

   .jenis-badge .badge {
      padding: 8px 14px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
   }

   .badge-penelitian {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
   }

   .badge-pengembangan {
      background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
      color: white;
   }

   /* Status Badge */
   .status-badge-wrapper {
      position: absolute;
      top: 12px;
      right: 12px;
      z-index: 2;
   }

   .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      color: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
   }

   .status-warning {
      background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
      color: #2d3436;
   }

   .status-success {
      background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
      color: white;
   }

   .status-orange {
      background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);
      color: white;
   }

   .status-danger {
      background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
      color: white;
   }

   .status-secondary {
      background: linear-gradient(135deg, #dfe6e9 0%, #b2bec3 100%);
      color: #2d3436;
   }

   /* Card Body */
   .card-body {
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
   }

   .card-title {
      margin-bottom: 15px;
      min-height: 48px;
   }

   .card-title a {
      color: #2d3748;
      font-size: 1.1rem;
      font-weight: 600;
      text-decoration: none;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      transition: color 0.3s ease;
   }

   .card-title a:hover {
      color: #159895;
   }

   /* Card Info */
   .card-info {
      margin-bottom: 15px;
      flex: 1;
   }

   .info-item {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 8px;
      color: #718096;
      font-size: 0.9rem;
   }

   .info-item i {
      color: #159895;
      font-size: 1rem;
   }

   .info-item span {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
   }

   /* Card Footer Info */
   .card-footer-info {
      border-top: 1px solid #e2e8f0;
      padding-top: 15px;
      margin-top: auto;
   }

   .year-info {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 12px;
      color: #2d3748;
      font-weight: 600;
      font-size: 1rem;
   }

   .year-info i {
      color: #159895;
   }

   .badges-info {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
   }

   .badges-info .badge {
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 5px;
   }

   .badge-realisasi {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
   }

   .badge-anggaran {
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
      color: white;
   }

   /* Empty State */
   .empty-state {
      padding: 60px 20px;
      text-align: center;
   }

   .empty-state i {
      font-size: 80px;
      color: #cbd5e0;
      margin-bottom: 20px;
   }

   .empty-state h4 {
      color: #2d3748;
      font-weight: 600;
      margin-bottom: 10px;
   }

   .empty-state p {
      color: #718096;
      font-size: 1rem;
   }

   /* Responsive */
   @media (max-width: 768px) {
      .card-image {
         height: 180px;
      }

      .jenis-badge .badge,
      .status-badge {
         font-size: 0.75rem;
         padding: 6px 10px;
      }

      .card-title a {
         font-size: 1rem;
      }
   }
</style>