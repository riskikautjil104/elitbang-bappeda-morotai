<!-- Footer Section Start -->
<footer id="footer" class="footer-area section-padding">
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="footer-titel">E-Litbang</h3>
                    <p>Sistem Elektronik Penelitian dan Pengembangan untuk mendukung pengambilan keputusan berbasis
                        data.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="footer-titel">Link<span> Cepat</span></h3>
                    <ul class="footer-link">
                        <li><a href="{{ route('frontend.home') }}">Beranda</a></li>
                        <li><a href="{{ route('frontend.opd') }}">OPD</a></li>
                        <li><a href="{{ route('frontend.data') }}">Data</a></li>
                        <li><a href="{{ route('frontend.dokumen') }}">Dokumen Perencanaan</a></li>
                        <li><a href="{{ route('frontend.laporan-realisasi') }}">Realisasi Anggaran</a></li>
                        <li><a href="{{ route('frontend.tentang') }}">Tentang</a></li>
                        <li><a href="{{ route('frontend.kontak') }}">Kontak</a></li>
                        <li><a href="{{ route('login') }}" class="text-primary">Login OPD</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" id="kontak">
                    <h3 class="footer-titel">Kontak <span>Info</span></h3>
                    <ul class="address">
                        <li>
                            <a href="#"><i class="lni-map-marker"></i> Kab Pulau Morotai, Maluku Utara</a>
                        </li>
                        <li>
                            <a href="#"><i class="lni-phone-handset"></i> (021) 1234-5678</a>
                        </li>
                        <li>
                            <a href="#"><i class="lni-envelope"></i> litbang@pemerintah.go.id</a>
                        </li>
                    </ul>
                </div>
            </div>
</footer>
<!-- Footer Section End -->

<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Copyright © {{ date('Y') }} E-Litbang. All Rights Reserved</p>
            </div>
        </div>
</section>
