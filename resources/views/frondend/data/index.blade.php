@extends('frondend.layout.app')

@section('title', 'Data Penelitian - E-Litbang')

@section('content')
<!-- Banner Start -->
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
         <div class="col-lg-8">
            <div class="hero-content" style="position: relative; z-index: 2;">
               <h1
               style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); line-height: 1.2;">
               <i class="lni-book" style="margin-right: 15px;"></i>Data Penelitian
               </h1>
               <p style="font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 25px; max-width: 600px;">
                  Jelajahi kumpulan laporan penelitian dan pengembangan dari seluruh Organisasi Perangkat Daerah (OPD)
                  Pemerintah Kota
               </p>
               <div class="hero-stats" style="display: flex; gap: 30px; margin-bottom: 25px;">
                  <div style="text-align: center;">
                     <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $laporans->total() }}</div>
                     <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Total Data</div>
                  </div>
                  <div style="text-align: center;">
                     <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $opds->count() }}</div>
                     <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">OPD Terlibat</div>
                  </div>
                  <div style="text-align: center;">
                     <div style="font-size: 2.5rem; font-weight: 700; color: #fff;">{{ $tahuns->count() }}</div>
                     <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Tahun</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="hero-image" style="text-align: center; position: relative; z-index: 2;">
               <i class="lni-search" style="font-size: 120px; color: rgba(255,255,255,0.3);"></i>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Banner End -->

<!-- Filter Section Start -->
@include('frondend.components.filter')
<!-- Filter Section End -->



<!-- Data Section Start -->
@include('frondend.components.dataSection')
<!-- Data Section End -->


@endsection