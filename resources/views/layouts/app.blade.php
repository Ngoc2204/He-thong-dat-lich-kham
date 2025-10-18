<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dental Appointment System' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
    <nav class="navbar navbar-expand-lg shadow-sm py-3 bg-white">
        <div class="container align-items-center">
            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height:40px;">

            </a>

            <!-- TOGGLER -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse justify-content-center" id="navMenu">
                <ul class="navbar-nav fw-semibold">
                    <li class="nav-item"><a
                            class="nav-link px-3 {{ request()->routeIs('home') ? 'text-teal fw-bold border-bottom border-2 border-teal' : '' }}"
                            href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3" href="#" role="button"
                            data-bs-toggle="dropdown">Dịch vụ</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tẩy trắng răng</a></li>
                            <li><a class="dropdown-item" href="#">Trám răng</a></li>
                            <li><a class="dropdown-item" href="#">Khám tổng quát</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">Hướng dẫn khách hàng</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">Kiến thức</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">Liên hệ</a></li>
                </ul>
            </div>

            <!-- ICONS + BUTTON -->
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex gap-2">
                    <a href="#" class="text-dark"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-dark"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-dark"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-dark"><i class="bi bi-pinterest fs-5"></i></a>
                </div>

                <a href="{{ route('appointments.create') }}" class="btn text-white fw-semibold ms-3"
                    style="background:linear-gradient(90deg,#2dd4bf,#3b82f6);border-radius:50px;padding:1.5rem 1.2rem;width:170px;">
                    <i class="bi bi-calendar2-check"></i> Đặt lịch khám
                </a>
            </div>
        </div>
    </nav>


    <!-- Đổi thành -->
    @if (session('success'))
        <div class="container">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
