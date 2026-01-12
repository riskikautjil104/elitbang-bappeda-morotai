<section id="hero-area" class="hero-area section-padding"
    style="padding: 150px 0; background: linear-gradient(rgba(26, 95, 122, 0.85), rgba(21, 152, 149, 0.9)), url('{{ asset('assets_frontend/img/background/banner.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hero-content text-center">
                    <h2 class="hero-title"
                        style="font-size: 3rem; font-weight: 700; color: white; margin-bottom: 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); line-height: 1.2;">
                        <i class="lni-book" style="margin-right: 15px;"></i>
                        <span id="typingTitle"></span>
                        <span class="typing-cursor">|</span>
                    </h2>
                    <p class="hero-desc"
                        style="font-size: 1.3rem; color: rgba(255,255,255,0.95); margin-bottom: 35px; max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.6; opacity: 0;"
                        id="heroDesc">
                        Platform resmi untuk pengelolaan laporan penelitian, pengembangan dan inovasi Kabupaten Pulau Morotai
                    </p>
                    <div class="hero-btn" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; opacity: 0;" id="heroButtons">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg"
                            style="padding: 15px 35px; font-weight: 600; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                            <i class="lni-lock" style="margin-right: 8px;"></i> Login OPD
                        </a>
                        <a href="{{ route('frontend.tentang') }}" class="btn btn-outline-light btn-lg"
                            style="padding: 15px 35px; font-weight: 600; border-radius: 50px; border: 2px solid white; color: white; transition: all 0.3s ease;">
                            <i class="lni-information" style="margin-right: 8px;"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .typing-cursor {
        display: inline-block;
        animation: blink 0.7s infinite;
        font-weight: 400;
        margin-left: 3px;
    }

    @keyframes blink {
        0%, 50% {
            opacity: 1;
        }
        51%, 100% {
            opacity: 0;
        }
    }

    .hero-btn a:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3) !important;
    }

    .btn-outline-light:hover {
        background: white !important;
        color: #1A5F7A !important;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem !important;
        }
        
        .hero-desc {
            font-size: 1.1rem !important;
        }
        
        .hero-btn a {
            padding: 12px 25px !important;
            font-size: 0.95rem !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Text yang akan diketik
    const titleText = "Sistem Elektronik Litbang";
    const titleElement = document.getElementById('typingTitle');
    const descElement = document.getElementById('heroDesc');
    const buttonsElement = document.getElementById('heroButtons');
    const cursor = document.querySelector('.typing-cursor');
    
    let titleIndex = 0;
    
    // Typing effect untuk title
    function typeTitle() {
        if (titleIndex < titleText.length) {
            titleElement.textContent += titleText.charAt(titleIndex);
            titleIndex++;
            setTimeout(typeTitle, 80); // Kecepatan mengetik (ms per karakter)
        } else {
            // Setelah title selesai, sembunyikan cursor dan tampilkan deskripsi
            setTimeout(() => {
                cursor.style.display = 'none';
                showDescription();
            }, 500);
        }
    }
    
    // Fade in description
    function showDescription() {
        descElement.style.transition = 'opacity 0.8s ease-in-out';
        descElement.style.opacity = '1';
        
        // Setelah deskripsi muncul, tampilkan tombol
        setTimeout(showButtons, 600);
    }
    
    // Fade in buttons
    function showButtons() {
        buttonsElement.style.transition = 'opacity 0.8s ease-in-out';
        buttonsElement.style.opacity = '1';
    }
    
    // Mulai animasi setelah 300ms
    setTimeout(typeTitle, 300);
});
</script>