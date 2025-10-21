@extends('layouts.dentist')

@section('content')
<div class="container py-5">
    
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="text-gradient fw-bold mb-2">
                <i class="bi bi-graph-up-arrow me-2"></i>Báo cáo & Thống kê
            </h1>
            <p class="text-muted mb-0">
                <i class="bi bi-calendar-event me-1"></i>
                Tổng quan hiệu suất làm việc năm {{ now()->year }}
            </p>
        </div>
        <div class="dropdown">
            <button class="btn btn-outline-primary rounded-pill px-4 dropdown-toggle" 
                    type="button" data-bs-toggle="dropdown">
                <i class="bi bi-funnel me-2"></i>Lọc dữ liệu
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                <li><a class="dropdown-item" href="#"><i class="bi bi-calendar-week me-2"></i>7 ngày qua</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-calendar-month me-2"></i>30 ngày qua</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-calendar3 me-2"></i>3 tháng qua</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-calendar-range me-2"></i>Tùy chỉnh</a></li>
            </ul>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-icon bg-primary-subtle">
                    <i class="bi bi-calendar-check-fill text-primary"></i>
                </div>
                <div class="stat-content">
                    <h6 class="stat-label">Tổng lịch hẹn</h6>
                    <h2 class="stat-value text-primary">{{ $totalAppointments }}</h2>
                    <p class="stat-change text-success mb-0">
                        <i class="bi bi-arrow-up-short"></i>
                        <span>12% so với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-card-success">
                <div class="stat-icon bg-success-subtle">
                    <i class="bi bi-people-fill text-success"></i>
                </div>
                <div class="stat-content">
                    <h6 class="stat-label">Tổng bệnh nhân</h6>
                    <h2 class="stat-value text-success">{{ $totalPatients }}</h2>
                    <p class="stat-change text-success mb-0">
                        <i class="bi bi-arrow-up-short"></i>
                        <span>8% so với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-icon bg-warning-subtle">
                    <i class="bi bi-check-circle-fill text-warning"></i>
                </div>
                <div class="stat-content">
                    <h6 class="stat-label">Tỷ lệ hoàn thành</h6>
                    <h2 class="stat-value text-warning">{{ $completionRate }}%</h2>
                    <p class="stat-change text-success mb-0">
                        <i class="bi bi-arrow-up-short"></i>
                        <span>5% so với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-card-danger">
                <div class="stat-icon bg-danger-subtle">
                    <i class="bi bi-x-circle-fill text-danger"></i>
                </div>
                <div class="stat-content">
                    <h6 class="stat-label">Lịch hẹn đã hủy</h6>
                    <h2 class="stat-value text-danger">{{ $cancelled }}</h2>
                    <p class="stat-change text-danger mb-0">
                        <i class="bi bi-arrow-down-short"></i>
                        <span>3% so với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        
        {{-- Chart: Appointments by Month --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-gradient-primary text-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-graph-up me-2"></i>Biểu đồ lịch hẹn theo tháng
                        </h5>
                        <span class="badge bg-white text-primary px-3 py-2">
                            <i class="bi bi-calendar3 me-1"></i>Năm {{ now()->year }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <canvas id="appointmentsChart" height="100"></canvas>
                </div>
                <div class="card-footer bg-light border-0 py-3">
                    <div class="row text-center">
                        <div class="col-4">
                            <small class="text-muted d-block">Cao nhất</small>
                            <strong class="text-primary">{{ $monthlyData->max('total') ?? 0 }} lịch hẹn</strong>
                        </div>
                        <div class="col-4">
                            <small class="text-muted d-block">Trung bình</small>
                            <strong class="text-success">{{ number_format($monthlyData->avg('total') ?? 0, 1) }} lịch hẹn</strong>
                        </div>
                        <div class="col-4">
                            <small class="text-muted d-block">Thấp nhất</small>
                            <strong class="text-warning">{{ $monthlyData->min('total') ?? 0 }} lịch hẹn</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart: Status Distribution --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-gradient-success text-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-pie-chart-fill me-2"></i>Trạng thái lịch hẹn
                    </h5>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center">
                    <canvas id="statusChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        {{-- Popular Services --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-gradient-warning text-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-heart-pulse-fill me-2"></i>Dịch vụ phổ biến nhất
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($popularServices->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                            <p class="text-muted mb-0">Chưa có dữ liệu dịch vụ</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($popularServices as $index => $service)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rank-badge me-3">
                                            @if($index == 0)
                                                <i class="bi bi-trophy-fill text-warning"></i>
                                            @elseif($index == 1)
                                                <i class="bi bi-award-fill text-secondary"></i>
                                            @elseif($index == 2)
                                                <i class="bi bi-award-fill text-bronze"></i>
                                            @else
                                                <span class="text-muted fw-bold">{{ $index + 1 }}</span>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-semibold">{{ $service->service->name }}</h6>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-gradient-primary" 
                                                     style="width: {{ ($service->total / $popularServices->first()->total) * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-3 text-end">
                                            <h5 class="mb-0 fw-bold text-primary">{{ $service->total }}</h5>
                                            <small class="text-muted">lượt sử dụng</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-gradient-info text-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-clock-history me-2"></i>Hoạt động gần đây
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="timeline-activity">
                        <div class="activity-item mb-4">
                            <div class="activity-icon bg-success-subtle">
                                <i class="bi bi-check-circle-fill text-success"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1 fw-semibold">Hoàn thành khám bệnh</h6>
                                <p class="text-muted small mb-0">Bệnh nhân Nguyễn Văn A - 30 phút trước</p>
                            </div>
                        </div>
                        <div class="activity-item mb-4">
                            <div class="activity-icon bg-primary-subtle">
                                <i class="bi bi-calendar-check-fill text-primary"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1 fw-semibold">Lịch hẹn mới</h6>
                                <p class="text-muted small mb-0">Bệnh nhân Trần Thị B - 2 giờ trước</p>
                            </div>
                        </div>
                        <div class="activity-item mb-4">
                            <div class="activity-icon bg-warning-subtle">
                                <i class="bi bi-clock-fill text-warning"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1 fw-semibold">Sắp tới lịch hẹn</h6>
                                <p class="text-muted small mb-0">Bệnh nhân Lê Văn C - 15:00 hôm nay</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-danger-subtle">
                                <i class="bi bi-x-circle-fill text-danger"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1 fw-semibold">Lịch hẹn bị hủy</h6>
                                <p class="text-muted small mb-0">Bệnh nhân Phạm Thị D - Hôm qua</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-arrow-clockwise me-2"></i>Xem tất cả hoạt động
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Appointments Chart
const appointmentsCtx = document.getElementById('appointmentsChart');
const appointmentsChart = new Chart(appointmentsCtx, {
    type: 'line',
    data: {
        labels: @json($monthlyData->pluck('month')),
        datasets: [{
            label: 'Số lịch hẹn',
            data: @json($monthlyData->pluck('total')),
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 6,
            pointHoverRadius: 8,
            pointBackgroundColor: '#667eea',
            pointBorderColor: '#fff',
            pointBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                cornerRadius: 8,
                titleFont: {
                    size: 14,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        return 'Lịch hẹn: ' + context.parsed.y;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 5,
                    font: {
                        size: 12
                    }
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)',
                    drawBorder: false
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 12
                    }
                },
                grid: {
                    display: false
                }
            }
        }
    }
});

// Status Pie Chart
const statusCtx = document.getElementById('statusChart');
const statusChart = new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Hoàn thành', 'Đã xác nhận', 'Chờ xác nhận', 'Đã hủy'],
        datasets: [{
            data: [
                {{ $completedAppointments ?? 0 }},
                {{ $confirmedAppointments ?? 0 }},
                {{ $pendingAppointments ?? 0 }},
                {{ $cancelled ?? 0 }}
            ],
            backgroundColor: [
                'rgba(16, 185, 129, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(239, 68, 68, 0.8)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 12
                    },
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                cornerRadius: 8,
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                        return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                    }
                }
            }
        }
    }
});
</script>

<style>
.text-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 15px;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1;
}

.stat-change {
    font-size: 0.875rem;
    font-weight: 500;
}

.stat-change i {
    font-size: 1.2rem;
    vertical-align: middle;
}

.rank-badge {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.text-bronze {
    color: #cd7f32;
}

/* Timeline Activity */
.timeline-activity {
    position: relative;
}

.activity-item {
    display: flex;
    align-items-start;
    position: relative;
    padding-left: 60px;
}

.activity-icon {
    position: absolute;
    left: 0;
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.activity-content {
    flex: 1;
}

.activity-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: 22px;
    top: 50px;
    width: 2px;
    height: calc(100% - 10px);
    background: linear-gradient(to bottom, #e5e7eb, transparent);
}

@media (max-width: 768px) {
    .stat-value {
        font-size: 2rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 24px;
    }
}
</style>
@endsection