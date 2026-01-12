<!-- About Section di Beranda (Dynamic) -->
@if($tentangs->isNotEmpty())
<section id="tentang-beranda" class="section-padding bg-gray" style="padding: 80px 0; background-color: #f8f9fa; position: relative; overflow: hidden;">
   
   <!-- Subtle Wave Background Pattern -->
   <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.4;">
       <svg style="position: absolute; top: 0; width: 100%; height: 180px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
           <path d="M0,60 C300,100 600,100 900,60 C1050,40 1150,40 1200,50 L1200,0 L0,0 Z" fill="rgba(26,95,122,0.03)"/>
       </svg>
       <svg style="position: absolute; bottom: 0; width: 100%; height: 200px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
           <path d="M0,40 C350,90 850,90 1200,40 L1200,120 L0,120 Z" fill="rgba(21,152,149,0.04)"/>
       </svg>
   </div>
   
   <!-- Pattern Dots - Very Subtle -->
   <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.02; background-image: radial-gradient(circle at 2px 2px, #1A5F7A 1px, transparent 0); background-size: 40px 40px;"></div>

   <div class="container" style="position: relative; z-index: 2;">
       <div class="row">
           <div class="col-12">
               <div class="section-title-header text-center" style="margin-bottom: 50px;">
                   <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 15px; line-height: 1.2;">
                       Tentang E-Litbang
                   </h2>
                   <p style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                       Sistem Informasi Penelitian, Pengembangan dan Inovasi Terintegrasi
                   </p>
               </div>
           </div>
       </div>

       <!-- Dynamic Content from Database -->
       @foreach($tentangs->take(2) as $index => $tentang)
       <div class="row mb-5 align-items-center" style="animation: fadeInUp 0.6s ease; animation-delay: {{ $index * 0.1 }}s;">
           @if($tentang->gambar && $index % 2 == 0)
           <!-- Gambar di Kiri -->
           <div class="col-lg-5 mb-4 mb-lg-0">
               <div class="tentang-image" style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transform: translateY(0); transition: all 0.3s ease;">
                   <img src="{{ asset('storage/' . $tentang->gambar) }}" alt="{{ $tentang->judul }}" class="img-fluid" style="width: 100%; height: 350px; object-fit: cover;">
               </div>
           </div>
           @endif

           <div class="col-lg-{{ $tentang->gambar ? '7' : '12' }}">
               <div class="about-item about-card" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;">
                   <!-- Subtle gradient overlay on card -->
                   <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #1A5F7A 0%, #159895 100%);"></div>
                   
                   <h3 style="font-size: 1.8rem; font-weight: 600; color: #1A5F7A; margin-bottom: 20px;">
                       <i class="lni-target" style="margin-right: 10px; font-size: 1.6rem; color: #159895;"></i>
                       {{ $tentang->judul }}
                   </h3>
                   <div class="content-text" style="line-height: 1.8; color: #555; font-size: 1.05rem;">
                       {!! nl2br(e(Str::limit($tentang->konten, 400))) !!}
                   </div>
               </div>
           </div>

           @if($tentang->gambar && $index % 2 != 0)
           <!-- Gambar di Kanan -->
           <div class="col-lg-5 mb-4 mb-lg-0">
               <div class="tentang-image" style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transform: translateY(0); transition: all 0.3s ease;">
                   <img src="{{ asset('storage/' . $tentang->gambar) }}" alt="{{ $tentang->judul }}" class="img-fluid" style="width: 100%; height: 350px; object-fit: cover;">
               </div>
           </div>
           @endif
       </div>

       @if(!$loop->last)
       <hr style="border: 0; height: 1px; background: linear-gradient(90deg, transparent, #ddd, transparent); margin: 40px 0;">
       @endif
       @endforeach

       <!-- Tombol Selengkapnya -->
       @if($tentangs->count() > 2)
       <div class="row mt-5">
           <div class="col-12 text-center">
               <a href="{{ route('frontend.tentang') }}" class="btn btn-primary" style="padding: 12px 35px; font-size: 1.05rem; border-radius: 8px; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); border: none; box-shadow: 0 5px 15px rgba(26,95,122,0.3); transition: all 0.3s ease;">
                   <i class="lni-arrow-right" style="margin-right: 8px;"></i>
                   Selengkapnya Tentang E-Litbang
               </a>
           </div>
       </div>
       @endif
   </div>

   <style>
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

       .about-card:hover {
           transform: translateY(-5px);
           box-shadow: 0 10px 30px rgba(0,0,0,0.12);
       }

       .tentang-image:hover {
           transform: translateY(-5px) !important;
           box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
       }

       .content-text ul {
           list-style: none;
           padding-left: 0;
       }

       .content-text ul li {
           padding-left: 30px;
           position: relative;
           margin-bottom: 12px;
       }

       .content-text ul li:before {
           content: "✓";
           position: absolute;
           left: 0;
           color: #159895;
           font-weight: bold;
           font-size: 1.2rem;
       }

       .btn-primary:hover {
           transform: translateY(-2px);
           box-shadow: 0 8px 20px rgba(26,95,122,0.4);
       }

       /* Mobile Responsive */
       @media (max-width: 768px) {
           .section-title {
               font-size: 2rem !important;
           }

           .about-item {
               padding: 30px !important;
           }

           .about-item h3 {
               font-size: 1.5rem !important;
           }

           .tentang-image img {
               height: 250px !important;
           }

           .content-text {
               font-size: 0.95rem !important;
           }
       }

       @media (max-width: 576px) {
           #tentang-beranda {
               padding: 50px 0 !important;
           }

           .section-title-header {
               margin-bottom: 30px !important;
           }

           .about-item {
               padding: 25px !important;
           }

           .about-item h3 {
               font-size: 1.4rem !important;
               margin-bottom: 15px !important;
           }

           .about-item p {
               font-size: 0.95rem !important;
           }

           .content-text {
               font-size: 0.9rem !important;
           }
       }
   </style>
</section>
@endif