<!-- Header Area wrapper Starts -->
<header id="header-wrap">
    <!-- Start Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-8 col-xs-12">
                    <ul class="links clearfix">
                        <li><i class="lni-phone-handset"></i> (021) 1234-5678</li>
                        <li><i class="lni-envelope"></i> litbang@pemerintah.go.id</li>
                        <li><a href="#"><i class="lni-map-marker"></i>Kabupaten Pulau Morotai</a></li>
                    </ul>
                </div>
                <div class="col-lg-5 col-md-4 col-xs-12">
                    <div class="roof-social float-right">
                        <a class="facebook" href="#"><i class="lni-facebook-filled"></i></a>
                        <a class="twitter" href="#"><i class="lni-twitter-filled"></i></a>
                        <a class="instagram" href="#"><i class="lni-instagram-filled"></i></a>
                    </div>
                    <div class="header-top-right float-right">
                        <a href="{{ route('login') }}" class="header-top-button"><i class="lni-lock"></i> Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white" data-toggle="sticky-onscroll">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar"
                    aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="lin-menu"></span>
                </button>
                <a class="navbar-brand" href="{{ route('frontend.home') }}">
                    <img src="{{ asset('assets_frontend/img/logo.png') }}" class="img-fluid" alt=""
                        style="max-height: 120px; margin-top: -10px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="navbar-nav mr-auto w-100 justify-content-center">
                    <li class="nav-item {{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.home') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.opd*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.opd') }}">OPD</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.data*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.data') }}">Data</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.dokumen*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.dokumen') }}">Dokumen Perencanaan</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.laporan-realisasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.laporan-realisasi') }}">Realisasi Anggaran</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.tentang') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.tentang') }}">Tentang</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.kontak') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.kontak') }}">Kontak</a>
                    </li>
                </ul>
            </div>

            <!-- Mobile Menu Start -->
            <ul class="mobile-menu">
                <li>
                    <a class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}"
                        href="{{ route('frontend.home') }}">Beranda</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('frontend.opd*') ? 'active' : '' }}"
                        href="{{ route('frontend.opd') }}">OPD</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('frontend.data*') ? 'active' : '' }}"
                        href="{{ route('frontend.data') }}">Data Penelitian</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('frontend.dokumen*') ? 'active' : '' }}"
                        href="{{ route('frontend.dokumen') }}">Dokumen Perencanaan</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('frontend.laporan-realisasi*') ? 'active' : '' }}"
                        href="{{ route('frontend.laporan-realisasi') }}">Realisasi Anggaran</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('frontend.tentang') ? 'active' : '' }}"
                        href="{{ route('frontend.tentang') }}">Tentang</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('frontend.kontak') ? 'active' : '' }}"
                        href="{{ route('frontend.kontak') }}">Kontak</a>
                </li>
            </ul>
            <!-- Mobile Menu End -->
        </div>
    </nav>
    <!-- Navbar End -->
</header>
<!-- Header Area wrapper End -->
