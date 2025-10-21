<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Bác sĩ Dashboard - Dental System' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --primary-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --content-bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .dentist-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .dentist-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .dentist-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .dentist-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .sidebar-brand h4 {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
            color: white;
        }

        .sidebar-brand p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin: 0;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-section {
            margin-bottom: 2rem;
        }

        .menu-section-title {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: var(--primary-gradient);
            border-radius: 0 4px 4px 0;
            transition: height 0.3s ease;
        }

        .menu-item:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .menu-item:hover::before {
            height: 70%;
        }

        .menu-item.active {
            background: var(--sidebar-hover);
            color: white;
        }

        .menu-item.active::before {
            height: 70%;
        }

        .menu-item i {
            width: 24px;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .menu-badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Main Content */
        .dentist-main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            background: var(--content-bg);
            overflow-x: hidden;
        }

        /* Top Header */
        .dentist-header {
            background: white;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-left {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex: 1;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: none;
        }

        .sidebar-toggle:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            width: 400px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            padding: 0.25rem;
            color: #1e293b;
        }

        .search-bar i {
            color: #94a3b8;
            margin-right: 0.5rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            border: none;
        }

        .header-icon:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .header-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            padding: 0.25rem 0.4rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .dentist-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dentist-user:hover {
            background: #f1f5f9;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Content Area */
        .dentist-content {
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
        }

        .dropdown-item i {
            margin-right: 0.75rem;
            width: 20px;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .alert-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .alert-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        /* Mobile Sidebar */
        @media (max-width: 991px) {
            .dentist-sidebar {
                transform: translateX(-100%);
            }

            .dentist-sidebar.show {
                transform: translateX(0);
            }

            .dentist-main {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
            }

            .search-bar {
                display: none;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="dentist-sidebar" id="dentistSidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header d-flex align-items-center gap-3">
            <div class="sidebar-logo">
                <i class="bi bi-hospital"></i>
            </div>
            <div class="sidebar-brand">
                <h4 class="mb-0 fw-bold">Nha Khoa</h4>
                <p class="mb-0">Bác sĩ</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="sidebar-menu">
            <!-- Main Menu -->
            <div class="menu-section">
                <div class="menu-section-title">Tổng quan</div>
                <a href="{{ route('dentist.dashboard') }}"
                    class="menu-item {{ request()->routeIs('dentist.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Work Menu -->
            <div class="menu-section">
                <div class="menu-section-title">Công việc</div>
                <a href="{{ route('dentist.appointments.index') }}"
                    class="menu-item {{ request()->routeIs('dentist.appointments*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    <span>Lịch hẹn</span>
                </a>

                <a href="{{ route('dentist.schedules.index') }}"
                    class="menu-item {{ request()->routeIs('dentist.schedules*') ? 'active' : '' }}">
                    <i class="bi bi-calendar2-week"></i>
                    <span>Lịch làm việc</span>
                </a>
            </div>

            <!-- Patient Menu -->
            <div class="menu-section">
                <div class="menu-section-title">Bệnh nhân</div>
                <a href="{{ route('dentist.patients.index') }}"
                    class="menu-item {{ request()->routeIs('dentist.patients*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Danh sách bệnh nhân</span>
                </a>

            </div>

            <!-- Reporting Menu -->
            <div class="menu-section">
                <div class="menu-section-title">Báo cáo</div>
                <a href="{{ route('dentist.reports.index') }}"
                    class="menu-item {{ request()->routeIs('dentist.reports*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i>
                    <span>Báo cáo</span>
                </a>
            </div>

            <!-- Account Menu -->
            
        </nav>
    </aside>

    <!-- Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <main class="dentist-main">
        <!-- Top Header -->
        <header class="dentist-header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Tìm kiếm...">
                </div>
            </div>

            <div class="header-right">


                <!-- User Menu -->
                <div class="dropdown">
                    <div class="dentist-user" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="user-info d-none d-md-block">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">Bác sĩ</div>
                        </div>
                        <i class="bi bi-chevron-down d-none d-md-block"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i>Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="dentist-content">
            @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
            @endif

            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const dentistSidebar = document.getElementById('dentistSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                dentistSidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                dentistSidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Active menu item
        const currentPath = window.location.pathname;
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('active');
            }
        });
    </script>
</body>

</html>