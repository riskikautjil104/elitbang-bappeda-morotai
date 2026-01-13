<!-- OPD Terbaru Start -->
<section id="opd-terbaru" class="section-padding bg-gray" style="padding: 80px 0; background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title-header text-center" style="margin-bottom: 50px;">
                    <h2 class="section-title"
                        style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 15px; line-height: 1.2;">
                        OPD Terbaru
                    </h2>
                    <p style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                        Organisasi Perangkat Daerah yang baru ditambahkan
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($opdTerbaru as $opd)
                <div class="col-lg-4 col-md-6 col-xs-12 mb-4">
                    <div class="opd-card"
                        style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.3s ease; height: 100%; background: white;">

                        <!-- Header with Icon -->
                        <div
                            style="padding: 30px; text-align: center; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%);">
                            <div
                                style="width: 70px; height: 70px; background: rgba(255,255,255,0.25); border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.3);">
                                <i class="lni-apartment" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h3 style="font-size: 1.2rem; font-weight: 600; color: white; margin: 0; line-height: 1.4;">
                                {{ $opd->nama_opd ?? $opd->name }}
                            </h3>
                        </div>

                        <!-- Body -->
                        <div style="padding: 25px;">
                            <!-- Info -->
                            <div style="margin-bottom: 20px;">
                                <div
                                    style="display: flex; align-items: center; margin-bottom: 12px; color: #333; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <i class="lni-user"
                                        style="font-size: 1.1rem; margin-right: 10px; color: #1A5F7A;"></i>
                                    <span style="font-size: 0.95rem; font-weight: 500;">{{ $opd->name }}</span>
                                </div>
                                <div
                                    style="display: flex; align-items: center; color: #333; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <i class="lni-envelope"
                                        style="font-size: 1.1rem; margin-right: 10px; color: #1A5F7A;"></i>
                                    <span
                                        style="font-size: 0.9rem; font-weight: 500; word-break: break-all;">{{ $opd->email }}</span>
                                </div>
                            </div>

                            <!-- View Detail Button -->
                            <a href="{{ route('frontend.opd') }}" class="btn btn-primary w-100"
                                style="padding: 12px; font-weight: 600; border-radius: 8px; background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%); border: none;">
                                <i class="lni-eye" style="margin-right: 8px;"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div style="padding: 60px 20px;">
                        <i class="lni-apartment"
                            style="font-size: 5rem; color: #ddd; display: block; margin-bottom: 20px;"></i>
                        <p class="text-muted" style="font-size: 1.1rem; color: #999;">
                            Belum ada data OPD yang tersedia.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>

        <div class="row" style="margin-top: 40px;">
            <div class="col-12 text-center">
                <a href="{{ route('frontend.opd') }}" class="btn btn-outline-primary btn-lg"
                    style="padding: 15px 40px; font-weight: 600; border-radius: 50px; border: 2px solid #1A5F7A; color: #1A5F7A; transition: all 0.3s ease;">
                    Lihat Semua OPD <i class="lni-arrow-right" style="margin-left: 8px;"></i>
                </a>
            </div>
        </div>
    </div>

    <style>
        .opd-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%);
            color: white !important;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.8rem !important;
            }

            .opd-card h3 {
                font-size: 1.1rem !important;
            }
        }

        @media (max-width: 576px) {
            section#opd-terbaru {
                padding: 50px 0 !important;
            }

            .section-title-header {
                margin-bottom: 30px !important;
            }
        }
    </style>
</section>
<!-- OPD Terbaru End -->
