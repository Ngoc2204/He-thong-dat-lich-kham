@extends('layouts.dentist')

@section('content')
<div class="schedule-container">
    {{-- Header Section --}}
    <div class="schedule-header">
        <div class="header-content">
            <div class="header-text">
                <h2 class="page-title">
                    <i class="bi bi-calendar-week"></i>
                    <span>Lịch Làm Việc Của Tôi</span>
                </h2>
                <p class="page-subtitle">Theo dõi và quản lý thời gian làm việc của bạn dễ dàng</p>
            </div>
            <a href="{{ route('dentist.schedules.create') }}" class="btn btn-create">
                <i class="bi bi-plus-circle"></i>
                <span>Thêm lịch làm việc</span>
            </a>
        </div>
    </div>

    {{-- Schedule Content --}}
    <div class="schedule-card">
        @if($schedules->isEmpty())
            {{-- Empty State --}}
            <div class="empty-state">
                <div class="empty-icon-wrapper">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h3 class="empty-title">Chưa có lịch làm việc</h3>
                <p class="empty-text">Bắt đầu tạo lịch làm việc của bạn để quản lý thời gian hiệu quả hơn</p>
                <a href="{{ route('dentist.schedules.create') }}" class="btn btn-primary-empty">
                    <i class="bi bi-plus-circle"></i>
                    Tạo lịch đầu tiên
                </a>
            </div>
        @else
            {{-- Schedule Grid View --}}
            <div class="schedule-grid">
                @foreach($schedules as $s)
                    <div class="schedule-item">
                        <div class="schedule-day">
                            <div class="day-icon">
                                <i class="bi bi-calendar-day"></i>
                            </div>
                            <h4 class="day-name">{{ ucfirst($s->weekday) }}</h4>
                        </div>
                        
                        <div class="schedule-details">
                            <div class="detail-item">
                                <div class="detail-icon time-start">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Giờ bắt đầu</span>
                                    <span class="detail-value">{{ $s->start_time }}</span>
                                </div>
                            </div>

                            <div class="time-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </div>

                            <div class="detail-item">
                                <div class="detail-icon time-end">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Giờ kết thúc</span>
                                    <span class="detail-value">{{ $s->end_time }}</span>
                                </div>
                            </div>

                            <div class="detail-item slot-item">
                                <div class="detail-icon slot-icon">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Khoảng cách</span>
                                    <span class="detail-value">{{ $s->slot_minutes }} phút</span>
                                </div>
                            </div>
                        </div>

                        <div class="schedule-stats">
                            @php
                                $totalMinutes = (strtotime($s->end_time) - strtotime($s->start_time)) / 60;
                                $totalSlots = floor($totalMinutes / $s->slot_minutes);
                            @endphp
                            <div class="stat-badge">
                                <i class="bi bi-grid-3x3-gap"></i>
                                <span>{{ $totalSlots }} slot khả dụng</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Schedule Summary --}}
            <div class="schedule-summary">
                <h5 class="summary-title">
                    <i class="bi bi-info-circle"></i>
                    Tổng quan lịch làm việc
                </h5>
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="bi bi-calendar-week"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-value">{{ $schedules->count() }}</span>
                            <span class="summary-label">Ngày làm việc</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="summary-content">
                            @php
                                $totalHours = 0;
                                foreach($schedules as $s) {
                                    $totalHours += (strtotime($s->end_time) - strtotime($s->start_time)) / 3600;
                                }
                            @endphp
                            <span class="summary-value">{{ number_format($totalHours, 1) }}</span>
                            <span class="summary-label">Giờ / Tuần</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>
                        <div class="summary-content">
                            @php
                                $totalSlots = 0;
                                foreach($schedules as $s) {
                                    $minutes = (strtotime($s->end_time) - strtotime($s->start_time)) / 60;
                                    $totalSlots += floor($minutes / $s->slot_minutes);
                                }
                            @endphp
                            <span class="summary-value">{{ $totalSlots }}</span>
                            <span class="summary-label">Tổng slot</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* ============================================
       CONTAINER & LAYOUT
       ============================================ */
    .schedule-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 100px 20px 60px;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ============================================
       HEADER SECTION
       ============================================ */
    .schedule-header {
        margin-bottom: 40px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }

    .header-text {
        flex: 1;
        min-width: 250px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 12px 0;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .page-title i {
        color: #667eea;
        font-size: 36px;
    }

    .page-subtitle {
        font-size: 16px;
        color: #64748b;
        margin: 0;
        font-weight: 400;
    }

    .btn-create {
        padding: 14px 28px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-create:active {
        transform: translateY(0);
    }

    .btn-create i {
        font-size: 18px;
    }

    /* ============================================
       SCHEDULE CARD
       ============================================ */
    .schedule-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
    }

    .empty-icon-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .empty-icon-wrapper i {
        font-size: 56px;
        color: #94a3b8;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 700;
        color: #475569;
        margin: 0 0 12px 0;
    }

    .empty-text {
        font-size: 16px;
        color: #94a3b8;
        margin: 0 0 32px 0;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-primary-empty {
        padding: 14px 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 14px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-primary-empty:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* ============================================
       SCHEDULE GRID
       ============================================ */
    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
        padding: 32px;
    }

    .schedule-item {
        background: linear-gradient(135deg, #fafbfc 0%, #ffffff 100%);
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .schedule-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .schedule-item:hover {
        border-color: #667eea;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15);
        transform: translateY(-4px);
    }

    .schedule-item:hover::before {
        transform: scaleX(1);
    }

    /* ============================================
       SCHEDULE DAY
       ============================================ */
    .schedule-day {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f1f5f9;
    }

    .day-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .day-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        text-transform: capitalize;
    }

    /* ============================================
       SCHEDULE DETAILS
       ============================================ */
    .schedule-details {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: white;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .detail-item:hover {
        border-color: #667eea;
        background: #fafbfc;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .time-start {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .time-end {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .slot-icon {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .detail-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
        flex: 1;
    }

    .detail-label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 16px;
        color: #1e293b;
        font-weight: 700;
    }

    .time-arrow {
        align-self: center;
        color: #cbd5e1;
        font-size: 20px;
        margin: -8px 0;
    }

    .slot-item {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(245, 158, 11, 0.1) 100%);
        border-color: rgba(245, 158, 11, 0.2);
    }

    /* ============================================
       SCHEDULE STATS
       ============================================ */
    .schedule-stats {
        display: flex;
        justify-content: center;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }

    .stat-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .stat-badge i {
        font-size: 16px;
    }

    /* ============================================
       SCHEDULE SUMMARY
       ============================================ */
    .schedule-summary {
        padding: 32px;
        background: linear-gradient(135deg, #f8faff 0%, #ffffff 100%);
        border-top: 2px solid #e2e8f0;
    }

    .summary-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 24px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .summary-title i {
        color: #667eea;
        font-size: 20px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .summary-item:hover {
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .summary-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
    }

    .summary-content {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .summary-value {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
    }

    .summary-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */
    @media (max-width: 1024px) {
        .schedule-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .schedule-container {
            padding: 80px 16px 40px;
        }

        .header-content {
            flex-direction: column;
            align-items: stretch;
        }

        .page-title {
            font-size: 26px;
        }

        .page-title i {
            font-size: 30px;
        }

        .btn-create {
            width: 100%;
            justify-content: center;
        }

        .schedule-grid {
            grid-template-columns: 1fr;
            padding: 20px;
            gap: 20px;
        }

        .schedule-summary {
            padding: 24px 20px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .empty-state {
            padding: 60px 24px;
        }

        .empty-icon-wrapper {
            width: 100px;
            height: 100px;
        }

        .empty-icon-wrapper i {
            font-size: 48px;
        }

        .empty-title {
            font-size: 20px;
        }

        .empty-text {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 22px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .page-subtitle {
            font-size: 14px;
        }

        .schedule-item {
            padding: 20px;
        }

        .day-icon {
            width: 46px;
            height: 46px;
            font-size: 20px;
        }

        .day-name {
            font-size: 18px;
        }

        .detail-icon {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }

        .detail-value {
            font-size: 15px;
        }

        .summary-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }

        .summary-value {
            font-size: 24px;
        }
    }
</style>
@endsection