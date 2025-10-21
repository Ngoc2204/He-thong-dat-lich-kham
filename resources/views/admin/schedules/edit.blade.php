@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Sửa lịch làm việc</h2>
      <p class="text-muted mb-0">Cập nhật lịch làm việc hàng tuần cho bác sĩ</p>
    </div>
    <a href="{{ route('schedules.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-2"></i>Quay lại
    </a>
  </div>

  <!-- Form Card -->
  <div class="row">
    <div class="col-lg-8 col-xl-7">
      <form method="POST" action="{{ route('schedules.update', $schedule) }}">
        @csrf
        @method('PUT')
        
        <!-- Chọn bác sĩ và ngày -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-person-badge text-primary me-2"></i>Thông tin cơ bản
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-4">
              <label class="form-label fw-semibold">
                Chọn bác sĩ <span class="text-danger">*</span>
              </label>
              <select class="form-select form-select-lg @error('dentist_id') is-invalid @enderror" 
                      name="dentist_id"
                      id="dentistSelect"
                      required>
                <option value="">-- Chọn bác sĩ --</option>
                @foreach($dentists as $d)
                <option value="{{ $d->id }}" 
                        data-specialty="{{ $d->specialty }}"
                        data-avatar="{{ $d->avatar ? asset('storage/' . $d->avatar) : '' }}"
                        {{ $d->id == $schedule->dentist_id ? 'selected' : '' }}>
                  {{ $d->user->name }} - {{ $d->specialty }}
                </option>
                @endforeach
              </select>
              @error('dentist_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              
              <!-- Selected dentist preview -->
              <div id="dentistPreview" class="mt-3 p-3 bg-light rounded @if(!$schedule->dentist_id) d-none @endif">
                <div class="d-flex align-items-center">
                  <img id="dentistAvatar" 
                       src="{{ $schedule->dentist ? ($schedule->dentist->avatar ? asset('storage/' . $schedule->dentist->avatar) : '') : '' }}" 
                       class="rounded-circle me-3" 
                       style="width: 50px; height: 50px; object-fit: cover;">
                  <div>
                    <div class="fw-semibold" id="dentistName">{{ $schedule->dentist ? $schedule->dentist->user->name : '' }}</div>
                    <small class="text-muted" id="dentistSpecialty">{{ $schedule->dentist ? $schedule->dentist->specialty : '' }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">
                Ngày trong tuần <span class="text-danger">*</span>
              </label>
              <div class="row g-2">
                @php
                  $weekdays = [
                    ['value' => 0, 'label' => 'Chủ nhật', 'short' => 'CN', 'color' => 'danger'],
                    ['value' => 1, 'label' => 'Thứ 2', 'short' => 'T2', 'color' => 'primary'],
                    ['value' => 2, 'label' => 'Thứ 3', 'short' => 'T3', 'color' => 'success'],
                    ['value' => 3, 'label' => 'Thứ 4', 'short' => 'T4', 'color' => 'warning'],
                    ['value' => 4, 'label' => 'Thứ 5', 'short' => 'T5', 'color' => 'info'],
                    ['value' => 5, 'label' => 'Thứ 6', 'short' => 'T6', 'color' => 'secondary'],
                    ['value' => 6, 'label' => 'Thứ 7', 'short' => 'T7', 'color' => 'dark'],
                  ];
                @endphp
                @foreach($weekdays as $day)
                <div class="col">
                  <input type="radio" 
                         class="btn-check" 
                         name="weekday" 
                         id="weekday{{ $day['value'] }}" 
                         value="{{ $day['value'] }}"
                         {{ $schedule->weekday == $day['value'] ? 'checked' : '' }}
                         required>
                  <label class="btn btn-outline-{{ $day['color'] }} w-100" for="weekday{{ $day['value'] }}">
                    <div class="fw-bold">{{ $day['short'] }}</div>
                    <small class="d-none d-md-block">{{ $day['label'] }}</small>
                  </label>
                </div>
                @endforeach
              </div>
              @error('weekday')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <!-- Giờ làm việc -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-clock text-success me-2"></i>Giờ làm việc
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Giờ bắt đầu <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-sunrise"></i></span>
                  <input type="time" 
                         class="form-control @error('start_time') is-invalid @enderror" 
                         name="start_time" 
                         id="startTime"
                         value="{{ $schedule->start_time }}"
                         required>
                  @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Giờ kết thúc <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-sunset"></i></span>
                  <input type="time" 
                         class="form-control @error('end_time') is-invalid @enderror" 
                         name="end_time" 
                         id="endTime"
                         value="{{ $schedule->end_time }}"
                         required>
                  @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Quick time presets -->
            <div class="mb-3">
              <label class="form-label fw-semibold small text-muted">Chọn nhanh khung giờ:</label>
              <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setTimeRange('08:00', '12:00')">
                  <i class="bi bi-sunrise me-1"></i>Sáng (8h-12h)
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setTimeRange('13:00', '17:00')">
                  <i class="bi bi-sun me-1"></i>Chiều (13h-17h)
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setTimeRange('08:00', '17:00')">
                  <i class="bi bi-brightness-high me-1"></i>Cả ngày (8h-17h)
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setTimeRange('09:00', '21:00')">
                  <i class="bi bi-moon-stars me-1"></i>Mở cửa kéo dài (9h-21h)
                </button>
              </div>
            </div>

            <!-- Time duration display -->
            <div class="alert alert-light mb-0">
              <div class="d-flex align-items-center">
                <i class="bi bi-info-circle text-primary me-2"></i>
                <span>Tổng thời gian làm việc: <strong id="totalHours">8.0</strong> giờ</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Cấu hình slot -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-grid-3x3 text-warning me-2"></i>Cấu hình slot đặt lịch
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">
                Thời lượng mỗi slot <span class="text-danger">*</span>
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-hourglass-split"></i></span>
                <input type="number" 
                       class="form-control @error('slot_minutes') is-invalid @enderror" 
                       name="slot_minutes" 
                       id="slotMinutes"
                       value="{{ $schedule->slot_minutes }}"
                       min="10"
                       max="120"
                       step="5"
                       required>
                <span class="input-group-text">phút</span>
                @error('slot_minutes')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Quick slot presets -->
            <div class="mb-3">
              <label class="form-label fw-semibold small text-muted">Chọn nhanh thời lượng:</label>
              <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setSlot(15)">15 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setSlot(20)">20 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setSlot(30)">30 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setSlot(45)">45 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setSlot(60)">1 giờ</button>
              </div>
            </div>

            <!-- Slot calculation -->
            <div class="alert alert-success mb-0">
              <div class="row text-center">
                <div class="col-md-4">
                  <small class="text-muted d-block">Tổng số slot</small>
                  <h4 class="fw-bold mb-0" id="totalSlots">16</h4>
                </div>
                <div class="col-md-4">
                  <small class="text-muted d-block">Thời lượng/slot</small>
                  <h4 class="fw-bold mb-0" id="slotDuration">30</h4>
                </div>
                <div class="col-md-4">
                  <small class="text-muted d-block">Tổng phút</small>
                  <h4 class="fw-bold mb-0" id="totalMinutes">480</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
          <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>Cập nhật lịch làm việc
          </button>
          <a href="{{ route('schedules.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
            <i class="bi bi-x-circle me-2"></i>Hủy bỏ
          </a>
        </div>
      </form>
    </div>

    <!-- Preview Card -->
    <div class="col-lg-4 col-xl-5">
      <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
        <div class="card-header bg-primary text-white py-3">
          <h6 class="mb-0 fw-semibold">
            <i class="bi bi-eye me-2"></i>Xem trước lịch
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                 style="width: 80px; height: 80px;">
              <i class="bi bi-calendar-week fs-1 text-primary"></i>
            </div>
            <h5 class="fw-bold mb-1" id="previewDentist">{{ $schedule->dentist ? $schedule->dentist->user->name : 'Chọn bác sĩ' }}</h5>
            <span class="badge bg-info bg-opacity-10 text-info" id="previewDay">Thứ 2</span>
          </div>

          <div class="mb-3">
            <label class="text-muted small mb-2">Giờ làm việc</label>
            <div class="d-flex align-items-center justify-content-center gap-2 p-3 bg-light rounded">
              <span class="fs-4 fw-bold text-success" id="previewStart">{{ $schedule->start_time }}</span>
              <i class="bi bi-arrow-right-circle text-muted"></i>
              <span class="fs-4 fw-bold text-danger" id="previewEnd">{{ $schedule->end_time }}</span>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-6">
              <div class="text-center p-3 bg-light rounded">
                <small class="text-muted d-block mb-1">Tổng giờ</small>
                <h5 class="fw-bold mb-0" id="previewHours">8.0h</h5>
              </div>
            </div>
            <div class="col-6">
              <div class="text-center p-3 bg-light rounded">
                <small class="text-muted d-block mb-1">Slot</small>
                <h5 class="fw-bold mb-0" id="previewSlots">16</h5>
              </div>
            </div>
          </div>

          <div class="alert alert-light mb-0">
            <small class="text-muted">
              <i class="bi bi-info-circle me-1"></i>
              Bệnh nhân có thể đặt lịch trong <span class="fw-bold" id="previewSlotCount">16</span> khung giờ
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const weekdayLabels = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];

  function calculateSchedule() {
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
    const slotMinutes = parseInt(document.getElementById('slotMinutes').value) || 30;
    
    if (startTime && endTime) {
      const start = new Date('2000-01-01 ' + startTime);
      const end = new Date('2000-01-01 ' + endTime);
      const diffMs = end - start;
      const diffHours = diffMs / (1000 * 60 * 60);
      const diffMinutes = diffMs / (1000 * 60);
      const slots = Math.floor(diffMinutes / slotMinutes);
      
      document.getElementById('totalHours').textContent = diffHours.toFixed(1);
      document.getElementById('totalSlots').textContent = slots;
      document.getElementById('slotDuration').textContent = slotMinutes;
      document.getElementById('totalMinutes').textContent = Math.floor(diffMinutes);
      
      document.getElementById('previewStart').textContent = startTime;
      document.getElementById('previewEnd').textContent = endTime;
      document.getElementById('previewHours').textContent = diffHours.toFixed(1) + 'h';
      document.getElementById('previewSlots').textContent = slots;
      document.getElementById('previewSlotCount').textContent = slots;
    }
  }

  function setTimeRange(start, end) {
    document.getElementById('startTime').value = start;
    document.getElementById('endTime').value = end;
    calculateSchedule();
  }

  function setSlot(minutes) {
    document.getElementById('slotMinutes').value = minutes;
    calculateSchedule();
  }

  document.getElementById('dentistSelect').addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    if (option.value) {
      const name = option.text.split(' - ')[0];
      const avatar = option.dataset.avatar;
      
      document.getElementById('previewDentist').textContent = name;
      
      if (avatar) {
        const preview = document.getElementById('dentistPreview');
        preview.classList.remove('d-none');
        document.getElementById('dentistAvatar').src = avatar;
        document.getElementById('dentistName').textContent = name;
        document.getElementById('dentistSpecialty').textContent = option.dataset.specialty;
      }
    }
  });

  document.querySelectorAll('input[name="weekday"]').forEach(radio => {
    radio.addEventListener('change', function() {
      document.getElementById('previewDay').textContent = weekdayLabels[this.value];
    });
  });

  document.getElementById('startTime').addEventListener('change', calculateSchedule);
  document.getElementById('endTime').addEventListener('change', calculateSchedule);
  document.getElementById('slotMinutes').addEventListener('input', calculateSchedule);

  document.addEventListener('DOMContentLoaded', function() {
    calculateSchedule();
    
    const checkedWeekday = document.querySelector('input[name="weekday"]:checked');
    if (checkedWeekday) {
      document.getElementById('previewDay').textContent = weekdayLabels[checkedWeekday.value];
    }
  });
</script>

<style>
  .btn-check:checked + .btn {
    transform: scale(1.05);
  }
  
  .form-control:focus,
  .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
  }
  
  .input-group-text {
    background-color: #f8f9fa;
  }
  
  .card {
    transition: all 0.3s ease;
  }
</style>
@endsection