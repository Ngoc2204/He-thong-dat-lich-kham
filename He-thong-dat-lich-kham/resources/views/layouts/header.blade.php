<div class="bg-blue-900 text-white py-3">
    <div class="container mx-auto flex justify-between items-center px-6 text-sm">
        <!-- Left: Support -->
        <div class="flex items-center space-x-2">
            <i class="fas fa-headset"></i>
            <span class="font-semibold">HỖ TRỢ ĐẶT KHÁM</span>
            <i class="fas fa-phone-alt ml-4"></i>
            <a href="tel:+84123456789" class="hover:text-blue-300">(+84) 0123-456-789</a>
        </div>

        <!-- Right: Contact Info -->
        <div class="hidden lg:flex items-center space-x-6">
            <div class="flex items-center space-x-2">
                <i class="fas fa-envelope"></i>
                <span>info@email.com</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-map-marker-alt"></i>
                <span>140 Lê Trọng Tấn, P. Tây Thạnh, Q.Tân Phú, TP.HCM</span>
            </div>
        </div>
    </div>
</div>


<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logo1.png') }}" alt="MediBook" class="h-12">
        </a>

        <!-- Navigation -->
        <nav>
            <ul class="hidden md:flex space-x-6 text-gray-700 font-medium items-center">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-blue-600">Giới thiệu</a></li>
                <li><a href="#" class="hover:text-blue-600">Bác sĩ</a></li>

                <li class="nav-item">
                    <a href="#" class="flex items-center">
                        Dịch vụ <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </a>
                    <div class="dropdown">
                        <a href="{{ route('services.cleaning') }}">Vệ Sinh Răng Miệng</a>
                        <a href="{{ route('services.filling') }}">Trám Răng Thẩm Mỹ</a>
                        <a href="{{ route('services.checkup') }}">Khám Răng Tổng Quát</a>
                        <a href="{{ route('services.braces') }}">Niềng Răng Thẩm Mỹ</a>
                    </div>
                </li>



                <li><a href="#" class="hover:text-blue-600">Đặt lịch</a></li>
                <li><a href="#" class="hover:text-blue-600">Liên hệ</a></li>
            </ul>
        </nav>

        <!-- Contact & CTA -->
        <div class="hidden md:flex items-center space-x-4">
            <!-- Social Icons -->
            <div class="flex items-center space-x-3">
                <a href="https://www.facebook.com/tat.ngoc.2004" target="_blank" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-pink-600 hover:bg-pink-600 hover:text-white transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://pinterest.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-red-600 hover:bg-red-600 hover:text-white transition">
                    <i class="fab fa-pinterest-p"></i>
                </a>
            </div>

            @auth
            <!-- Nếu đã đăng nhập -->
            <div class="flex items-center space-x-3">
                <span class="font-semibold text-gray-700">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="group relative inline-flex items-center justify-center px-6 py-3 font-semibold text-white transition-all duration-300 ease-in-out transform bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 hover:from-red-600 hover:to-red-700 active:scale-95">
                        <span class="relative z-10">Đăng xuất</span>
                        <div class="absolute inset-0 w-full h-full transition-all duration-300 ease-out transform bg-white rounded-lg opacity-0 group-hover:opacity-10"></div>
                    </button>
                </form>
            </div>
            @else
            <!-- Nếu chưa đăng nhập -->
            <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-6 py-3 font-semibold text-white transition-all duration-300 ease-in-out transform bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 hover:from-blue-700 hover:to-blue-800 active:scale-95">
                <span class="relative z-10">Đăng nhập</span>
                <div class="absolute inset-0 w-full h-full transition-all duration-300 ease-out transform bg-white rounded-lg opacity-0 group-hover:opacity-10"></div>
            </a>
            @endauth
        </div>

    </div>
</header>