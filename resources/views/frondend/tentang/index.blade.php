@extends('frondend.layout.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<section class="tentang-hero" style="padding: 100px 0 80px; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); position: relative; overflow: hidden;">
    <!-- Wave Background Pattern -->
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
                        <i class="lni-information" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                </div>
                <h1 style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2); animation: fadeInUp 0.8s ease;">
                    Tentang E-Litbang
                </h1>
                <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto; animation: fadeInUp 1s ease;">
                    Sistem Informasi Penelitian dan Pengembangan
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="tentang-content" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        @forelse($tentangs as $index => $tentang)
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
                <div class="tentang-text" style="padding: {{ $tentang->gambar ? '0 30px' : '30px' }};">
                    <h2 style="font-size: 2rem; font-weight: 700; color: #1A5F7A; margin-bottom: 20px; position: relative; display: inline-block;">
                        {{ $tentang->judul }}
                        <span style="position: absolute; bottom: -8px; left: 0; width: 60px; height: 4px; background: linear-gradient(90deg, #159895, #1A5F7A); border-radius: 2px;"></span>
                    </h2>
                    <div class="content-text" style="line-height: 1.8; color: #555; font-size: 1.05rem;">
                        {!! nl2br(e($tentang->konten)) !!}
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
        <hr style="border: 0; height: 1px; background: linear-gradient(90deg, transparent, #ddd, transparent); margin: 50px 0;">
        @endif
        @empty
        <div class="row">
            <div class="col-lg-12 text-center">
                <div style="padding: 80px 20px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 25px; display: flex; align-items: center; justify-content: center; opacity: 0.2;">
                        <i class="lni-inbox" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <h4 style="color: #1A5F7A; font-weight: 600; margin-bottom: 15px;">Informasi Belum Tersedia</h4>
                    <p style="color: #777; font-size: 1.05rem;">Mohon maaf, informasi tentang kami sedang dalam proses pembaruan.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>

<!-- Features Grid (Jika ada data dengan judul "Fitur") -->
@if($tentangs->where('judul', 'like', '%Fitur%')->first())
<section class="features-grid" style="padding: 80px 0; background: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 15px;">
                    Fitur Unggulan
                </h2>
                <p style="font-size: 1.1rem; color: #777;">Kemudahan yang kami tawarkan untuk Anda</p>
            </div>
        </div>
        <div class="row">
            <!-- Feature Card 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card" style="background: white; border-radius: 15px; padding: 35px 25px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(26,95,122,0.3);">
                        <i class="lni-upload" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h5 style="font-size: 1.2rem; font-weight: 600; color: #1A5F7A; margin-bottom: 12px;">Submission Online</h5>
                    <p style="color: #777; font-size: 0.95rem; margin: 0; line-height: 1.6;">Submit laporan dengan mudah secara online</p>
                </div>
            </div>

            <!-- Feature Card 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card" style="background: white; border-radius: 15px; padding: 35px 25px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #159895, #1A5F7A); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(21,152,149,0.3);">
                        <i class="lni-shield" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h5 style="font-size: 1.2rem; font-weight: 600; color: #1A5F7A; margin-bottom: 12px;">Verifikasi Aman</h5>
                    <p style="color: #777; font-size: 0.95rem; margin: 0; line-height: 1.6;">Sistem verifikasi yang aman dan terpercaya</p>
                </div>
            </div>

            <!-- Feature Card 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card" style="background: white; border-radius: 15px; padding: 35px 25px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #1A5F7A, #159895); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(26,95,122,0.3);">
                        <i class="lni-graph" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h5 style="font-size: 1.2rem; font-weight: 600; color: #1A5F7A; margin-bottom: 12px;">Reporting Real-time</h5>
                    <p style="color: #777; font-size: 0.95rem; margin: 0; line-height: 1.6;">Pantau progres laporan secara real-time</p>
                </div>
            </div>

            <!-- Feature Card 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card" style="background: white; border-radius: 15px; padding: 35px 25px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #159895, #1A5F7A); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(21,152,149,0.3);">
                        <i class="lni-database" style="font-size: 1.8rem; color: white;"></i>
                    </div>
                    <h5 style="font-size: 1.2rem; font-weight: 600; color: #1A5F7A; margin-bottom: 12px;">Data Terpusat</h5>
                    <p style="color: #777; font-size: 0.95rem; margin: 0; line-height: 1.6;">Semua data tersimpan dengan aman</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

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

    .tentang-image:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(26,95,122,0.2) !important;
        border-color: #159895 !important;
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

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .tentang-hero {
            padding: 80px 0 60px !important;
        }

        .tentang-hero h1 {
            font-size: 2rem !important;
        }

        .tentang-hero p {
            font-size: 1rem !important;
        }

        .tentang-text {
            padding: 0 !important;
        }

        .tentang-text h2 {
            font-size: 1.5rem !important;
        }

        .content-text {
            font-size: 0.95rem !important;
        }

        .tentang-image img {
            height: 250px !important;
        }

        .feature-card {
            margin-bottom: 20px !important;
        }
    }

    @media (max-width: 576px) {
        .tentang-content {
            padding: 50px 0 !important;
        }

        .features-grid {
            padding: 50px 0 !important;
        }

        .tentang-hero > div:nth-child(3),
        .tentang-hero > div:nth-child(4) {
            display: none;
        }
    }
</style>
@endsection