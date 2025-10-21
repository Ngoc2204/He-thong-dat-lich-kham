<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dental Appointment System' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --teal: #2dd4bf;
            --blue: #3b82f6;
            --dark: #1e293b;
            --light-bg: #f8fafc;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
        }


        .navbar-brand img {
            height: 60px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--teal) !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), var(--blue));
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .btn-gradient {
            background: linear-gradient(90deg, var(--teal), var(--blue));
            color: white;
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        /* ===== FOOTER ===== */
        footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;

            padding-top: 3rem;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), var(--blue));
            border-radius: 2px;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer-link:hover {
            color: var(--teal);
            padding-left: 5px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: linear-gradient(90deg, var(--teal), var(--blue));
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>

<body>
    <!-- ===== HEADER ===== -->
    <nav class="navbar navbar-expand bg-white shadow-sm sticky-top">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('appointments.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:60px;">
            </a>

            <!-- MENU CHÍNH -->
            <ul class="navbar-nav mx-auto fw-semibold d-flex flex-row gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appointments.home') ? 'text-primary fw-bold border-bottom border-2 border-primary' : '' }}"
                        href="{{ route('appointments.home') }}">Trang chủ</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointments.about') }}">Giới thiệu</a></li>
                
                <li class="nav-item"><a class="nav-link" href="{{ route('knowledge.index') }}">Kiến thức</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointments.create') }}">Đặt lịch</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointments.mine') }}">Lịch hẹn của tôi</a></li>

            </ul>

            <!-- PHẦN BÊN PHẢI -->
            <div class="d-flex align-items-center gap-3">
                @auth
                <a href="{{ route('appointments.create') }}" class="btn text-white fw-semibold px-4"
                    style="background:linear-gradient(90deg,#2dd4bf,#3b82f6);border-radius:50px;">
                    <i class="bi bi-calendar2-check me-1"></i>Đặt lịch khám
                </a>

                <div class="dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2 fs-4"></i>
                        <span>{{ Str::limit(Auth::user()->name, 15) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('appointments.mine') }}"><i
                                    class="bi bi-clock-history me-2"></i>Lịch sử đặt lịch</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-3">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn text-white px-3 rounded-pill"
                    style="background:linear-gradient(90deg,#2dd4bf,#3b82f6);">
                    Đăng ký
                </a>
                @endauth
            </div>
        </div>
    </nav>



    <!-- ALERT -->
    @if (session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
    @endif

    <!-- MAIN CONTENT -->
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:70px;">
                    <p class="mt-3 text-white-50">
                        Hệ thống nha khoa chuyên nghiệp, mang đến dịch vụ chăm sóc răng miệng tốt nhất với đội ngũ bác sĩ giàu kinh nghiệm và trang thiết bị hiện đại.
                    </p>
                    <div class="footer-social mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Liên kết</h5>
                    <a href="#" class="footer-link">Trang chủ</a>
                    <a href="#" class="footer-link">Giới thiệu</a>
                    <a href="#" class="footer-link">Dịch vụ</a>
                    <a href="#" class="footer-link">Bác sĩ</a>
                    <a href="#" class="footer-link">Liên hệ</a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Dịch vụ</h5>
                    <a href="#" class="footer-link">Tẩy trắng răng</a>
                    <a href="#" class="footer-link">Trám răng</a>
                    <a href="#" class="footer-link">Niềng răng</a>
                    <a href="#" class="footer-link">Cấy ghép Implant</a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Liên hệ</h5>
                    <p><i class="bi bi-geo-alt-fill me-2"></i>123 Đường ABC, Quận 1, TP.HCM</p>
                    <p><i class="bi bi-telephone-fill me-2"></i>1900 1234</p>
                    <p><i class="bi bi-envelope-fill me-2"></i>info@dental.vn</p>
                    <p><i class="bi bi-clock-fill me-2"></i>8:00 - 20:00 (Hàng ngày)</p>
                </div>
            </div>

            <div class="footer-bottom mt-4">
                © {{ date('Y') }} Nha Khoa Một Nụ Cười — All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>