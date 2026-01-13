@extends('frondend.layout.app')

@section('title', 'Kontak Kami')

@section('content')
<!-- Hero Section -->
<section class="kontak-hero" style="padding: 100px 0 80px; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); position: relative; overflow: hidden;">
    <!-- Wave Background -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.15;">
        <svg style="position: absolute; bottom: 0; width: 100%; height: 200px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C300,60 600,60 900,0 L900,120 L0,120 Z" fill="rgba(255,255,255,0.1)"/>
        </svg>
        <svg style="position: absolute; bottom: 0; width: 100%; height: 240px;" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,20 C400,80 800,80 1200,20 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.05)"/>
        </svg>
    </div>
    
    <!-- Pattern Dots -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.08; background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
    
    <!-- Floating Elements -->
    <div style="position: absolute; top: 10%; left: 5%; width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.05); animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; top: 60%; right: 8%; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.05); animation: float 8s ease-in-out infinite;"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div style="margin-bottom: 25px; animation: bounceIn 1s ease;">
                    <div style="width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 3px solid rgba(255,255,255,0.3); margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                        <i class="lni-phone" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                </div>
                <h1 style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2); animation: fadeInUp 0.8s ease;">
                    Hubungi Kami
                </h1>
                <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto; animation: fadeInUp 1s ease;">
                    Kami siap membantu dan menjawab pertanyaan Anda
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Cards Section -->
<section class="kontak-content" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        @if($kontaks->count() > 0)
        <div class="row">
            @foreach($kontaks as $index => $kontak)
            <div class="col-lg-4 col-md-6 mb-4" style="animation: fadeInUp 0.6s ease; animation-delay: {{ $index * 0.1 }}s;">
                <div class="kontak-card" style="background: white; border-radius: 15px; padding: 40px 30px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent; height: 100%;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 25px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(26,95,122,0.3);">
                        <i class="{{ $kontak->icon ?? 'ti ti-mail' }}" style="font-size: 2rem; color: white;"></i>
                    </div>
                    
                    <h5 style="font-size: 1.3rem; font-weight: 600; color: #1A5F7A; margin-bottom: 8px;">
                        {{ $kontak->nama }}
                    </h5>
                    
                    <span style="display: inline-block; padding: 5px 15px; background: linear-gradient(135deg, rgba(26,95,122,0.1), rgba(21,152,149,0.1)); color: #159895; border-radius: 20px; font-size: 0.85rem; font-weight: 500; margin-bottom: 20px;">
                        {{ $kontak->label }}
                    </span>
                    
                    <div style="padding: 20px; background: #f8f9fa; border-radius: 10px; margin-top: 20px;">
                        @if(Str::contains($kontak->label, ['Email', 'email', 'E-mail']))
                            <a href="mailto:{{ $kontak->nilai }}" style="color: #555; text-decoration: none; word-break: break-all; display: block; transition: color 0.3s;">
                                {{ $kontak->nilai }}
                            </a>
                        @elseif(Str::contains($kontak->label, ['Telepon', 'Phone', 'HP', 'WhatsApp', 'WA']))
                            <a href="tel:{{ $kontak->nilai }}" style="color: #555; text-decoration: none; display: block; transition: color 0.3s;">
                                {{ $kontak->nilai }}
                            </a>
                        @else
                            <p style="color: #555; margin: 0; line-height: 1.6;">
                                {{ $kontak->nilai }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-lg-12 text-center">
                <div style="padding: 80px 20px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 25px; display: flex; align-items: center; justify-content: center; opacity: 0.2;">
                        <i class="lni-inbox" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <h4 style="color: #1A5F7A; font-weight: 600; margin-bottom: 15px;">Informasi Kontak Belum Tersedia</h4>
                    <p style="color: #777; font-size: 1.05rem;">Mohon maaf, informasi kontak sedang dalam proses pembaruan.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Map Section (Optional) -->
<section class="map-section" style="padding: 0; background: white;">
    <div class="container-fluid p-0">
        <div style="position: relative; overflow: hidden; border-radius: 0;">
            <!-- Ganti dengan embed Google Maps atau peta lainnya -->
            <div style="width: 100%; height: 450px; background: linear-gradient(135deg, rgba(26,95,122,0.1), rgba(21,152,149,0.1)); display: flex; align-items: center; justify-content: center;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.2426604632133!2d128.31560317599735!3d2.0588688979226624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3290bd0042309aef%3A0x3515404f70405c66!2sBAPPEDA%20PULAU%20MOROTAI!5e0!3m2!1sid!2sid!4v1768249416205!5m2!1sid!2sid" width="80%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-radius: 20%;"></iframe>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="padding: 60px 0; background: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="background: linear-gradient(135deg, #1A5F7A, #159895); border-radius: 20px; padding: 50px 40px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                    <h3 style="color: white; font-size: 2rem; font-weight: 700; margin-bottom: 15px;">
                        Punya Pertanyaan?
                    </h3>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
                        Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach($kontaks->take(2) as $kontak)
                        @if(Str::contains($kontak->label, ['Email', 'email']))
                        <a href="mailto:{{ $kontak->nilai }}" class="btn-cta" style="display: inline-flex; align-items: center; gap: 10px; background: white; color: #1A5F7A; padding: 15px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <i class="{{ $kontak->icon ?? 'ti ti-mail' }}" style="font-size: 1.3rem;"></i>
                            <span>Kirim Email</span>
                        </a>
                        @elseif(Str::contains($kontak->label, ['Telepon', 'Phone', 'HP', 'WhatsApp', 'WA']))
                        <a href="tel:{{ $kontak->nilai }}" class="btn-cta" style="display: inline-flex; align-items: center; gap: 10px; background: white; color: #1A5F7A; padding: 15px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <i class="{{ $kontak->icon ?? 'ti ti-phone' }}" style="font-size: 1.3rem;"></i>
                            <span>Hubungi Sekarang</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

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

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
        }
    }

    .kontak-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(26,95,122,0.2) !important;
        border-color: #159895 !important;
    }

    .kontak-card a:hover {
        color: #1A5F7A !important;
        font-weight: 600;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .kontak-hero {
            padding: 80px 0 60px !important;
        }

        .kontak-hero h1 {
            font-size: 2rem !important;
        }

        .kontak-hero p {
            font-size: 1rem !important;
        }

        .kontak-card {
            padding: 30px 20px !important;
        }

        .cta-section h3 {
            font-size: 1.5rem !important;
        }

        .cta-section p {
            font-size: 1rem !important;
        }

        .btn-cta {
            padding: 12px 25px !important;
            font-size: 0.95rem !important;
        }
    }

    @media (max-width: 576px) {
        .kontak-content {
            padding: 50px 0 !important;
        }

        .cta-section {
            padding: 40px 0 !important;
        }

        .cta-section > .container > .row > .col-lg-12 > div {
            padding: 40px 25px !important;
        }

        .kontak-hero > div:nth-child(3),
        .kontak-hero > div:nth-child(4) {
            display: none;
        }
    }
</style>
@endsection