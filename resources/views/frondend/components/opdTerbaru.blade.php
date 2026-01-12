<!-- OPD Terbaru Start -->
<section id="opd-terbaru" class="section-padding bg-gray" style="padding: 80px 0; background-color: #f8f9fa;">
   <div class="container">
       <div class="row">
           <div class="col-12">
               <div class="section-title-header text-center" style="margin-bottom: 50px;">
                   <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 15px; line-height: 1.2;">
                       OPD Terproduktif
                   </h2>
                   <p style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                       Organisasi Perangkat Daerah dengan kontribusi penelitian terbanyak
                   </p>
               </div>
           </div>
       </div>
       <div class="row">
           @forelse($opdTerbaru as $index => $opd)
           <div class="col-lg-4 col-md-6 col-xs-12 mb-4">
               <div class="opd-card" style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15); transition: all 0.3s ease; height: 100%; position: relative;">
                   
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

                   <!-- Ranking Badge -->
                   <div style="position: absolute; top: 20px; right: 20px; z-index: 10;">
                       <div style="width: 50px; height: 50px; border-radius: 50%; background: {{ $index == 0 ? 'linear-gradient(135deg, #FFD700, #FFA500)' : ($index == 1 ? 'linear-gradient(135deg, #C0C0C0, #808080)' : 'linear-gradient(135deg, #CD7F32, #8B4513)') }}; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.2);">
                           <span style="font-size: 1.5rem; font-weight: 700; color: white;">#{{ $index + 1 }}</span>
                       </div>
                   </div>
                   
                   <!-- Content Container -->
                   <div style="position: relative; z-index: 2;">
                       <!-- Header dengan Icon -->
                       <div style="padding: 40px 30px; text-align: center;">
                           <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.25); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); box-shadow: 0 8px 20px rgba(0,0,0,0.2);">
                               <i class="lni-apartment" style="font-size: 2.5rem; color: white;"></i>
                           </div>
                           <h3 style="font-size: 1.3rem; font-weight: 600; color: white; margin: 0; line-height: 1.4; text-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                               {{ $opd->nama_opd ?? $opd->name }}
                           </h3>
                       </div>

                       <!-- Body -->
                       <div style="padding: 30px;">
                           <!-- Stats -->
                           <div class="stats-row" style="display: flex; justify-content: space-around; margin-bottom: 25px; padding: 20px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
                               <div class="stat-item" style="text-align: center;">
                                   <div style="font-size: 2rem; font-weight: 700; color: white; margin-bottom: 5px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                       {{ $opd->laporan_diterima_count }}
                                   </div>
                                   <div style="font-size: 0.85rem; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">
                                       Penelitian
                                   </div>
                               </div>
                               <div style="width: 1px; background: rgba(255,255,255,0.3);"></div>
                               <div class="stat-item" style="text-align: center;">
                                   <div style="font-size: 2rem; font-weight: 700; color: white; margin-bottom: 5px;">
                                       <i class="lni-star-filled" style="font-size: 1.5rem;"></i>
                                   </div>
                                   <div style="font-size: 0.85rem; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">
                                       Terverifikasi
                                   </div>
                               </div>
                           </div>

                           <!-- Info -->
                           <div style="margin-bottom: 20px;">
                               <div style="display: flex; align-items: center; margin-bottom: 12px; color: rgba(255,255,255,0.95); padding: 10px; background: rgba(255,255,255,0.1); border-radius: 8px; backdrop-filter: blur(5px);">
                                   <i class="lni-user" style="font-size: 1.1rem; margin-right: 10px; color: white;"></i>
                                   <span style="font-size: 0.95rem; font-weight: 500;">{{ $opd->name }}</span>
                               </div>
                               <div style="display: flex; align-items: center; color: rgba(255,255,255,0.95); padding: 10px; background: rgba(255,255,255,0.1); border-radius: 8px; backdrop-filter: blur(5px);">
                                   <i class="lni-envelope" style="font-size: 1.1rem; margin-right: 10px; color: white;"></i>
                                   <span style="font-size: 0.95rem; font-weight: 500; word-break: break-all;">{{ $opd->email }}</span>
                               </div>
                           </div>

                           <!-- Achievement Badge -->
                           <div style="text-align: center; padding: 15px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 10px; border: 1px solid rgba(255,255,255,0.3);">
                               <i class="lni-medal" style="font-size: 1.5rem; color: #FFD700; margin-right: 8px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));"></i>
                               <span style="font-size: 0.95rem; font-weight: 600; color: white;">
                                   Kontributor Aktif {{ date('Y') }}
                               </span>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           @empty
           <div class="col-12 text-center">
               <div style="padding: 60px 20px;">
                   <i class="lni-apartment" style="font-size: 5rem; color: #ddd; display: block; margin-bottom: 20px;"></i>
                   <p class="text-muted" style="font-size: 1.1rem; color: #999;">
                       Belum ada data OPD yang tersedia.
                   </p>
               </div>
           </div>
           
           @endforelse
           
       </div>
       
       <div class="row" style="margin-top: 40px;">
           <div class="col-12 text-center">
               <a href="{{ route('frontend.opd') }}" class="btn btn-primary btn-lg" 
                   style="padding: 15px 40px; font-weight: 600; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease;">
                   <i class="lni-arrow-right" style="margin-left: 8px;"></i> Lihat Semua Opd
               </a>
           </div>
       </div>
   </div>

   <style>
    .btn-primary{
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
      border: #159895;
   }
   .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
   }
   
   .btn-outline-secondary {
      border: 2px solid #6c757d;
      color: #6c757d;
   }
   
   .btn-outline-secondary:hover {
      background: #6c757d;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
   }
       .opd-card:hover {
           transform: translateY(-10px);
           box-shadow: 0 15px 40px rgba(0,0,0,0.25);
       }

       .opd-card:hover .stats-row {
           background: rgba(255,255,255,0.25) !important;
       }

       /* Mobile Responsive */
       @media (max-width: 768px) {
           .section-title {
               font-size: 1.8rem !important;
           }
           
           .opd-card h3 {
               font-size: 1.1rem !important;
           }
           
           .stats-row {
               flex-direction: column !important;
               gap: 15px;
           }
           
           .stats-row > div:nth-child(2) {
               width: 100% !important;
               height: 1px !important;
           }
       }

       @media (max-width: 576px) {
           section#opd-terbaru {
               padding: 50px 0 !important;
           }
           
           .section-title-header {
               margin-bottom: 30px !important;
           }
       }
   </style>
</section>
<!-- OPD Terbaru End -->