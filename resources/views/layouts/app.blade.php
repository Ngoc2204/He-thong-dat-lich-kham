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
        <div class="container-fluid px-4">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height:40px;">

                </a>

                <!-- MENU (canh giữa) -->
                <div class="d-none d-lg-flex justify-content-center flex-grow-1">
                    <ul class="navbar-nav fw-semibold">
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('home') ? 'text-teal fw-bold border-bottom border-2 border-teal' : '' }}"
                                href="{{ route('home') }}">Trang chủ</a>
                        </li>
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

                        <li class="nav-item"><a class="nav-link px-3" href="#">Kiến thức</a></li>

                    </ul>
                </div>

                <!-- PHẦN BÊN PHẢI -->
                <div class="d-flex align-items-center gap-3 flex-shrink-0">
                    <!-- Mạng xã hội -->
                    <div class="d-none d-lg-flex gap-2">
                        <a href="#" class="text-dark"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-pinterest fs-5"></i></a>
                    </div>

                    <!-- Kiểm tra đăng nhập -->
                    @auth
                        <a href="{{ route('appointments.create') }}" class="btn text-white fw-semibold px-4"
                            style="background:linear-gradient(90deg,#2dd4bf,#3b82f6);border-radius:50px;">
                            <i class="bi bi-calendar2-check"></i> Đặt lịch khám
                        </a>

                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" href="#"
                                role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2"></i>
                                <span class="d-none d-sm-inline">{{ Str::limit(Auth::user()->name, 15) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('appointments.mine') }}">
                                        <i class="bi bi-clock-history me-2"></i>Lịch sử đặt lịch
                                    </a>
                                </li>
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
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary px-3">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="btn text-white px-3"
                                style="background:linear-gradient(90deg,#2dd4bf,#3b82f6);border:none;">
                                Đăng ký
                            </a>
                        </div>
                    @endauth
                </div>
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
