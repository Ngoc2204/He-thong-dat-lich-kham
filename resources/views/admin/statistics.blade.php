@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Dashboard</h2>
      <p class="text-muted mb-0">Tổng quan về hoạt động phòng khám</p>
    </div>
    
  </div>

  <!-- Stats Cards -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100 stat-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block mb-1">Tổng bệnh nhân</small>
              <h3 class="fw-bold mb-1">{{ $totalPatients }}</h3>
              <small class="text-success">
                <i class="bi bi-arrow-up"></i> Đang hoạt động
              </small>
            </div>
            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
              <i class="bi bi-people fs-2 text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100 stat-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block mb-1">Tổng bác sĩ</small>
              <h3 class="fw-bold mb-1">{{ $totalDentists }}</h3>
              <small class="text-success">
                <i class="bi bi-award"></i> Chuyên môn
              </small>
            </div>
            <div class="bg-success bg-opacity-10 rounded-circle p-3">
              <i class="bi bi-person-badge fs-2 text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100 stat-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block mb-1">Tổng lịch hẹn</small>
              <h3 class="fw-bold mb-1">{{ $totalAppointments }}</h3>
              <small class="text-success">
                <i class="bi bi-calendar2-check"></i> Tất cả thời gian
              </small>
            </div>
            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
              <i class="bi bi-calendar2-check fs-2 text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100 stat-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block mb-1">Tổng dịch vụ</small>
              <h3 class="fw-bold mb-1">{{ $totalServices }}</h3>
              <small class="text-success">
                <i class="bi bi-list-check"></i> Có sẵn
              </small>
            </div>
            <div class="bg-info bg-opacity-10 rounded-circle p-3">
              <i class="bi bi-bag-check fs-2 text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <!-- Revenue Chart -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-semibold">
            <i class="bi bi-graph-up text-primary me-2"></i>Lịch hẹn
          </h5>
          <div class="btn-group btn-group-sm" role="group">
            <button class="btn btn-outline-secondary" disabled>
              7 ngày
            </button>
          </div>
        </div>
        <div class="card-body p-4">
          <canvas id="dailyChart" height="80"></canvas>
        </div>
      </div>
    </div>

    <!-- Appointments Status -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-white border-bottom py-3">
          <h5 class="mb-0 fw-semibold">
            <i class="bi bi-pie-chart text-success me-2"></i>Trạng thái lịch hẹn
          </h5>
        </div>
        <div class="card-body p-4">
          <canvas id="statusChart" height="200"></canvas>
          <div class="mt-3">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">
                <span class="badge bg-warning bg-opacity-10 text-warning me-2">■</span>
                Chờ xác nhận
              </small>
              <small class="fw-semibold">{{ $statusStats['pending'] ?? 0 }}</small>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">
                <span class="badge bg-info bg-opacity-10 text-info me-2">■</span>
                Đã xác nhận
              </small>
              <small class="fw-semibold">{{ $statusStats['confirmed'] ?? 0 }}</small>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">
                <span class="badge bg-success bg-opacity-10 text-success me-2">■</span>
                Hoàn tất
              </small>
              <small class="fw-semibold">{{ $statusStats['completed'] ?? 0 }}</small>
            </div>
            <div class="d-flex justify-content-between">
              <small class="text-muted">
                <span class="badge bg-danger bg-opacity-10 text-danger me-2">■</span>
                Huỷ
              </small>
              <small class="fw-semibold">{{ $statusStats['cancelled'] ?? 0 }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Top Services -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
          <h5 class="mb-0 fw-semibold">
            <i class="bi bi-star text-warning me-2"></i>Dịch vụ phổ biến
          </h5>
        </div>
        <div class="card-body p-4">
          @forelse($topServices as $service)
          <div class="mb-3">
            <div class="d-flex justify-content-between mb-1">
              <small class="fw-semibold">{{ $service->name }}</small>
              <small class="text-muted">{{ $service->count }} lần</small>
            </div>
            <div class="progress" style="height: 6px;">
              <div class="progress-bar bg-success"
                   role="progressbar"
                   style="width: {{ ($service->count / ($topServices->first()->count ?? 1)) * 100 }}%">
              </div>
            </div>
          </div>
          @empty
          <p class="text-muted text-center py-4">
            <i class="bi bi-inbox d-block mb-2 fs-3"></i>
            Không có dữ liệu dịch vụ
          </p>
          @endempty
        </div>
      </div>
    </div>

    <!-- Top Dentists -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
          <h5 class="mb-0 fw-semibold">
            <i class="bi bi-award text-primary me-2"></i>Bác sĩ hàng đầu
          </h5>
        </div>
        <div class="card-body p-4">
          @forelse($topDentists as $dentist)
          <div class="mb-3">
            <div class="d-flex justify-content-between mb-1">
              <small class="fw-semibold">{{ $dentist->name }}</small>
              <small class="text-muted">{{ $dentist->count }} lịch hẹn</small>
            </div>
            <div class="progress" style="height: 6px;">
              <div class="progress-bar bg-primary"
                   role="progressbar"
                   style="width: {{ ($dentist->count / ($topDentists->first()->count ?? 1)) * 100 }}%">
              </div>
            </div>
          </div>
          @empty
          <p class="text-muted text-center py-4">
            <i class="bi bi-inbox d-block mb-2 fs-3"></i>
            Không có dữ liệu bác sĩ
          </p>
          @endempty
        </div>
      </div>
    </div>
  </div>

  <!-- Revenue Summary -->
  <div class="row g-4 mt-2">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
          <h5 class="mb-0 fw-semibold">
            <i class="bi bi-cash-coin text-warning me-2"></i>Tổng doanh thu từ lịch hẹn hoàn tất
          </h5>
        </div>
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-3">
              <small class="text-muted d-block mb-1">Tổng doanh thu</small>
              <h2 class="fw-bold text-success">{{ number_format($totalRevenue, 0, ',', '.') }} ₫</h2>
            </div>
            <div class="col-md-3">
              <small class="text-muted d-block mb-1">Lịch hẹn hoàn tất</small>
              <h2 class="fw-bold text-primary">{{ $statusStats['completed'] ?? 0 }}</h2>
            </div>
            <div class="col-md-3">
              <small class="text-muted d-block mb-1">Trung bình/lịch hẹn</small>
              <h2 class="fw-bold text-info">
                @php
                  $avgRevenue = ($statusStats['completed'] ?? 0) > 0 
                    ? number_format($totalRevenue / ($statusStats['completed'] ?? 1), 0, ',', '.')
                    : '0';
                @endphp
                {{ $avgRevenue }} ₫
              </h2>
            </div>
            <div class="col-md-3">
              <small class="text-muted d-block mb-1">Tỷ lệ hoàn tất</small>
              <h2 class="fw-bold text-warning">
                @php
                  $completionRate = $totalAppointments > 0 
                    ? round(($statusStats['completed'] ?? 0) / $totalAppointments * 100, 1)
                    : 0;
                @endphp
                {{ $completionRate }}%
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
  // Prepare data for daily appointments chart
  const dailyData = @json($dailyAppointments);
  const dates = dailyData.map(item => item.date);
  const totals = dailyData.map(item => item.total);

  // Daily Appointments Chart
  const dailyCtx = document.getElementById('dailyChart').getContext('2d');
  const dailyChart = new Chart(dailyCtx, {
    type: 'bar',
    data: {
      labels: dates,
      datasets: [{
        label: 'Số lịch hẹn',
        data: totals,
        backgroundColor: 'rgba(13, 110, 253, 0.8)',
        borderColor: '#0d6efd',
        borderWidth: 1,
        borderRadius: 4,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false,
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      }
    }
  });

  // Status Chart
  const statusCtx = document.getElementById('statusChart').getContext('2d');
  const statusChart = new Chart(statusCtx, {
    type: 'doughnut',
    data: {
      labels: ['Chờ xác nhận', 'Đã xác nhận', 'Hoàn tất', 'Huỷ'],
      datasets: [{
        data: [
          {{ $statusStats['pending'] ?? 0 }},
          {{ $statusStats['confirmed'] ?? 0 }},
          {{ $statusStats['completed'] ?? 0 }},
          {{ $statusStats['cancelled'] ?? 0 }}
        ],
        backgroundColor: [
          'rgba(255, 193, 7, 0.8)',
          'rgba(23, 162, 184, 0.8)',
          'rgba(40, 167, 69, 0.8)',
          'rgba(220, 53, 69, 0.8)',
        ],
        borderColor: '#fff',
        borderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false,
        }
      }
    }
  });
</script>

<style>
  .stat-card {
    transition: all 0.3s ease;
  }

  .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
  }

  .progress {
    background-color: rgba(0, 0, 0, 0.05);
  }

  .card {
    transition: all 0.3s ease;
  }
</style>
@endsection