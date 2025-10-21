@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Quản lý Lịch làm việc</h2>
      <p class="text-muted mb-0">Lịch làm việc hàng tuần của các bác sĩ</p>
    </div>
    <a class="btn btn-primary px-4 py-2 rounded-3 shadow-sm" href="{{ route('schedules.create') }}">
      <i class="bi bi-plus-circle me-2"></i>Thêm lịch làm việc
    </a>
  </div>

  <!-- Filter & View Options -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" 
                   class="form-control border-start-0" 
                   id="searchInput"
                   placeholder="Tìm kiếm bác sĩ...">
          </div>
        </div>
        <div class="col-md-6 text-end">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary active" onclick="changeView('table')">
              <i class="bi bi-table me-1"></i>Bảng
            </button>
            <button type="button" class="btn btn-outline-primary" onclick="changeView('calendar')">
              <i class="bi bi-calendar-week me-1"></i>Lịch tuần
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Table View -->
  <div id="tableView" class="card border-0 shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-muted fw-semibold">Bác sĩ</th>
              <th class="px-4 py-3 text-muted fw-semibold">Thứ</th>
              <th class="px-4 py-3 text-muted fw-semibold">Giờ làm việc</th>
              <th class="px-4 py-3 text-muted fw-semibold">Thời lượng slot</th>
              <th class="px-4 py-3 text-muted fw-semibold">Số slot</th>
              <th class="px-4 py-3 text-muted fw-semibold text-center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @php
              $weekdays = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
              $weekdayColors = ['danger', 'primary', 'success', 'warning', 'info', 'secondary', 'dark'];
            @endphp
            
            @forelse($schedules as $sc)
            <tr data-dentist="{{ strtolower($sc->dentist->user->name) }}">
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  @if($sc->dentist->avatar)
                  <img src="{{ asset('storage/' . $sc->dentist->avatar) }}" 
                       class="rounded-circle me-3" 
                       style="width: 40px; height: 40px; object-fit: cover;"
                       alt="{{ $sc->dentist->user->name }}">
                  @else
                  <div class="avatar-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                       style="width: 40px; height: 40px;">
                    <span class="fw-bold">{{ strtoupper(substr($sc->dentist->user->name, 0, 1)) }}</span>
                  </div>
                  @endif
                  <div>
                    <div class="fw-semibold">{{ $sc->dentist->user->name }}</div>
                    <small class="text-muted">{{ $sc->dentist->specialty }}</small>
                  </div>
                </div>
              </td>
              <td class="px-4 py-3">
                <span class="badge bg-{{ $weekdayColors[$sc->weekday] }} bg-opacity-10 text-{{ $weekdayColors[$sc->weekday] }} px-3 py-2 rounded-pill">
                  <i class="bi bi-calendar3 me-1"></i>{{ $weekdays[$sc->weekday] }}
                </span>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-clock text-success me-2"></i>
                  <span class="fw-semibold">{{ substr($sc->start_time, 0, 5) }}</span>
                  <i class="bi bi-arrow-right mx-2 text-muted"></i>
                  <span class="fw-semibold">{{ substr($sc->end_time, 0, 5) }}</span>
                </div>
                @php
                  $start = strtotime($sc->start_time);
                  $end = strtotime($sc->end_time);
                  $totalHours = ($end - $start) / 3600;
                @endphp
                <small class="text-muted d-block mt-1">{{ number_format($totalHours, 1) }} giờ</small>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-hourglass-split text-info me-2"></i>
                  <span>{{ $sc->slot_minutes }} phút</span>
                </div>
              </td>
              <td class="px-4 py-3">
                @php
                  $totalMinutes = $totalHours * 60;
                  $slots = floor($totalMinutes / $sc->slot_minutes);
                @endphp
                <span class="badge bg-light text-dark px-3 py-2">
                  <i class="bi bi-grid-3x3 me-1"></i>{{ $slots }} slot
                </span>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex gap-2 justify-content-center">
                  <button class="btn btn-sm btn-outline-info rounded-pill px-3" 
                          data-bs-toggle="modal" 
                          data-bs-target="#viewModal{{ $sc->id }}"
                          title="Xem chi tiết">
                    <i class="bi bi-eye"></i>
                  </button>
                  <a class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                     href="{{ route('schedules.edit', $sc) }}" 
                     title="Chỉnh sửa">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('schedules.destroy', $sc) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                            onclick="return confirm('Bạn có chắc chắn muốn xóa lịch làm việc này?')"
                            title="Xóa">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- Modal xem chi tiết -->
            <div class="modal fade" id="viewModal{{ $sc->id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Chi tiết Lịch làm việc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="text-center mb-4">
                      @if($sc->dentist->avatar)
                      <img src="{{ asset('storage/' . $sc->dentist->avatar) }}" 
                           class="rounded-circle shadow-sm mb-3" 
                           style="width: 80px; height: 80px; object-fit: cover;"
                           alt="{{ $sc->dentist->user->name }}">
                      @else
                      <div class="avatar-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                           style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-2">{{ strtoupper(substr($sc->dentist->user->name, 0, 1)) }}</span>
                      </div>
                      @endif
                      <h5 class="fw-bold mb-1">{{ $sc->dentist->user->name }}</h5>
                      <span class="badge bg-info bg-opacity-10 text-info">{{ $sc->dentist->specialty }}</span>
                    </div>

                    <div class="mb-3">
                      <label class="text-muted small mb-1">Ngày trong tuần</label>
                      <p class="fw-semibold">
                        <span class="badge bg-{{ $weekdayColors[$sc->weekday] }} bg-opacity-10 text-{{ $weekdayColors[$sc->weekday] }} px-3 py-2">
                          {{ $weekdays[$sc->weekday] }}
                        </span>
                      </p>
                    </div>

                    <div class="row mb-3">
                      <div class="col-6">
                        <label class="text-muted small mb-1">Giờ bắt đầu</label>
                        <p class="fw-bold mb-0 fs-5 text-success">{{ substr($sc->start_time, 0, 5) }}</p>
                      </div>
                      <div class="col-6">
                        <label class="text-muted small mb-1">Giờ kết thúc</label>
                        <p class="fw-bold mb-0 fs-5 text-danger">{{ substr($sc->end_time, 0, 5) }}</p>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-6">
                        <label class="text-muted small mb-1">Thời lượng mỗi slot</label>
                        <p class="fw-semibold mb-0">{{ $sc->slot_minutes }} phút</p>
                      </div>
                      <div class="col-6">
                        <label class="text-muted small mb-1">Tổng số slot</label>
                        <p class="fw-semibold mb-0">{{ $slots }} slot</p>
                      </div>
                    </div>

                    <div class="alert alert-light mb-0">
                      <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Tổng thời gian làm việc: {{ number_format($totalHours, 1) }} giờ
                      </small>
                    </div>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a href="{{ route('schedules.edit', $sc) }}" class="btn btn-primary">
                      <i class="bi bi-pencil me-2"></i>Chỉnh sửa
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <tr>
              <td colspan="6" class="text-center py-5">
                <i class="bi bi-calendar-x fs-1 text-muted d-block mb-3"></i>
                <p class="text-muted">Chưa có lịch làm việc nào</p>
                <a href="{{ route('schedules.create') }}" class="btn btn-primary">Thêm lịch làm việc</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Calendar View (Weekly) -->
  <div id="calendarView" class="card border-0 shadow-sm" style="display: none;">
    <div class="card-body p-4">
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th class="py-3">Bác sĩ</th>
              @foreach(['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'] as $day)
              <th class="py-3">{{ $day }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @php
              $dentists = $schedules->groupBy('dentist_id');
            @endphp
            @foreach($dentists as $dentistId => $dentistSchedules)
            @php
              $dentist = $dentistSchedules->first()->dentist;
              $scheduleByDay = $dentistSchedules->keyBy('weekday');
            @endphp
            <tr>
              <td class="align-middle py-3">
                <div class="d-flex align-items-center justify-content-center">
                  @if($dentist->avatar)
                  <img src="{{ asset('storage/' . $dentist->avatar) }}" 
                       class="rounded-circle me-2" 
                       style="width: 35px; height: 35px; object-fit: cover;"
                       alt="{{ $dentist->user->name }}">
                  @endif
                  <span class="fw-semibold">{{ $dentist->user->name }}</span>
                </div>
              </td>
              @for($day = 0; $day < 7; $day++)
              <td class="align-middle py-3">
                @if(isset($scheduleByDay[$day]))
                @php $sc = $scheduleByDay[$day]; @endphp
                <div class="schedule-cell bg-success bg-opacity-10 rounded p-2">
                  <div class="fw-semibold text-success small">
                    {{ substr($sc->start_time, 0, 5) }} - {{ substr($sc->end_time, 0, 5) }}
                  </div>
                  <small class="text-muted">{{ $sc->slot_minutes }}p/slot</small>
                </div>
                @else
                <span class="text-muted small">Nghỉ</span>
                @endif
              </td>
              @endfor
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  // Search functionality
  document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#tableView tbody tr[data-dentist]');
    
    rows.forEach(row => {
      const dentistName = row.getAttribute('data-dentist');
      if (dentistName.includes(searchTerm)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });

  // View switcher
  function changeView(view) {
    const tableView = document.getElementById('tableView');
    const calendarView = document.getElementById('calendarView');
    const buttons = document.querySelectorAll('.btn-group button');
    
    buttons.forEach(btn => btn.classList.remove('active'));
    
    if (view === 'table') {
      tableView.style.display = 'block';
      calendarView.style.display = 'none';
      buttons[0].classList.add('active');
    } else {
      tableView.style.display = 'none';
      calendarView.style.display = 'block';
      buttons[1].classList.add('active');
    }
  }
</script>

<style>
  .table tbody tr {
    transition: all 0.2s ease;
  }
  .table tbody tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
  }
  .btn {
    transition: all 0.2s ease;
  }
  .btn:hover {
    transform: translateY(-2px);
  }
  .schedule-cell {
    transition: all 0.2s ease;
    cursor: pointer;
  }
  .schedule-cell:hover {
    transform: scale(1.05);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }
  .modal-content {
    border: none;
    border-radius: 15px;
  }
  .input-group-text {
    background-color: transparent;
  }
</style>
@endsection