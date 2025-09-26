<header class="site-header">
    <div class="container flex justify-between items-center py-4">
        <a href="{{ url('/') }}" class="logo text-xl font-bold text-blue-700">
            MediBook
        </a>
        <nav class="nav">
            <ul class="flex space-x-6">
                <li><a href="{{ url('/') }}" class="hover:text-blue-500">Trang chủ</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-blue-500">Giới thiệu</a></li>
                <li><a href="{{ url('/doctors') }}" class="hover:text-blue-500">Bác sĩ</a></li>
                <li><a href="{{ url('/booking') }}" class="hover:text-blue-500">Đặt lịch</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-blue-500">Liên hệ</a></li>
            </ul>
        </nav>
    </div>
</header>
