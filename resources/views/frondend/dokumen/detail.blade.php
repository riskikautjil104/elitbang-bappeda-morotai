@extends('frondend.layout.app')

@section('title', $dokumen->judul)

@section('content')
<!-- Breadcrumb -->
<section style="padding: 30px 0; background: #f8f9fa;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: transparent; padding: 0; margin: 0;">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" style="color: #159895; text-decoration: none;">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.dokumen') }}" style="color: #159895; text-decoration: none;">Dokumen Perencanaan</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #666;">{{ Str::limit($dokumen->judul, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Content Section -->
<section style="padding: 60px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <!-- Document Header -->
                <div style="background: white; border-radius: 15px; padding: 40px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <!-- Badges -->
                    <div style="margin-bottom: 20px;">
                        <span style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, #1A5F7A, #159895); color: white; border-radius: 25px; font-size: 14px; font-weight: 600; margin-right: 10px;">
                            <i class="lni-tag"></i> {{ $dokumen->jenis }}
                        </span>
                        <span style="display: inline-block; padding: 8px 20px; background: #f0f0f0; color: #555; border-radius: 25px; font-size: 14px; font-weight: 600;">
                            <i class="lni-calendar"></i> {{ $dokumen->tahun }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: #1A5F7A; margin-bottom: 20px; line-height: 1.3;">
                        {{ $dokumen->judul }}
                    </h1>

                    <!-- Meta Info -->
                    <div style="padding: 20px; background: #f8f9fa; border-radius: 10px; margin-bottom: 30px;">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="lni-user" style="font-size: 20px; color: #159895;"></i>
                                    <div>
                                        <small style="color: #999; display: block; font-size: 12px;">Diupload Oleh</small>
                                        <strong style="color: #555;">{{ $dokumen->uploader->name }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="lni-calendar" style="font-size: 20px; color: #159895;"></i>
                                    <div>
                                        <small style="color: #999; display: block; font-size: 12px;">Tanggal Publish</small>
                                        <strong style="color: #555;">{{ $dokumen->published_at->format('d M Y, H:i') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($dokumen->deskripsi)
                    <div style="margin-bottom: 30px;">
                        <h4 style="font-size: 1.3rem; font-weight: 600; color: #1A5F7A; margin-bottom: 15px;">
                            <i class="lni-write"></i> Deskripsi Dokumen
                        </h4>
                        <p style="color: #666; line-height: 1.8; white-space: pre-wrap;">{{ $dokumen->deskripsi }}</p>
                    </div>
                    @endif

                    <!-- Download Button -->
                    <a href="{{ route('frontend.dokumen.download', $dokumen->id) }}" class="btn btn-lg btn-block" style="background: linear-gradient(135deg, #1A5F7A, #159895); color: white; border: none; border-radius: 10px; padding: 15px 30px; font-weight: 600; text-decoration: none; display: inline-block; transition: all 0.3s ease; text-align: center;">
                        <i class="lni-download"></i> Download Dokumen ({{ $dokumen->getFileSizeFormatted() }})
                    </a>
                </div>

                <!-- PDF Preview -->
                @if(Str::endsWith($dokumen->file_path, '.pdf'))
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <div style="padding: 20px; background: linear-gradient(135deg, #1A5F7A, #159895);">
                        <h4 style="color: white; margin: 0; font-weight: 600;">
                            <i class="lni-eye"></i> Preview Dokumen
                        </h4>
                    </div>
                    <div style="padding: 20px;">
                        <iframe src="{{ asset('storage/' . $dokumen->file_path) }}" 
                                width="100%" 
                                height="800px" 
                                style="border: 2px solid #e0e0e0; border-radius: 10px;">
                        </iframe>
                    </div>
                </div>
                @else
                <div style="background: white; border-radius: 15px; padding: 40px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <i class="lni-files" style="font-size: 4rem; color: #159895; opacity: 0.3; margin-bottom: 20px; display: block;"></i>
                    <h5 style="color: #1A5F7A; margin-bottom: 15px;">Preview Tidak Tersedia</h5>
                    <p style="color: #777; margin-bottom: 25px;">File ini tidak dapat ditampilkan dalam preview. Silakan download untuk melihat isinya.</p>
                    <a href="{{ route('frontend.dokumen.download', $dokumen->id) }}" class="btn" style="background: linear-gradient(135deg, #1A5F7A, #159895); color: white; border: none; border-radius: 10px; padding: 12px 30px; font-weight: 600; text-decoration: none; display: inline-block;">
                        <i class="lni-download"></i> Download Sekarang
                    </a>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- File Info Card -->
                <div style="background: white; border-radius: 15px; padding: 30px; margin-bottom: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <h5 style="color: #1A5F7A; font-weight: 600; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0;">
                        <i class="lni-information"></i> Informasi File
                    </h5>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="color: #999; font-size: 13px; display: block; margin-bottom: 5px;">Nama File</label>
                        <p style="color: #555; font-weight: 600; word-break: break-all; margin: 0;">{{ $dokumen->file_name }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="color: #999; font-size: 13px; display: block; margin-bottom: 5px;">Ukuran File</label>
                        <p style="color: #555; font-weight: 600; margin: 0;">
                            <i class="lni-archive" style="color: #159895;"></i> {{ $dokumen->getFileSizeFormatted() }}
                        </p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="color: #999; font-size: 13px; display: block; margin-bottom: 5px;">Format File</label>
                        <p style="color: #555; font-weight: 600; margin: 0; text-transform: uppercase;">
                            <i class="lni-files" style="color: #159895;"></i> {{ pathinfo($dokumen->file_name, PATHINFO_EXTENSION) }}
                        </p>
                    </div>

                    <div style="margin-bottom: 0;">
                        <label style="color: #999; font-size: 13px; display: block; margin-bottom: 5px;">Status</label>
                        <span style="display: inline-block; padding: 6px 15px; background: linear-gradient(135deg, rgba(34,197,94,0.1), rgba(21,128,61,0.1)); color: #16a34a; border-radius: 20px; font-size: 13px; font-weight: 600;">
                            <i class="lni-checkmark-circle"></i> Published
                        </span>
                    </div>
                </div>

                <!-- Share Card -->
                <div style="background: white; border-radius: 15px; padding: 30px; margin-bottom: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <h5 style="color: #1A5F7A; font-weight: 600; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0;">
                        <i class="lni-share"></i> Bagikan Dokumen
                    </h5>
                    
                    <div style="display: grid; gap: 10px;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('frontend.dokumen.detail', $dokumen->id)) }}" 
                           target="_blank"
                           style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #1877f2; color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s ease;">
                            <i class="lni-facebook-filled"></i>
                            <span>Bagikan ke Facebook</span>
                        </a>
                        
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('frontend.dokumen.detail', $dokumen->id)) }}&text={{ urlencode($dokumen->judul) }}" 
                           target="_blank"
                           style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #1da1f2; color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s ease;">
                            <i class="lni-twitter-filled"></i>
                            <span>Bagikan ke Twitter</span>
                        </a>
                        
                        <a href="https://wa.me/?text={{ urlencode($dokumen->judul . ' - ' . route('frontend.dokumen.detail', $dokumen->id)) }}" 
                           target="_blank"
                           style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #25d366; color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s ease;">
                            <i class="lni-whatsapp"></i>
                            <span>Bagikan via WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Back Button -->
                <a href="{{ route('frontend.dokumen') }}" style="display: block; text-align: center; padding: 15px; background: white; color: #1A5F7A; border: 2px solid #1A5F7A; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                    <i class="lni-arrow-left"></i> Kembali ke Daftar Dokumen
                </a>
            </div>
        </div>

        <!-- Related Documents -->
        @if($dokumenTerkait->count() > 0)
        <div class="row" style="margin-top: 60px;">
            <div class="col-lg-12">
                <h3 style="color: #1A5F7A; font-weight: 700; margin-bottom: 30px; text-align: center;">
                    Dokumen Terkait
                </h3>
            </div>
            @foreach($dokumenTerkait as $terkait)
            <div class="col-lg-4 mb-4">
                <div style="background: white; border-radius: 15px; padding: 30px; height: 100%; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                    <span style="display: inline-block; padding: 6px 15px; background: linear-gradient(135deg, rgba(26,95,122,0.1), rgba(21,152,149,0.1)); color: #1A5F7A; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 15px;">
                        {{ $terkait->jenis }}
                    </span>
                    <h5 style="color: #1A5F7A; font-weight: 600; margin-bottom: 15px; min-height: 60px;">
                        {{ Str::limit($terkait->judul, 80) }}
                    </h5>
                    <p style="color: #777; font-size: 14px; margin-bottom: 20px;">
                        <i class="lni-calendar"></i> {{ $terkait->published_at->format('d M Y') }} • 
                        <i class="lni-archive"></i> {{ $terkait->getFileSizeFormatted() }}
                    </p>
                    <a href="{{ route('frontend.dokumen.detail', $terkait->id) }}" style="display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, #1A5F7A, #159895); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                        Lihat Detail <i class="lni-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<style>
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(26, 95, 122, 0.3);
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 1.8rem !important;
        }

        iframe {
            height: 500px !important;
        }
    }
</style>
@endsection