@extends('layouts.dentist')

@section('content')
<div class="dentist-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h2 class="page-title">
                <i class="bi bi-calendar-check"></i> 
                <span>Lịch hẹn của tôi</span>
            </h2>
            <div class="date-display">
                <i class="bi bi-calendar-event"></i>
                <span>{{ now()->locale('vi')->translatedFormat('l, d \t\h\á\n\g m, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card stat-primary">
            <div class="stat-icon-wrapper">
                <div class="stat-icon"><i class="bi bi-clock"></i></div>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $todayAppointments }}</h3>
                <p class="stat-label">Hẹn hôm nay</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up-short"></i>
            </div>
        </div>

        <div class="stat-card stat-warning">
            <div class="stat-icon-wrapper">
                <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $pendingAppointments }}</h3>
                <p class="stat-label">Chờ xác nhận</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-exclamation-circle"></i>
            </div>
        </div>

        <div class="stat-card stat-success">
            <div class="stat-icon-wrapper">
                <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $confirmedAppointments }}</h3>
                <p class="stat-label">Đã xác nhận</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-check2"></i>
            </div>
        </div>

        <div class="stat-card stat-info">
            <div class="stat-icon-wrapper">
                <div class="stat-icon"><i class="bi bi-check-all"></i></div>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $completedThisMonth }}</h3>
                <p class="stat-label">Hoàn thành tháng này</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-graph-up"></i>
            </div>
        </div>
    </div>

    <!-- Today's appointments -->
    <div class="dashboard-card appointments-card">
        <div class="card-header">
            <div class="card-header-content">
                <h5 class="card-title">
                    <i class="bi bi-clock-history"></i> 
                    <span>Lịch hẹn hôm nay</span>
                </h5>
                <span class="badge badge-primary">{{ $todayList->count() }} lịch</span>
            </div>
        </div>
        <div class="card-body">
            @forelse($todayList as $appointment)
                <div class="appointment-item">
                    <div class="appointment-time">
                        <div class="time-badge">
                            <i class="bi bi-clock-fill"></i>
                            <span>{{ $appointment->starts_at->format('H:i') }}</span>
                        </div>
                        <div class="time-line"></div>
                    </div>

                    <div class="appointment-content">
                        <div class="patient-section">
                            <div class="patient-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="patient-details">
                                <h6 class="patient-name">{{ $appointment->patient->name }}</h6>
                                <div class="patient-contact">
                                    <i class="bi bi-telephone"></i>
                                    <span>{{ $appointment->patient->phone ?? 'Chưa cập nhật' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="service-section">
                            <span class="service-badge">
                                <i class="bi bi-heart-pulse"></i>
                                {{ $appointment->service->name }}
                            </span>
                            <span class="duration-badge">
                                <i class="bi bi-hourglass-split"></i>
                                {{ $appointment->service->duration_mins }} phút
                            </span>
                        </div>

                        @if($appointment->notes)
                            <div class="notes-section">
                                <i class="bi bi-chat-left-text"></i>
                                <span>{{ $appointment->notes }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="appointment-actions">
                        @if($appointment->status == 'pending')
                            <form action="{{ route('dentist.appointments.status', $appointment) }}" method="POST" class="action-form">
                                @csrf
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-success" title="Xác nhận">
                                    <i class="bi bi-check-lg"></i>
                                    <span>Xác nhận</span>
                                </button>
                            </form>
                            <form action="{{ route('dentist.appointments.status', $appointment) }}" method="POST" class="action-form">
                                @csrf
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn hủy lịch này?')" title="Hủy bỏ">
                                    <i class="bi bi-x-lg"></i>
                                    <span>Hủy</span>
                                </button>
                            </form>
                        @elseif($appointment->status == 'confirmed')
                            <form action="{{ route('dentist.appointments.status', $appointment) }}" method="POST" class="action-form">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-primary" title="Hoàn thành">
                                    <i class="bi bi-check-all"></i>
                                    <span>Hoàn thành</span>
                                </button>
                            </form>
                        @elseif($appointment->status == 'completed')
                            <span class="status-badge status-completed">
                                <i class="bi bi-check-circle-fill"></i> Hoàn thành
                            </span>
                        @elseif($appointment->status == 'cancelled')
                            <span class="status-badge status-cancelled">
                                <i class="bi bi-x-circle-fill"></i> Đã hủy
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h6 class="empty-title">Không có lịch hẹn</h6>
                    <p class="empty-text">Bạn chưa có lịch hẹn nào cho hôm nay</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pending list -->
    <div class="dashboard-card pending-card">
        <div class="card-header">
            <div class="card-header-content">
                <h5 class="card-title">
                    <i class="bi bi-bell"></i> 
                    <span>Chờ xác nhận</span>
                </h5>
                <span class="badge badge-warning">{{ $pendingList->count() }}</span>
            </div>
        </div>
        <div class="card-body">
            @forelse($pendingList as $pending)
                <div class="pending-item">
                    <div class="pending-info">
                        <div class="pending-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="pending-details">
                            <h6 class="pending-name">{{ $pending->patient->name }}</h6>
                            <div class="pending-time">
                                <i class="bi bi-clock"></i>
                                <span>{{ $pending->starts_at->format('d/m/Y - H:i') }}</span>
                            </div>
                            <div class="pending-service">
                                <i class="bi bi-heart-pulse"></i>
                                <span>{{ $pending->service->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pending-actions">
                        <form action="{{ route('dentist.appointments.status', $pending) }}" method="POST" class="action-form">
                            @csrf
                            <input type="hidden" name="status" value="confirmed">
                            <button class="btn btn-success btn-icon" title="Xác nhận">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>
                        <form action="{{ route('dentist.appointments.status', $pending) }}" method="POST" class="action-form">
                            @csrf
                            <input type="hidden" name="status" value="cancelled">
                            <button class="btn btn-danger btn-icon" onclick="return confirm('Từ chối lịch này?')" title="Từ chối">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state-small">
                    <i class="bi bi-check-circle"></i>
                    <p>Tất cả lịch hẹn đã được xử lý</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    /* ============================================
       GLOBAL & LAYOUT
       ============================================ */
    .dentist-dashboard {
        padding: 100px 20px 40px;
        max-width: 1400px;
        margin: 0 auto;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ============================================
       HEADER
       ============================================ */
    .dashboard-header {
        margin-bottom: 32px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title i {
        color: #667eea;
        font-size: 32px;
    }

    .date-display {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);
        transition: transform 0.2s ease;
    }

    .date-display:hover {
        transform: translateY(-2px);
    }

    .date-display i {
        font-size: 18px;
    }

    /* ============================================
       STATISTICS GRID
       ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        position: relative;
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: currentColor;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-icon-wrapper {
        position: relative;
        width: 64px;
        height: 64px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon {
        font-size: 28px;
        z-index: 1;
    }

    .stat-primary { color: #667eea; }
    .stat-primary .stat-icon-wrapper { background: rgba(102, 126, 234, 0.1); }
    .stat-primary .stat-icon { color: #667eea; }

    .stat-warning { color: #f59e0b; }
    .stat-warning .stat-icon-wrapper { background: rgba(245, 158, 11, 0.1); }
    .stat-warning .stat-icon { color: #f59e0b; }

    .stat-success { color: #10b981; }
    .stat-success .stat-icon-wrapper { background: rgba(16, 185, 129, 0.1); }
    .stat-success .stat-icon { color: #10b981; }

    .stat-info { color: #3b82f6; }
    .stat-info .stat-icon-wrapper { background: rgba(59, 130, 246, 0.1); }
    .stat-info .stat-icon { color: #3b82f6; }

    .stat-content {
        flex: 1;
        min-width: 0;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
        line-height: 1;
    }

    .stat-label {
        font-size: 14px;
        color: #64748b;
        margin: 0;
        font-weight: 500;
    }

    .stat-trend {
        font-size: 20px;
        opacity: 0.3;
    }

    /* ============================================
       DASHBOARD CARDS
       ============================================ */
    .dashboard-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #f1f5f9;
        overflow: hidden;
        margin-bottom: 24px;
        transition: box-shadow 0.3s ease;
    }

    .dashboard-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        padding: 20px 24px;
        background: linear-gradient(to right, #fafbfc, #ffffff);
        border-bottom: 1px solid #e2e8f0;
    }

    .card-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title i {
        color: #667eea;
        font-size: 22px;
    }

    .badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .badge-primary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .badge-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .card-body {
        padding: 24px;
    }

    /* ============================================
       APPOINTMENT ITEMS
       ============================================ */
    .appointment-item {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 20px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 16px;
        background: #fafbfc;
        transition: all 0.3s ease;
        position: relative;
    }

    .appointment-item:hover {
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        border-color: #667eea;
    }

    .appointment-time {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .time-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 16px;
        border-radius: 12px;
        font-weight: 700;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        min-width: 80px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .time-badge i {
        font-size: 18px;
    }

    .time-badge span {
        font-size: 16px;
    }

    .time-line {
        width: 2px;
        flex: 1;
        background: linear-gradient(to bottom, #667eea, transparent);
        border-radius: 2px;
        min-height: 20px;
    }

    .appointment-content {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .patient-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .patient-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        flex-shrink: 0;
    }

    .patient-details {
        flex: 1;
        min-width: 0;
    }

    .patient-name {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
    }

    .patient-contact {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #64748b;
    }

    .patient-contact i {
        color: #667eea;
    }

    .service-section {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .service-badge, .duration-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .service-badge {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .duration-badge {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .notes-section {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 10px;
        background: white;
        border-radius: 8px;
        font-size: 13px;
        color: #475569;
        border-left: 3px solid #667eea;
    }

    .notes-section i {
        color: #667eea;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .appointment-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: flex-end;
    }

    .action-form {
        display: inline-block;
        width: 100%;
    }

    .btn {
        padding: 10px 18px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        white-space: nowrap;
        width: 100%;
        justify-content: center;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn:active {
        transform: translateY(0);
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-primary {
        background: #667eea;
        color: white;
    }

    .btn-primary:hover {
        background: #5568d3;
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        padding: 0;
        justify-content: center;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .status-cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    /* ============================================
       PENDING ITEMS
       ============================================ */
    .pending-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 12px;
        background: #fafbfc;
        transition: all 0.3s ease;
    }

    .pending-item:hover {
        background: white;
        border-color: #f59e0b;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1);
    }

    .pending-info {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    .pending-avatar {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        flex-shrink: 0;
    }

    .pending-details {
        flex: 1;
        min-width: 0;
    }

    .pending-name {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 6px 0;
    }

    .pending-time, .pending-service {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .pending-time i, .pending-service i {
        color: #f59e0b;
        font-size: 14px;
    }

    .pending-actions {
        display: flex;
        gap: 8px;
    }

    /* ============================================
       EMPTY STATES
       ============================================ */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: #94a3b8;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 700;
        color: #475569;
        margin: 0 0 8px 0;
    }

    .empty-text {
        font-size: 14px;
        color: #94a3b8;
        margin: 0;
    }

    .empty-state-small {
        text-align: center;
        padding: 30px 20px;
        color: #64748b;
    }

    .empty-state-small i {
        font-size: 32px;
        color: #10b981;
        margin-bottom: 8px;
        display: block;
    }

    .empty-state-small p {
        margin: 0;
        font-size: 14px;
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .dentist-dashboard {
            padding: 80px 16px 24px;
        }

        .page-title {
            font-size: 24px;
        }

        .page-title i {
            font-size: 28px;
        }

        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .stat-value {
            font-size: 28px;
        }

        .appointment-item {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .appointment-time {
            flex-direction: row;
            justify-content: flex-start;
        }

        .time-line {
            display: none;
        }

        .appointment-actions {
            flex-direction: row;
            width: 100%;
        }

        .action-form {
            flex: 1;
        }

        .pending-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .pending-info {
            width: 100%;
        }

        .pending-actions {
            width: 100%;
            justify-content: flex-end;
        }

        .btn span {
            display: none;
        }

        .btn {
            width: auto;
            min-width: 42px;
        }
    }

    @media (max-width: 480px) {
        .page-title span {
            font-size: 20px;
        }

        .date-display {
            font-size: 13px;
            padding: 8px 14px;
        }

        .card-header {
            padding: 16px;
        }

        .card-body {
            padding: 16px;
        }

        .stat-card {
            padding: 18px;
        }

        .stat-icon-wrapper {
            width: 56px;
            height: 56px;
        }

        .stat-icon {
            font-size: 24px;
        }
    }
</style>
@endsection