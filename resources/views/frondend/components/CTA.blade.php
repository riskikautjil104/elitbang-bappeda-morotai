<!-- CTA Section Start -->
<section class="cta-section section-padding" 
    style="padding: 80px 0; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); position: relative; overflow: hidden;">
    
    <!-- Wave Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.25;">
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
    
    <!-- Floating Elements Decoration -->
    <div style="position: absolute; top: 10%; left: 5%; width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.05); animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; top: 60%; right: 8%; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.05); animation: float 8s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: 15%; left: 12%; width: 60px; height: 60px; border-radius: 50%; background: rgba(255,255,255,0.05); animation: float 7s ease-in-out infinite;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Icon/Badge -->
                <div style="margin-bottom: 30px; animation: bounceIn 1s ease;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 3px solid rgba(255,255,255,0.3); margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                        <i class="lni-rocket" style="font-size: 3rem; color: white;"></i>
                    </div>
                </div>

                <h2 class="cta-title" 
                    style="font-size: 2.5rem; font-weight: 700; color: white; margin-bottom: 20px; text-shadow: 0 2px 10px rgba(0,0,0,0.2); animation: fadeInUp 0.8s ease;">
                    Siap Memulai?
                </h2>
                <p class="cta-desc" 
                    style="font-size: 1.2rem; color: rgba(255,255,255,0.95); margin-bottom: 35px; max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.6; font-weight: 400; animation: fadeInUp 1s ease;">
                    Login sekarang untuk mengakses sistem E-Litbang dan mulai submit laporan penelitian dan pengembangan Anda.
                </p>
                <a href="{{ route('login') }}" class="btn btn-light btn-lg cta-button" 
                    style="padding: 15px 45px; font-weight: 600; border-radius: 50px; box-shadow: 0 4px 20px rgba(0,0,0,0.25); color: #1A5F7A; transition: all 0.3s ease; display: inline-flex; align-items: center; animation: fadeInUp 1.2s ease;">
                    <i class="lni-lock" style="margin-right: 8px; font-size: 1.2rem;"></i> Login Sekarang
                </a>
            </div>
        </div>
    </div>

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

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            background-color: #f8f9fa !important;
        }

        .cta-button:active {
            transform: translateY(-1px);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .cta-section {
                padding: 60px 0 !important;
            }

            .cta-title {
                font-size: 2rem !important;
            }

            .cta-desc {
                font-size: 1rem !important;
                padding: 0 15px;
            }

            .cta-button {
                padding: 12px 35px !important;
                font-size: 0.95rem;
            }

            .cta-section > div:nth-child(1) > svg {
                height: 150px !important;
            }

            .cta-section > div:first-child > div {
                width: 70px !important;
                height: 70px !important;
            }

            .cta-section > div:first-child > div i {
                font-size: 2rem !important;
            }
        }

        @media (max-width: 576px) {
            .cta-section {
                padding: 50px 0 !important;
            }

            .cta-title {
                font-size: 1.75rem !important;
                margin-bottom: 15px !important;
            }

            .cta-desc {
                font-size: 0.95rem !important;
                margin-bottom: 25px !important;
            }

            /* Hide floating elements on small screens */
            .cta-section > div:nth-child(3),
            .cta-section > div:nth-child(4),
            .cta-section > div:nth-child(5) {
                display: none;
            }
        }
    </style>
</section>
<!-- CTA Section End -->