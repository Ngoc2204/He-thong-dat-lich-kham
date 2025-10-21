@extends('layouts.dentist')

@section('content')
    <div class="dentist-dashboard">
        <!-- Welcome Header -->
        <div class="welcome-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="welcome-content">
                        <h2 class="welcome-title">
                            <i class="bi bi-sun me-2"></i>
                            Xin chào, <span class="text-gradient">{{ Auth::user()->name }}</span>
                        </h2>
                        <p class="welcome-subtitle">Chúc bạn có một ngày làm việc hiệu quả!</p>
                    </div>
                </div>
                <div class="col-lg-4 text-end">
                    <div class="date-display">
                        <i class="bi bi-calendar-check"></i>
                        <span>{{ now()->locale('vi')->translatedFormat('l, d \t\h\á\n\g m, Y') }}</span>

                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <!-- Today Appointments -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-card-primary">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $todayAppointments }}</h3>
                        <p class="stat-label">Lịch hẹn hôm nay</p>
                    </div>
                    <div class="stat-badge">
                        <span>
                            @if($todayDiff > 0)
                                +{{ $todayDiff }} so với hôm qua
                            @elseif($todayDiff < 0)
                                {{ $todayDiff }} so với hôm qua
                            @else
                                Bằng hôm qua
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Pending Appointments -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-card-warning">
                    <div class="stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pendingAppointments }}</h3>
                        <p class="stat-label">Chờ xác nhận</p>
                    </div>
                    <div class="stat-badge">
                        <span>{{ $pendingAppointments > 0 ? 'Cần xử lý' : 'Đã xử lý hết' }}</span>
                    </div>
                </div>
            </div>

            <!-- Confirmed Appointments -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-card-success">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $confirmedAppointments }}</h3>
                        <p class="stat-label">Đã xác nhận</p>
                    </div>
                    <div class="stat-badge">
                        <span>Tuần này</span>
                    </div>
                </div>
            </div>

            <!-- Completed This Month -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-card-info">
                    <div class="stat-icon">
                        <i class="bi bi-check-all"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $completedThisMonth }}</h3>
                        <p class="stat-label">Hoàn thành tháng này</p>
                    </div>
                    <div class="stat-badge">
                        <span>{{ $completionRate }}% tỷ lệ</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Today's Schedule -->
            <div class="col-lg-8">
                <!-- Today's Appointments -->
                <div class="dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-clock-history me-2"></i>
                            Lịch khám hôm nay
                        </h5>
                        <a href="{{ route('dentist.schedules.index') }}" class="btn-link">
                            Xem tất cả <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($appointments as $appointment)
                            <div class="appointment-item">
                                <div class="appointment-time">
                                    <div class="time-badge">
                                        <i class="bi bi-clock"></i>
                                        <span>{{ $appointment->starts_at->format('H:i') }}</span>
                                    </div>
                                </div>
                                <div class="appointment-details">
                                    <div class="patient-info">
                                        <div class="patient-avatar">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="patient-name">{{ $appointment->patient->name }}</h6>
                                            <span class="patient-phone">
                                                <i class="bi bi-telephone me-1"></i>
                                                {{ $appointment->patient->phone ?? 'Chưa cập nhật' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="service-info">
                                        <span class="service-badge">
                                            <i class="bi bi-heart-pulse me-1"></i>
                                            {{ $appointment->service->name }}
                                        </span>
                                        <span class="duration-badge">
                                            <i class="bi bi-hourglass-split me-1"></i>
                                            {{ $appointment->service->duration_mins }} phút
                                        </span>
                                    </div>
                                    @if($appointment->notes)
                                        <div class="appointment-notes">
                                            <i class="bi bi-chat-left-text me-2"></i>
                                            <span>{{ Str::limit($appointment->notes, 100) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="appointment-actions">
                                    @if($appointment->status == 'pending')
                                        <form method="POST" action="{{ route('dentist.appointments.status', $appointment) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-sm btn-success-custom" title="Xác nhận">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('dentist.appointments.status', $appointment) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-sm btn-danger-custom" title="Hủy" 
                                                onclick="return confirm('Bạn có chắc muốn hủy lịch hẹn này?')">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @elseif($appointment->status == 'confirmed')
                                        <form method="POST" action="{{ route('dentist.appointments.status', $appointment) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-sm btn-primary-custom" title="Hoàn thành">
                                                <i class="bi bi-check-all"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="status-badge status-{{ $appointment->status }}">
                                            @if($appointment->status == 'completed')
                                                <i class="bi bi-check-all"></i> Hoàn thành
                                            @else
                                                <i class="bi bi-x-circle"></i> Đã hủy
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="empty-state-small">
                                <i class="bi bi-calendar-x"></i>
                                <p>Không có lịch hẹn nào hôm nay</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-lightning me-2"></i>
                            Thao tác nhanh
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('dentist.schedules.create') }}" class="quick-action-btn">
                                <div class="action-icon bg-primary">
                                    <i class="bi bi-calendar-plus"></i>
                                </div>
                                <span>Tạo lịch làm việc</span>
                            </a>
                            <a href="{{ route('dentist.schedules.index') }}" class="quick-action-btn">
                                <div class="action-icon bg-success">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <span>Xem lịch làm việc</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="quick-action-btn">
                                <div class="action-icon bg-info">
                                    <i class="bi bi-person-gear"></i>
                                </div>
                                <span>Cập nhật hồ sơ</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <div class="action-icon bg-warning">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <span>Báo cáo thống kê</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4">
                <!-- Pending Appointments -->
                <div class="dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-bell me-2"></i>
                            Chờ xác nhận
                        </h5>
                        <span class="badge-count">{{ $pendingList->count() }}</span>
                    </div>
                    <div class="card-body">
                        @forelse($pendingList as $pending)
                            <div class="pending-item">
                                <div class="pending-info">
                                    <h6 class="pending-patient">{{ $pending->patient->name }}</h6>
                                    <span class="pending-time">
                                        <i class="bi bi-clock"></i>
                                        {{ $pending->starts_at->format('d/m H:i') }}
                                    </span>
                                </div>
                                <div class="pending-actions">
                                    <form method="POST" action="{{ route('dentist.appointments.status', $pending) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn-icon-success" title="Xác nhận">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('dentist.appointments.status', $pending) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn-icon-danger" title="Từ chối"
                                            onclick="return confirm('Bạn có chắc muốn từ chối lịch hẹn này?')">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state-small">
                                <i class="bi bi-check-circle"></i>
                                <p>Tất cả đã xác nhận</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Calendar Overview -->
                <div class="dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-calendar-week me-2"></i>
                            Lịch tuần này
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="week-calendar">
                            @for($i = 0; $i < 7; $i++)
                                @php
                                    $date = now()->addDays($i);
                                    $dayAppointments = $weekAppointments[$i] ?? 0;
                                @endphp
                                <div class="week-day {{ $i == 0 ? 'today' : '' }}">
                                    <span class="day-name">{{ $date->locale('vi')->isoFormat('dd') }}</span>
                                    <span class="day-number">{{ $date->format('d') }}</span>
                                    @if($dayAppointments > 0)
                                        <span class="day-count">{{ $dayAppointments }}</span>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="dashboard-card tips-card">
                    <div class="card-body text-center">
                        <div class="tips-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h6 class="tips-title">Mẹo hôm nay</h6>
                        <p class="tips-content">
                            Nhớ xác nhận lịch hẹn trước ít nhất 24 giờ để bệnh nhân có thể sắp xếp thời gian hợp lý.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Main Container */
        .dentist-dashboard {
            max-width: 1400px;
            margin: 0 auto;
            padding: 100px 20px 40px;

            min-height: 100vh;
        }

        /* Welcome Section */
        .welcome-section {
            animation: fadeInDown 0.6s ease-out;
        }

        .welcome-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            margin: 0;
        }

        .date-display {
            background: white;
            padding: 20px 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: #1e293b;
        }

        .date-display i {
            font-size: 1.5rem;
            color: #667eea;
        }

        /* Statistics Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--card-color-1) 0%, var(--card-color-2) 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-card-primary { --card-color-1: #667eea; --card-color-2: #764ba2; }
        .stat-card-warning { --card-color-1: #f59e0b; --card-color-2: #d97706; }
        .stat-card-success { --card-color-1: #10b981; --card-color-2: #059669; }
        .stat-card-info { --card-color-1: #3b82f6; --card-color-2: #2563eb; }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--card-color-1) 0%, var(--card-color-2) 100%);
        }

        .stat-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .stat-badge {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            padding: 6px 12px;
            border-radius: 50px;
            display: inline-block;
        }

        .stat-badge span {
            font-size: 0.85rem;
            color: #667eea;
            font-weight: 600;
        }

        /* Dashboard Card */
        .dashboard-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
        }

        .card-header {
            padding: 25px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-title i {
            color: #667eea;
        }

        .btn-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-link:hover {
            color: #764ba2;
            gap: 8px;
        }

        .card-body {
            padding: 25px;
        }

        /* Appointment Item */
        .appointment-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: #f8faff;
            border-radius: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .appointment-item:hover {
            background: #f0f4ff;
            transform: translateX(5px);
        }

        .appointment-time {
            flex-shrink: 0;
        }

        .time-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            min-width: 80px;
        }

        .time-badge i {
            font-size: 1.2rem;
        }

        .appointment-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .patient-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .patient-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .patient-avatar i {
            font-size: 1.8rem;
            color: #0369a1;
        }

        .patient-name {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 3px;
        }

        .patient-phone {
            font-size: 0.85rem;
            color: #64748b;
        }

        .service-info {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .service-badge,
        .duration-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .service-badge {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .duration-badge {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .appointment-notes {
            background: white;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #475569;
            display: flex;
            align-items: start;
            gap: 8px;
        }

        .appointment-notes i {
            color: #3b82f6;
            margin-top: 2px;
        }

        .appointment-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-success-custom,
        .btn-danger-custom,
        .btn-primary-custom {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-success-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-completed {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .quick-action-btn {
            background: #f8faff;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            text-decoration: none;
            color: #1e293b;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .quick-action-btn:hover {
            background: white;
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            color: #667eea;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .action-icon.bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .action-icon.bg-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .action-icon.bg-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .action-icon.bg-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        /* Pending List */
        .badge-count {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .pending-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f8faff;
            border-radius: 12px;
            margin-bottom: 12px;
            border-left: 3px solid #f59e0b;
        }

        .pending-patient {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .pending-time {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pending-actions {
            display: flex;
            gap: 8px;
        }

        .btn-icon-success,
        .btn-icon-danger {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-icon-success {
            background: #10b981;
            color: white;
        }

        .btn-icon-success:hover {
            background: #059669;
            transform: scale(1.1);
        }

        .btn-icon-danger {
            background: #ef4444;
            color: white;
        }

        .btn-icon-danger:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        /* Week Calendar */
        .week-calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .week-day {
            background: #f8faff;
            padding: 12px 8px;
            border-radius: 12px;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .week-day:hover {
            background: #f0f4ff;
            transform: translateY(-3px);
        }

        .week-day.today {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .day-name {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
            opacity: 0.8;
        }

        .day-number {
            display: block;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .day-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 0.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Tips Card */
        .tips-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: none;
        }

        .tips-card .card-body {
            text-align: center;
        }

        .tips-icon {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .tips-icon i {
            font-size: 2rem;
            color: #f59e0b;
        }

        .tips-title {
            font-weight: 700;
            color: #92400e;
            margin-bottom: 10px;
        }

        .tips-content {
            color: #78350f;
            font-size: 0.9rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Empty States */
        .empty-state-small {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state-small i {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 10px;
        }

        .empty-state-small p {
            color: #94a3b8;
            margin: 0;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* Responsive */
        @media (max-width: 1200px) {
            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .dentist-dashboard {
                padding: 100px 15px 30px;
            }

            .date-display {
                margin-top: 15px;
            }
        }

        @media (max-width: 768px) {
            .welcome-title {
                font-size: 1.5rem;
            }

            .welcome-subtitle {
                font-size: 1rem;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
            }

            .stat-icon i {
                font-size: 1.5rem;
            }

            .stat-value {
                font-size: 2rem;
            }

            .appointment-item {
                flex-direction: column;
            }

            .appointment-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .week-calendar {
                grid-template-columns: repeat(7, 1fr);
                gap: 5px;
            }

            .week-day {
                padding: 8px 4px;
            }

            .day-name {
                font-size: 0.65rem;
            }

            .day-number {
                font-size: 1rem;
            }
        }
    </style>
@endsection