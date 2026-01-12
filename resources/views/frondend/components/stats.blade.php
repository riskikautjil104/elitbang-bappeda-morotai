<section id="tentang" class="section-padding bg-gray" style="padding: 80px 0; background-color: #ffffff;">
   <div class="row">
       <div class="col-12">
           <div class="section-title-header text-center" style="margin-bottom: 50px;">
               <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 15px;">
                   Data E-Litbang
               </h2>
               <p style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                   Sistem Informasi Penelitian, Pengembangan dan Inovasi Terintegrasi
               </p>
           </div>
       </div>
   </div>
</section>

<section class="counter-section section-padding" data-stellar-background-ratio="0.5" style="padding: 80px 0; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); position: relative; overflow: hidden;">
   
   <!-- Wave Background Pattern -->
   <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.2;">
       <svg style="position: absolute; bottom: 0; width: 100%; height: 200px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
           <path d="M0,0 C300,60 600,60 900,0 L900,120 L0,120 Z" fill="rgba(255,255,255,0.1)"/>
       </svg>
       <svg style="position: absolute; bottom: 0; width: 100%; height: 240px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
           <path d="M0,20 C400,80 800,80 1200,20 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.05)"/>
       </svg>
       <svg style="position: absolute; bottom: 0; width: 100%; height: 220px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
           <path d="M0,40 C350,100 850,100 1200,40 L1200,120 L0,120 Z" fill="rgba(0,0,0,0.1)"/>
       </svg>
   </div>
   
   <!-- Pattern Dots -->
   <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.08; background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

   <!-- Wave Top -->
   <div style="position: absolute; top: 0; left: 0; width: 100%; overflow: hidden; line-height: 0; z-index: 1;">
       <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
           <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #ffffff;"></path>
       </svg>
   </div>

   <div class="container" style="position: relative; z-index: 2;">
       <div class="row">
           <div class="col-lg-3 col-md-6 col-sm-6 work-counter-widget text-center mb-4 mb-lg-0">
               <div class="counter counter-card" style="padding: 30px 20px; transition: all 0.3s ease; border-radius: 15px;">
                   <div class="icon" style="font-size: 3.5rem; color: white; margin-bottom: 15px; animation: fadeInUp 0.6s ease; transition: transform 0.3s ease;">
                       <i class="lni-apartment"></i>
                   </div>
                   <div class="counterUp" data-count="{{ $totalOpd }}" style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 10px; text-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                       0
                   </div>
                   <p style="font-size: 1rem; color: rgba(255,255,255,0.95); margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Total OPD</p>
               </div>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-6 work-counter-widget text-center mb-4 mb-lg-0">
               <div class="counter counter-card" style="padding: 30px 20px; transition: all 0.3s ease; border-radius: 15px;">
                   <div class="icon" style="font-size: 3.5rem; color: white; margin-bottom: 15px; animation: fadeInUp 0.8s ease; transition: transform 0.3s ease;">
                       <i class="lni-files"></i>
                   </div>
                   <div class="counterUp" data-count="{{ $totalLaporan }}" style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 10px; text-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                       0
                   </div>
                   <p style="font-size: 1rem; color: rgba(255,255,255,0.95); margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Total Laporan</p>
               </div>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-6 work-counter-widget text-center mb-4 mb-sm-0">
               <div class="counter counter-card" style="padding: 30px 20px; transition: all 0.3s ease; border-radius: 15px;">
                   <div class="icon" style="font-size: 3.5rem; color: white; margin-bottom: 15px; animation: fadeInUp 1s ease; transition: transform 0.3s ease;">
                        <i class="lni-files"></i>
                   </div>
                   <div class="counterUp" data-count="{{ $totalDiterima }}" style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 10px; text-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                       0
                   </div>
                   <p style="font-size: 1rem; color: rgba(255,255,255,0.95); margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Laporan Diterima</p>
               </div>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-6 work-counter-widget text-center">
               <div class="counter counter-card" style="padding: 30px 20px; transition: all 0.3s ease; border-radius: 15px;">
                   <div class="icon" style="font-size: 3.5rem; color: white; margin-bottom: 15px; animation: fadeInUp 1.2s ease; transition: transform 0.3s ease;">
                       <i class="lni-calendar"></i>
                   </div>
                   <div class="counterUp" data-count="{{ date('Y') }}" style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 10px; text-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                       0
                   </div>
                   <p style="font-size: 1rem; color: rgba(255,255,255,0.95); margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Tahun Sekarang</p>
               </div>
           </div>
       </div>
   </div>

   <!-- Wave Bottom -->
   <div style="position: absolute; bottom: 0; left: 0; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg); z-index: 1;">
       <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
           <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #ffffff;"></path>
       </svg>
   </div>
   
   @include('frondend.components.waveStyle')
   
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

       .counter-card:hover {
           background: rgba(255,255,255,0.15);
           backdrop-filter: blur(10px);
           transform: translateY(-5px);
           box-shadow: 0 10px 30px rgba(0,0,0,0.2);
       }

       .counter-card:hover .icon {
           transform: scale(1.1) rotate(5deg);
       }

       /* Mobile Responsive */
       @media (max-width: 768px) {
           .counter {
               padding: 20px 15px !important;
           }
           
           .counter .icon {
               font-size: 2.5rem !important;
               margin-bottom: 10px !important;
           }
           
           .counterUp {
               font-size: 2rem !important;
               margin-bottom: 8px !important;
           }
           
           .counter p {
               font-size: 0.85rem !important;
           }
       }

       @media (max-width: 576px) {
           .counter-section {
               padding: 50px 0 !important;
           }
           
           .work-counter-widget {
               margin-bottom: 20px !important;
           }
       }
   </style>
</section>