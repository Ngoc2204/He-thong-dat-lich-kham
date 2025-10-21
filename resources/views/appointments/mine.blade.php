@extends('layouts.app')

@section('content')
    <div class="my-appointments-page">
        <!-- Header Section -->
        <div class="page-header text-center mb-5">
            <div class="icon-wrapper mb-3">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h2 class="fw-bold mb-2">Lịch hẹn của tôi</h2>
            <p class="text-muted">Quản lý và theo dõi các lịch hẹn khám răng</p>
        </div>

        @forelse($apps as $a)
            <!-- Appointment Card -->
            <div class="appointment-card mb-3">
                <div class="row align-items-center">
                    <!-- Left: Date & Time -->
                    <div class="col-lg-3 col-md-4">
                        <div class="appointment-datetime">
                            <div class="date-badge">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $a->starts_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="time-badge">
                                <i class="bi bi-clock"></i>
                                <span>{{ $a->starts_at->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Middle: Details -->
                    <div class="col-lg-6 col-md-8 mb-3 mb-md-0">
                        <div class="appointment-details">
                            <div class="detail-item">
                                <i class="bi bi-person-badge text-primary"></i>
                                <div>
                                    <span class="detail-label">Bác sĩ</span>
                                    <span class="detail-value">{{ $a->dentist->user->name }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-heart-pulse text-danger"></i>
                                <div>
                                    <span class="detail-label">Dịch vụ</span>
                                    <span class="detail-value">{{ $a->service->name }}</span>
                                </div>
                            </div>
                            @if ($a->notes)
                                <div class="detail-item">
                                    <i class="bi bi-chat-left-text text-info"></i>
                                    <div>
                                        <span class="detail-label">Ghi chú</span>
                                        <span class="detail-value">{{ Str::limit($a->notes, 50) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Status & Actions -->
                    <div class="col-lg-3 col-md-12">
                        <div class="appointment-actions">
                            <!-- Status Badge -->
                            <div class="status-badge status-{{ $a->status }} mb-3">
                                @if ($a->status == 'pending')
                                    <i class="bi bi-hourglass-split"></i>
                                    <span>Chờ xác nhận</span>
                                @elseif($a->status == 'confirmed')
                                    <i class="bi bi-check-circle"></i>
                                    <span>Đã xác nhận</span>
                                @elseif($a->status == 'completed')
                                    <i class="bi bi-check-all"></i>
                                    <span>Đã hoàn thành</span>
                                @else
                                    <i class="bi bi-x-circle"></i>
                                    <span>Đã hủy</span>
                                @endif
                            </div>

                            <!-- Cancel Button -->
                            @if (!in_array($a->status, ['completed', 'cancelled']))
                                <form method="POST" action="{{ route('appointments.cancel', $a) }}"
                                    onsubmit="return confirm('Bạn có chắc muốn hủy lịch hẹn này?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-cancel" type="submit">
                                        <i class="bi bi-x-lg me-1"></i>
                                        Hủy lịch hẹn
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="empty-state">
                <div class="text-center">
                    <i class="bi bi-calendar-x"></i>
                    <h4 class="fw-bold mt-3 mb-2">Chưa có lịch hẹn</h4>
                    <p class="text-muted mb-4">Bạn chưa đặt lịch khám nào. Hãy đặt lịch ngay để được chăm sóc tốt nhất!</p>
                    <a href="{{ route('appointments.create') }}" class="btn btn-gradient">
                        <i class="bi bi-plus-circle me-2"></i>
                        Đặt lịch mới
                    </a>
                </div>
            </div>
        @endforelse

        <!-- Pagination -->
        @if ($apps->hasPages())
            <div class="pagination-wrapper mt-4">
                {{ $apps->links() }}
            </div>
        @endif
    </div>

    <style>
        /* Main Container */
        .my-appointments-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 20px 40px;
            min-height: 100vh;
        }

        /* Header Section */
        .page-header {
            animation: fadeInDown 0.6s ease-out;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
            animation: pulse 2s infinite;
        }

        .icon-wrapper i {
            font-size: 2.5rem;
            color: white;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        /* Appointment Card */
        .appointment-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            border-left: 5px solid transparent;
        }

        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        }

        /* Date & Time Section */
        .appointment-datetime {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .date-badge,
        .time-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            border-radius: 12px;
            font-weight: 600;
            color: #1e293b;
            border-left: 4px solid #667eea;
        }

        .date-badge i,
        .time-badge i {
            font-size: 1.2rem;
            color: #667eea;
        }

        /* Details Section */
        .appointment-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .detail-item i {
            font-size: 1.3rem;
            margin-top: 2px;
        }

        .detail-item > div {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .detail-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
        }

        .detail-value {
            font-size: 1rem;
            color: #1e293b;
            font-weight: 600;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            width: 70%;
            justify-content: center;
        }

        .status-badge i {
            font-size: 1.1rem;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border: 2px solid #fbbf24;
        }

        .status-confirmed {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 2px solid #10b981;
        }

        .status-completed {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            border: 2px solid #3b82f6;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 2px solid #ef4444;
        }

        /* Actions Section */
        .appointment-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Cancel Button */
        .btn-cancel {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            width: 100%;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 20px;
            padding: 80px 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.6s ease-out;
        }

        .empty-state i {
            font-size: 5rem;
            color: #cbd5e1;
        }

        /* Gradient Button */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            padding: 14px 40px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            display: inline-flex;
            align-items: center;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper .pagination {
            background: white;
            border-radius: 15px;
            padding: 10px 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .pagination-wrapper .page-link {
            border: none;
            color: #667eea;
            font-weight: 600;
            margin: 0 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .pagination-wrapper .page-link:hover {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            color: #667eea;
        }

        .pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .my-appointments-page {
                padding: 100px 15px 30px;
            }

            .appointment-card {
                padding: 20px;
            }

            .appointment-datetime {
                margin-bottom: 20px;
            }

            .appointment-actions {
                margin-top: 20px;
            }

            .status-badge {
                font-size: 0.85rem;
                padding: 8px 16px;
            }

            .icon-wrapper {
                width: 60px;
                height: 60px;
            }

            .icon-wrapper i {
                font-size: 2rem;
            }

            .empty-state {
                padding: 60px 30px;
            }

            .empty-state i {
                font-size: 4rem;
            }
        }

        /* Color Border for Cards based on Status */
        .appointment-card:has(.status-pending) {
            border-left-color: #fbbf24;
        }

        .appointment-card:has(.status-confirmed) {
            border-left-color: #10b981;
        }

        .appointment-card:has(.status-completed) {
            border-left-color: #3b82f6;
        }

        .appointment-card:has(.status-cancelled) {
            border-left-color: #ef4444;
        }
    </style>
@endsection