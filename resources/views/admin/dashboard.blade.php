@extends('layouts.admin')

@section('content')
<style>
    .dashboard-container {
        padding: 2rem 0;
        background: #f8fafc;
        min-height: calc(100vh - 200px);
    }

    .dashboard-header {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        animation: fadeInDown 0.5s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .dashboard-subtitle {
        color: #64748b;
        font-size: 1.1rem;
    }

    .welcome-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
    }

    /* Stats Cards */
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease;
        animation-fill-mode: both;
    }

    .stats-card:nth-child(1) { animation-delay: 0.1s; }
    .stats-card:nth-child(2) { animation-delay: 0.2s; }
    .stats-card:nth-child(3) { animation-delay: 0.3s; }
    .stats-card:nth-child(4) { animation-delay: 0.4s; }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 40px rgba(59, 130, 246, 0.15);
    }

    .stats-card.card-blue {
        border-left: 4px solid #3b82f6;
    }

    .stats-card.card-green {
        border-left: 4px solid #10b981;
    }

    .stats-card.card-purple {
        border-left: 4px solid #8b5cf6;
    }

    .stats-card.card-orange {
        border-left: 4px solid #f59e0b;
    }

    .stats-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .icon-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .icon-green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .icon-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .icon-orange {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stats-label {
        font-size: 0.95rem;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stats-change {
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
    }

    .stats-change.positive {
        background: #d1fae5;
        color: #059669;
    }

    .stats-change.negative {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Quick Actions Section */
    .quick-actions {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-top: 2rem;
        animation: fadeInUp 0.6s ease 0.5s;
        animation-fill-mode: both;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: #3b82f6;
    }

    .action-btn {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        text-decoration: none;
        color: #1e293b;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
        height: 100%;
    }

    .action-btn:hover {
        border-color: #3b82f6;
        background: #f0f9ff;
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        color: #1e293b;
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
    }

    .action-btn:hover .action-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .action-label {
        font-size: 1.1rem;
        font-weight: 600;
        text-align: center;
    }

    /* Recent Activity Section */
    .recent-activity {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-top: 2rem;
        animation: fadeInUp 0.6s ease 0.6s;
        animation-fill-mode: both;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .activity-item:hover {
        background: #f8fafc;
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .activity-icon.icon-appointment {
        background: #dbeafe;
        color: #3b82f6;
    }

    .activity-icon.icon-user {
        background: #d1fae5;
        color: #10b981;
    }

    .activity-icon.icon-service {
        background: #ede9fe;
        color: #8b5cf6;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .activity-time {
        font-size: 0.85rem;
        color: #94a3b8;
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

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 1.5rem;
        }

        .stats-number {
            font-size: 2rem;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>

<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="welcome-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div>
                        <h1 class="dashboard-title">Bảng điều khiển Admin</h1>
                        <p class="dashboard-subtitle mb-0">
                            <i class="bi bi-calendar3 me-2"></i>{{ now()->format('l, d F Y') }}
                        </p>
                    </div>
                </div>
                <div>
                    <button class="btn btn-outline-primary" onclick="location.reload()">
                        <i class="bi bi-arrow-clockwise me-2"></i>Làm mới
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card card-blue">
                    <div class="stats-icon icon-blue">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="stats-label">Bác sĩ</div>
                    <div class="stats-number" data-target="{{ $stats['dentists'] }}">0</div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card card-green">
                    <div class="stats-icon icon-green">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </div>
                    <div class="stats-label">Dịch vụ</div>
                    <div class="stats-number" data-target="{{ $stats['services'] }}">0</div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card card-purple">
                    <div class="stats-icon icon-purple">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="stats-label">Lịch hẹn</div>
                    <div class="stats-number" data-target="{{ $stats['appointments'] }}">0</div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card card-orange">
                    <div class="stats-icon icon-orange">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stats-label">Đang chờ</div>
                    <div class="stats-number" data-target="{{ $stats['pending'] }}">0</div>
                    
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Quick Actions -->
            <div class="">
                <div class="quick-actions">
                    <h2 class="section-title">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Hành động nhanh
                    </h2>
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('dentists.index') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <span class="action-label">Quản lý Bác sĩ</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('services.index') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </div>
                                <span class="action-label">Quản lý Dịch vụ</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('schedules.index') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="bi bi-calendar2-week"></i>
                                </div>
                                <span class="action-label">Quản lý Lịch làm</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.appointments.index') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="bi bi-list-check"></i>
                                </div>
                                <span class="action-label">Tất cả Lịch hẹn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.dataset.target);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    // Animate counters when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stats-number');
        
        // Delay to let the fade in animation complete
        setTimeout(() => {
            counters.forEach(counter => {
                animateCounter(counter);
            });
        }, 500);
    });

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all animated sections
    document.querySelectorAll('.quick-actions, .recent-activity').forEach(el => {
        observer.observe(el);
    });
</script>
@endsection