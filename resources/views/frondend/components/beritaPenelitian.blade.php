<!-- Berita/Penelitian Terbaru Start -->
<section id="berita" class="section-padding" style="padding: 80px 0;">
   <div class="container">
       <div class="row">
           <div class="col-12">
               <div class="section-title-header text-center" style="margin-bottom: 50px;">
                   <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 15px;line-height: 1.2;">
                       Laporan Terbaru
                   </h2>
                   <p style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                       Hasil penelitian, pengembangan dan inovasi yang telah diverifikasi
                   </p>
               </div>
           </div>
       </div>
       <div class="row">
           @forelse($beritaTerbaru as $laporan)
           <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 30px;">
               <div class="card-penelitian" style="position: relative; overflow: hidden; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); transition: all 0.3s ease; height: 100%;">
                   
                   <!-- Wave Background Pattern -->
                   <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%);">
                       
                       <!-- Wave Layers -->
                       <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.3;">
                           <svg style="position: absolute; bottom: 0; width: 100%; height: 128px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
                               <path d="M0,0 C300,60 600,60 900,0 L900,120 L0,120 Z" fill="rgba(255,255,255,0.1)"/>
                           </svg>
                           <svg style="position: absolute; bottom: 0; width: 100%; height: 160px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
                               <path d="M0,20 C400,80 800,80 1200,20 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.05)"/>
                           </svg>
                           <svg style="position: absolute; bottom: 0; width: 100%; height: 144px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
                               <path d="M0,40 C350,100 850,100 1200,40 L1200,120 L0,120 Z" fill="rgba(0,0,0,0.1)"/>
                           </svg>
                       </div>
                       
                       <!-- Pattern Dots -->
                       <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
                   </div>
               
                   <!-- Icon Badge -->
                   <div class="icon-badge" style="position: absolute; top: -16px; right: -16px; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.3); transition: transform 0.3s; background: linear-gradient(135deg, #57C5B6 0%, #159895 100%);">
                       @if($laporan->jenis_kegiatan == 'penelitian')
                           <!-- Icon Penelitian: Flask/Lab -->
                           <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                           </svg>
                       @elseif($laporan->jenis_kegiatan == 'pengembangan')
                           <!-- Icon Pengembangan: Lightning/Rocket -->
                           <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                           </svg>
                       @else
                           <!-- Icon Default: Document -->
                           <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                           </svg>
                       @endif
                   </div>
               
                   <!-- Content -->
                   <div style="position: relative; padding: 24px; padding-top: 32px;">
                       <!-- Badge Jenis Kegiatan -->
                       <span style="display: inline-block; padding: 6px 16px; margin-bottom: 16px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-radius: 20px; background: rgba(255,255,255,0.2); backdrop-filter: blur(8px); color: white; border: 1px solid rgba(255,255,255,0.3);">
                           @if($laporan->jenis_kegiatan == 'penelitian')
                               <i class="lni-flask" style="margin-right: 4px;"></i>
                           @elseif($laporan->jenis_kegiatan == 'pengembangan')
                               <i class="lni-rocket" style="margin-right: 4px;"></i>
                           @endif
                           {{ ucfirst($laporan->jenis_kegiatan) }}
                       </span>
               
                       <!-- Judul -->
                       <h3 style="font-size: 1.1rem; font-weight: 700; color: white; margin-bottom: 12px; line-height: 1.4; min-height: 60px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                           {{ Str::limit($laporan->judul_kegiatan, 60) }}
                       </h3>
               
                       <!-- Info OPD -->
                       <div style="display: flex; align-items: flex-start; color: rgba(255,255,255,0.9); margin-bottom: 16px; min-height: 40px;">
                           <svg style="width: 16px; height: 16px; margin-right: 8px; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                           </svg>
                           <span style="font-size: 0.85rem; font-weight: 500; line-height: 1.3;">{{ $laporan->user->nama_opd ?? $laporan->user->name }}</span>
                       </div>
               
                       <!-- Divider -->
                       <div style="height: 1px; background: rgba(255,255,255,0.2); margin-bottom: 16px;"></div>
               
                       <!-- Footer Info -->
                       <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                           <!-- Tahun -->
                           <div style="display: flex; align-items: center; color: rgba(255,255,255,0.9);">
                               <svg style="width: 16px; height: 16px; margin-right: 6px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                               </svg>
                               <span style="font-size: 0.85rem; font-weight: 600;">{{ $laporan->tahun_pelaksanaan }}</span>
                           </div>
               
                           <!-- Progress Badge -->
                           <div style="padding: 6px 12px; border-radius: 20px; background: rgba(255,255,255,0.25); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.4); white-space: nowrap;">
                               <span style="font-size: 0.85rem; font-weight: 700; color: white;">{{ $laporan->persentase_realisasi }}%</span>
                               <span style="font-size: 0.7rem; color: rgba(255,255,255,0.9); margin-left: 4px;">Realisasi</span>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           @empty
           <div class="col-12 text-center">
               <div style="padding: 60px 20px;">
                   <i class="lni-files" style="font-size: 5rem; color: #ddd; display: block; margin-bottom: 20px;"></i>
                   <p class="text-muted" style="font-size: 1.1rem; color: #999;">
                       Belum ada penelitian yang dipublikasikan.
                   </p>
               </div>
           </div>
           @endforelse
       </div>
       
           <div class="row" style="margin-top: 40px;">
           <div class="col-12 text-center">
               <a href="{{ route('frontend.data') }}" class="btn btn-primary btn-lg" 
                   style="padding: 15px 40px; font-weight: 600; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease;">
                   <i class="lni-arrow-right" style="margin-left: 8px;"></i> Lihat Semua Data Penelitian
               </a>
           </div>
       </div>
      
       
   </div>
</section>

<!-- Hover Effect CSS -->
<style>
.card-penelitian:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.icon-badge:hover {
    transform: scale(1.1) rotate(5deg);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .section-title {
        font-size: 1.8rem !important;
    }
    
    .icon-badge {
        width: 70px !important;
        height: 70px !important;
        top: -12px !important;
        right: -12px !important;
    }
    
    .icon-badge svg {
        width: 32px !important;
        height: 32px !important;
    }
    
    .card-penelitian h3 {
        font-size: 1rem !important;
        min-height: 50px !important;
    }
}

@media (max-width: 576px) {
    section#berita {
        padding: 50px 0 !important;
    }
    
    .section-title-header {
        margin-bottom: 30px !important;
    }
    
    .icon-badge {
        width: 60px !important;
        height: 60px !important;
        top: -10px !important;
        right: -10px !important;
    }
    
    .icon-badge svg {
        width: 28px !important;
        height: 28px !important;
    }
}
</style>
<!-- Berita/Penelitian Terbaru End -->