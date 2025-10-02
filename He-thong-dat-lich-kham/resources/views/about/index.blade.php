@extends('layouts.app')

@section('title', 'Giới Thiệu - MediBook')

@section('content')
    <!-- Hero Section với Animation -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-indigo-300 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="container mx-auto text-center px-6 relative z-10">
            <div class="inline-block mb-4 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                🏥 Hệ thống đặt lịch khám nha khoa hàng đầu
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                Về <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">MediBook</span>
            </h1>
            <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto leading-relaxed">
                Giải pháp đặt lịch khám nha khoa trực tuyến nhanh chóng, tiện lợi và hiện đại nhất Việt Nam
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <div class="text-center">
                    <div class="text-4xl font-bold">10K+</div>
                    <div class="text-sm opacity-80">Bệnh nhân tin tùy</div>
                </div>
                <div class="w-px bg-white/30"></div>
                <div class="text-center">
                    <div class="text-4xl font-bold">500+</div>
                    <div class="text-sm opacity-80">Bác sĩ chuyên nghiệp</div>
                </div>
                <div class="w-px bg-white/30"></div>
                <div class="text-center">
                    <div class="text-4xl font-bold">50+</div>
                    <div class="text-sm opacity-80">Phòng khám đối tác</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="order-2 md:order-1">
                    <div class="relative">
                        <img src="{{ asset('images/thumb_MBEM.jpg') }}" alt="MediBook Story" class="rounded-2xl shadow-2xl">
                        <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-blue-600 rounded-2xl opacity-20 -z-10"></div>
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-indigo-600 rounded-full opacity-20 -z-10"></div>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <div class="inline-block mb-4 px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                        ✨ Câu chuyện của chúng tôi
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Sứ mệnh của MediBook</h2>
                    <p class="text-gray-600 leading-relaxed mb-6 text-lg">
                        MediBook ra đời từ mong muốn giải quyết những khó khăn mà bệnh nhân thường gặp phải khi đặt lịch khám nha khoa: 
                        phải gọi điện nhiều lần, chờ đợi lâu, hoặc không tìm được bác sĩ phù hợp.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-6 text-lg">
                        Chúng tôi tin rằng việc chăm sóc sức khỏe răng miệng cần được đơn giản hóa và hiện đại hóa. 
                        Với công nghệ tiên tiến và giao diện thân thiện, MediBook giúp kết nối bệnh nhân với bác sĩ nha khoa 
                        một cách nhanh chóng, minh bạch và hiệu quả nhất.
                    </p>
                    <div class="flex items-start gap-4 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 italic font-medium">
                                "Sức khỏe răng miệng là nền tảng cho nụ cười rạng rỡ và sự tự tin trong cuộc sống. 
                                Chúng tôi cam kết mang đến trải nghiệm đặt lịch khám tốt nhất cho mọi người."
                            </p>
                            <p class="text-blue-600 font-semibold mt-3">— Đội ngũ MediBook</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values với Design hiện đại -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-block mb-4 px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                    💎 Giá trị cốt lõi
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Những gì chúng tôi mang đến</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    MediBook được xây dựng dựa trên những giá trị cốt lõi để phục vụ bạn tốt nhất
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Value Card 1 -->
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-indigo-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-md text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Chuyên nghiệp</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Đội ngũ bác sĩ nha khoa uy tín với chứng chỉ hành nghề đầy đủ, giàu kinh nghiệm và tận tâm với bệnh nhân.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-600"></i>
                                <span>Bác sĩ được xác minh kỹ lưỡng</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-600"></i>
                                <span>Đánh giá minh bạch từ bệnh nhân</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Value Card 2 -->
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-indigo-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 to-purple-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tiện lợi</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Đặt lịch khám chỉ trong 3 phút, quản lý lịch hẹn dễ dàng mọi lúc, mọi nơi qua web hoặc mobile.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-indigo-600"></i>
                                <span>Đặt lịch 24/7 không cần gọi điện</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-indigo-600"></i>
                                <span>Nhận thông báo nhắc lịch tự động</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Value Card 3 -->
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-600/5 to-emerald-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-green-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Bảo mật</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Thông tin cá nhân và hồ sơ bệnh án của bạn được mã hóa và bảo vệ theo tiêu chuẩn quốc tế.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span>Mã hóa SSL/TLS 256-bit</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span>Tuân thủ quy định bảo mật y tế</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quy trình làm việc -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-block mb-4 px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold">
                    🚀 Quy trình đơn giản
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Đặt lịch chỉ với 4 bước</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Trải nghiệm đặt lịch khám nhanh chóng và dễ dàng như chưa từng có
                </p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg">
                                1
                            </div>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 -z-10"></div>
                        </div>
                        <div class="bg-blue-50 rounded-xl p-6">
                            <i class="fas fa-search text-blue-600 text-3xl mb-3"></i>
                            <h3 class="font-bold text-gray-900 mb-2">Tìm kiếm</h3>
                            <p class="text-sm text-gray-600">Chọn bác sĩ hoặc phòng khám phù hợp</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg">
                                2
                            </div>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 -z-10"></div>
                        </div>
                        <div class="bg-indigo-50 rounded-xl p-6">
                            <i class="fas fa-calendar-alt text-indigo-600 text-3xl mb-3"></i>
                            <h3 class="font-bold text-gray-900 mb-2">Chọn lịch</h3>
                            <p class="text-sm text-gray-600">Xem lịch trống và chọn giờ khám</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-purple-700 rounded-full flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg">
                                3
                            </div>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-gradient-to-r from-purple-600 to-pink-600 -z-10"></div>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-6">
                            <i class="fas fa-clipboard-list text-purple-600 text-3xl mb-3"></i>
                            <h3 class="font-bold text-gray-900 mb-2">Điền thông tin</h3>
                            <p class="text-sm text-gray-600">Nhập thông tin cá nhân và triệu chứng</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-green-600 to-green-700 rounded-full flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg">
                                4
                            </div>
                        </div>
                        <div class="bg-green-50 rounded-xl p-6">
                            <i class="fas fa-check-circle text-green-600 text-3xl mb-3"></i>
                            <h3 class="font-bold text-gray-900 mb-2">Xác nhận</h3>
                            <p class="text-sm text-gray-600">Nhận xác nhận qua email & SMS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-block mb-4 px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                    ⭐ Đánh giá từ khách hàng
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Họ nói gì về chúng tôi</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic leading-relaxed">
                        "Đặt lịch khám cực kỳ nhanh và tiện lợi. Tôi không cần phải gọi điện hay chờ đợi nữa. 
                        Giao diện rất dễ sử dụng!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            NH
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Nguyễn Hồng</div>
                            <div class="text-sm text-gray-500">Bệnh nhân tại Hà Nội</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic leading-relaxed">
                        "MediBook giúp phòng khám của tôi quản lý lịch hẹn hiệu quả hơn rất nhiều. 
                        Giảm thiểu tình trạng nhầm lẫn và quá tải."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                            LM
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Dr. Lê Minh</div>
                            <div class="text-sm text-gray-500">Nha khoa Minh Tâm</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic leading-relaxed">
                        "Tôi rất hài lòng với dịch vụ. Bác sĩ chuyên nghiệp, phòng khám sạch sẽ, 
                        và đúng giờ hẹn. Sẽ tiếp tục sử dụng!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            TA
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Trần Anh</div>
                            <div class="text-sm text-gray-500">Bệnh nhân tại TP.HCM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-blob"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-2000"></div>
        </div>
        
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Sẵn sàng trải nghiệm MediBook?
                </h2>
                <p class="text-xl text-white mb-10 leading-relaxed">
                    Đặt lịch khám nha khoa dễ dàng, nhanh chóng và an toàn chỉ với vài thao tác. 
                    Hãy để chúng tôi chăm sóc nụ cười của bạn!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all transform hover:-translate-y-1">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Đặt lịch ngay
                    </a>
                    <a href="#" class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl border-2 border-white/30 hover:bg-white/20 transition-all">
                        <i class="fas fa-phone mr-2"></i>
                        Liên hệ tư vấn
                    </a>
                </div>
                
                <div class="mt-12 flex items-center justify-center gap-8 text-white">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Miễn phí đặt lịch</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Xác nhận tức thì</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Hỗ trợ 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -50px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(50px, 50px) scale(1.05); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
@endsection