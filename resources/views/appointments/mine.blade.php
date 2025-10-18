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
@endsection
