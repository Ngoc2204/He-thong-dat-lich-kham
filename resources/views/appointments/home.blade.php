@extends('layouts.app')

@section('content')
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <div class="swiper-slide"
                style="background-image:url('{{ asset('images/banner1.jpg') }}'); background-size:cover; background-position:center; height:100vh;">
                <div class="slide-content d-flex flex-column align-items-center justify-content-center h-100 text-white text-center position-relative"
                    style="background: linear-gradient(135deg, rgba(0,123,255,0.7) 0%, rgba(0,68,141,0.8) 100%);">
                    <div class="container" style="z-index: 2;">
                        <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 4px 8px rgba(0,0,0,0.3); letter-spacing: -1px;">
                            Chăm sóc nụ cười của bạn
                        </h1>
                        <p class="lead fs-4 mb-4" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.3); max-width: 600px; margin: 0 auto;">
                            Đặt lịch khám nha khoa nhanh chóng & tiện lợi
                        </p>
                        <a href="{{ route('appointments.create') }}" 
                           class="btn btn-lg btn-light px-5 py-3 mt-3 rounded-pill shadow-lg"
                           style="font-weight: 600; transition: all 0.3s ease; border: 2px solid white;">
                            <i class="fas fa-calendar-check me-2"></i>Đặt lịch ngay
                        </a>
                    </div>
                    <!-- Decorative elements -->
                    <div class="position-absolute" style="bottom: 0; left: 0; right: 0; height: 150px; background: linear-gradient(to top, rgba(255,255,255,0.1), transparent);"></div>
                </div>
            </div>

            <div class="swiper-slide"
                style="background-image:url('{{ asset('images/banner2.jpg') }}'); background-size:cover; background-position:center; height:100vh;">
                <div class="slide-content d-flex flex-column align-items-center justify-content-center h-100 text-white text-center position-relative"
                    style="background: linear-gradient(135deg, rgba(16,185,129,0.75) 0%, rgba(5,150,105,0.85) 100%);">
                    <div class="container" style="z-index: 2;">
                        <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 4px 8px rgba(0,0,0,0.3); letter-spacing: -1px;">
                            Dịch vụ nha khoa hiện đại
                        </h1>
                        <p class="lead fs-4 mb-4" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.3); max-width: 600px; margin: 0 auto;">
                            Đội ngũ bác sĩ giàu kinh nghiệm & tận tâm
                        </p>
                        <a href="#services" 
                           class="btn btn-lg btn-light px-5 py-3 mt-3 rounded-pill shadow-lg"
                           style="font-weight: 600; transition: all 0.3s ease; border: 2px solid white;">
                            <i class="fas fa-tooth me-2"></i>Xem dịch vụ
                        </a>
                    </div>
                    <!-- Decorative elements -->
                    <div class="position-absolute" style="bottom: 0; left: 0; right: 0; height: 150px; background: linear-gradient(to top, rgba(255,255,255,0.1), transparent);"></div>
                </div>
            </div>

            <div class="swiper-slide"
                style="background-image:url('{{ asset('images/banner3.jpg') }}'); background-size:cover; background-position:center; height:100vh;">
                <div class="slide-content d-flex flex-column align-items-center justify-content-center h-100 text-white text-center position-relative"
                    style="background: linear-gradient(135deg, rgba(236,72,153,0.75) 0%, rgba(190,24,93,0.85) 100%);">
                    <div class="container" style="z-index: 2;">
                        <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 4px 8px rgba(0,0,0,0.3); letter-spacing: -1px;">
                            Công nghệ tiên tiến nhất
                        </h1>
                        <p class="lead fs-4 mb-4" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.3); max-width: 600px; margin: 0 auto;">
                            Thiết bị hiện đại, quy trình khoa học
                        </p>
                        <a href="#contact" 
                           class="btn btn-lg btn-light px-5 py-3 mt-3 rounded-pill shadow-lg"
                           style="font-weight: 600; transition: all 0.3s ease; border: 2px solid white;">
                            <i class="fas fa-phone-alt me-2"></i>Liên hệ ngay
                        </a>
                    </div>
                    <!-- Decorative elements -->
                    <div class="position-absolute" style="bottom: 0; left: 0; right: 0; height: 150px; background: linear-gradient(to top, rgba(255,255,255,0.1), transparent);"></div>
                </div>
            </div>

        </div>

        <!-- Custom Pagination -->
        <div class="swiper-pagination"></div>
        
        <!-- Custom Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <style>
        /* Remove default body padding/margin if needed */
        body {
            margin: 0;
            padding: 0;
        }
        
        /* Make swiper full height */
        .swiper {
            width: 100%;
            height: 100vh;
        }
        
        /* Swiper Custom Styles */
        .swiper-pagination {
            bottom: 30px !important;
        }
        
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: white;
            opacity: 0.6;
            transition: all 0.3s ease;
        }
        
        .swiper-pagination-bullet-active {
            opacity: 1;
            width: 40px;
            border-radius: 6px;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }
        
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px;
            color: white;
            font-weight: bold;
        }
        
        /* Button Hover Effects */
        .btn-light:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3) !important;
            background: white !important;
        }
        
        /* Smooth Animations */
        .slide-content h1,
        .slide-content p,
        .slide-content a {
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }
        
        .slide-content p {
            animation-delay: 0.2s;
        }
        
        .slide-content a {
            animation-delay: 0.4s;
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
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .swiper-slide {
                height: 100vh !important;
            }
            
            .display-3 {
                font-size: 2.5rem !important;
            }
            
            .lead {
                font-size: 1.1rem !important;
            }
            
            .btn-lg {
                padding: 0.75rem 2rem !important;
            }
            
            .swiper-pagination {
                bottom: 20px !important;
            }
        }
    </style>

    <script>
        // Initialize Swiper when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".mySwiper", {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 1000,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>
@endsection