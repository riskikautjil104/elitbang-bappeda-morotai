@extends('frondend.layout.app')

@section('title', 'Beranda - E-Litbang')

@section('content')
    <!-- Hero Section Start -->
   @include('frondend.components.banner')
    <!-- Hero Section End -->

    <!-- Stats Section Start -->
    @include('frondend.components.stats')
    <!-- Counter Section End-->

        <!-- About Section Start -->
        @include('frondend.components.about')
        <!-- About Section End -->

    <!-- Berita/Penelitian Terbaru Start -->
    @include('frondend.components.beritaPenelitian')
    <!-- Berita/Penelitian Terbaru End -->

    <!-- OPD Terbaru Start -->
   @include('frondend.components.opdTerbaru')
    <!-- OPD Terbaru End -->

    <!-- CTA Section Start -->
   @include('frondend.components.CTA')
    <!-- CTA Section End -->

    <style>

   /* Button hover effect */
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
    </style>
    
@endsection