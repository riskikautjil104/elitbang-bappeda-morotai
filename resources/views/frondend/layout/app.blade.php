<!DOCTYPE html>
<html lang="id">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>@yield('title', 'E-Litbang - Sistem Elektronik Litbang')</title>

   {{-- favicon --}}
   <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon/favicon.svg') }}" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}" />
<meta name="apple-mobile-web-app-title" content="morotai" />
<link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}" />
{{-- end favicon --}}

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/bootstrap.min.css') }}">
   <!-- Fonts -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/fonts/line-icons.css') }}">
   <!-- Slicknav -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/slicknav.css') }}">
   <!-- Range Slider -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/ion.rangeSlider.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/ion.rangeSlider.skinFlat.css') }}">
   <!-- Nivo Lightbox -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/nivo-lightbox.css') }}">
   <!-- Animate -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/animate.css') }}">
   <!-- Owl carousel -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/owl.carousel.css') }}">
   <!-- Rav Slider -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/extras/settings.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/extras/layers.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/extras/navigation.css') }}">
   <!-- Main Style -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/main.css') }}">
   <!-- Responsive Style -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets_frontend/css/responsive.css') }}">

   @stack('styles')
</head>

<body>

@include('frondend.layout.header')


   @yield('content')


@include('frondend.layout.footer')

<!-- Go to Top Link -->
<a href="#" class="back-to-top">
   <i class="lni-chevron-up"></i>
</a>

<!-- Preloader -->
<div id="preloader">
   <div class="loader" id="loader-1"></div>

   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{ asset('assets_frontend/js/jquery-min.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/popper.min.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/jquery.mixitup.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/jquery.counterup.min.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/ion.rangeSlider.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/jquery.parallax.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/waypoints.min.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/wow.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/jquery.slicknav.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/nivo-lightbox.js') }}"></script>
   <script src="{{ asset('assets_frontend/js/main.js') }}"></script>

   @stack('scripts')
</body>

</html>