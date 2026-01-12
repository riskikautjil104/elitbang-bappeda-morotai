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

    
@endsection