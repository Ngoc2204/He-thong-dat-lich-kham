@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Thêm lịch hẹn</h2>
      <p class="text-muted mb-0">Đặt lịch khám bệnh cho bệnh nhân</p>
    </div>
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-2"></i>Quay lại
    </a>
  </div>

  <div class="row">
    <div class="col-lg-8 col-xl-7">
      <form method="POST" action="{{ route('admin.appointments.store') }}" id="appointmentForm">
        @csrf

        <!-- Chọn bệnh nhân -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-person text-primary me-2"></i>Thông tin bệnh nhân
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">
                Chọn bệnh nhân <span class="text-danger">*</span>
              </label>
              <select class="form-select form-select-lg @error('patient_id') is-invalid @enderror"
                      name="patient_id"
                      id="patientSelect"
                      required>
                <option value="">-- Chọn bệnh nhân --</option>
                @foreach($patients as $p)
                <option value="{{ $p->id }}"
                        data-phone="{{ $p->phone }}"
                        data-email="{{ $p->email }}"
                        {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                  {{ $p->name }}
                </option>
                @endforeach
              </select>
              @error('patient_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <!-- Selected patient preview -->
              <div id="patientPreview" class="mt-3 p-3 bg-light rounded d-none">
                <div class="row g-3">
                  <div class="col-sm-6">
                    <small class="text-muted d-block mb-1">Số điện thoại</small>
                    <div class="fw-semibold" id="patientPhone"></div>
                  </div>
                  <div class="col-sm-6">
                    <small class="text-muted d-block mb-1">Email</small>
                    <div class="fw-semibold text-break" id="patientEmail"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Chọn bác sĩ và dịch vụ -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-stethoscope text-success me-2"></i>Bác sĩ và dịch vụ
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="row">
              <div class="col-lg-6 mb-3">
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
                          {{ old('dentist_id') == $d->id ? 'selected' : '' }}>
                    {{ $d->user->name }} - {{ $d->specialty }}
                  </option>
                  @endforeach
                </select>
                @error('dentist_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-6 mb-3">
                <label class="form-label fw-semibold">
                  Chọn dịch vụ <span class="text-danger">*</span>
                </label>
                <select class="form-select form-select-lg @error('service_id') is-invalid @enderror"
                        name="service_id"
                        id="serviceSelect"
                        required>
                  <option value="">-- Chọn dịch vụ --</option>
                  @foreach($services as $s)
                  <option value="{{ $s->id }}"
                          data-duration="{{ $s->duration }}"
                          data-price="{{ $s->price }}"
                          {{ old('service_id') == $s->id ? 'selected' : '' }}>
                    {{ $s->name }}
                  </option>
                  @endforeach
                </select>
                @error('service_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Selected dentist and service preview -->
            <div id="dentistServicePreview" class="mt-3 p-3 bg-light rounded d-none">
              <div class="row g-3">
                <div class="col-sm-6">
                  <small class="text-muted d-block mb-1">Chuyên khoa</small>
                  <div class="fw-semibold" id="dentistSpecialty"></div>
                </div>
                <div class="col-sm-6">
                  <small class="text-muted d-block mb-1">Thời gian dự kiến</small>
                  <div class="fw-semibold" id="serviceDuration"></div>
                </div>
                <div class="col-sm-6">
                  <small class="text-muted d-block mb-1">Giá dịch vụ</small>
                  <div class="fw-semibold text-success" id="servicePrice"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ngày giờ -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-calendar-check text-warning me-2"></i>Ngày giờ hẹn
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="row">
              <div class="col-lg-6 mb-3">
                <label class="form-label fw-semibold">
                  Ngày hẹn <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                  <input type="date"
                         class="form-control @error('appointment_date') is-invalid @enderror"
                         name="appointment_date"
                         id="appointmentDate"
                         value="{{ old('appointment_date', date('Y-m-d')) }}"
                         min="{{ date('Y-m-d') }}"
                         required>
                  @error('appointment_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-lg-6 mb-3">
                <label class="form-label fw-semibold">
                  Giờ hẹn <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-clock"></i></span>
                  <input type="time"
                         class="form-control @error('appointment_time') is-invalid @enderror"
                         name="appointment_time"
                         id="appointmentTime"
                         value="{{ old('appointment_time', '09:00') }}"
                         required>
                  @error('appointment_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Available slots -->
            <div id="availableSlots" class="mt-3 d-none">
              <label class="form-label fw-semibold">Khung giờ có sẵn</label>
              <div class="row g-2" id="slotsContainer"></div>
            </div>

            <!-- Duration info -->
            <div class="alert alert-info mt-3 mb-0">
              <div class="d-flex align-items-center">
                <i class="bi bi-info-circle me-2"></i>
                <span>Thời gian dịch vụ: <strong id="durationInfo">--</strong> phút</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Ghi chú -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-sticky text-info me-2"></i>Ghi chú
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-0">
              <label class="form-label fw-semibold">Ghi chú thêm (không bắt buộc)</label>
              <textarea class="form-control @error('notes') is-invalid @enderror"
                        name="notes"
                        id="notes"
                        rows="4"
                        placeholder="Ghi chú về tình trạng bệnh nhân, yêu cầu đặc biệt...">{{ old('notes') }}</textarea>
              @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
          <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>Tạo lịch hẹn
          </button>
          <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
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
            <i class="bi bi-eye me-2"></i>Xem trước lịch hẹn
          </h6>
        </div>
        <div class="card-body p-4">
          <!-- Patient Info -->
          <div class="mb-4">
            <small class="text-muted d-block mb-2">Bệnh nhân</small>
            <h6 class="fw-bold mb-0" id="previewPatient">--</h6>
          </div>

          <!-- Dentist Info -->
          <div class="mb-4">
            <small class="text-muted d-block mb-2">Bác sĩ</small>
            <h6 class="fw-bold mb-0" id="previewDentist">--</h6>
          </div>

          <!-- Service Info -->
          <div class="mb-4">
            <small class="text-muted d-block mb-2">Dịch vụ</small>
            <h6 class="fw-bold mb-0" id="previewService">--</h6>
          </div>

          <!-- DateTime Info -->
          <div class="mb-4">
            <small class="text-muted d-block mb-2">Thời gian</small>
            <div class="d-flex align-items-center gap-2 p-3 bg-light rounded">
              <i class="bi bi-calendar-event text-primary"></i>
              <div>
                <div class="fw-bold" id="previewDate">--</div>
                <small class="text-muted" id="previewTime">--</small>
              </div>
            </div>
          </div>

          <!-- Price Info -->
          <div class="alert alert-success mb-0">
            <small class="text-muted d-block mb-1">Giá dịch vụ</small>
            <h5 class="fw-bold mb-0 text-success" id="previewPrice">--</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const patientSelect = document.getElementById('patientSelect');
  const dentistSelect = document.getElementById('dentistSelect');
  const serviceSelect = document.getElementById('serviceSelect');
  const appointmentDate = document.getElementById('appointmentDate');
  const appointmentTime = document.getElementById('appointmentTime');

  // Update patient preview
  patientSelect.addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    const preview = document.getElementById('patientPreview');
    
    if (option.value) {
      document.getElementById('previewPatient').textContent = option.text;
      document.getElementById('patientPhone').textContent = option.dataset.phone || '--';
      document.getElementById('patientEmail').textContent = option.dataset.email || '--';
      preview.classList.remove('d-none');
    } else {
      preview.classList.add('d-none');
      document.getElementById('previewPatient').textContent = '--';
    }
  });

  // Update dentist preview
  dentistSelect.addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    const preview = document.getElementById('dentistServicePreview');
    
    if (option.value) {
      document.getElementById('previewDentist').textContent = option.text;
      document.getElementById('dentistSpecialty').textContent = option.dataset.specialty || '--';
      preview.classList.remove('d-none');
    } else {
      preview.classList.add('d-none');
      document.getElementById('previewDentist').textContent = '--';
    }
  });

  // Update service preview
  serviceSelect.addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    const preview = document.getElementById('dentistServicePreview');
    
    if (option.value) {
      document.getElementById('previewService').textContent = option.text;
      document.getElementById('serviceDuration').textContent = option.dataset.duration + ' phút' || '--';
      document.getElementById('durationInfo').textContent = option.dataset.duration || '--';
      
      const price = parseFloat(option.dataset.price) || 0;
      document.getElementById('servicePrice').textContent = price.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
      });
      document.getElementById('previewPrice').textContent = price.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
      });
      preview.classList.remove('d-none');
    } else {
      preview.classList.add('d-none');
      document.getElementById('previewService').textContent = '--';
      document.getElementById('previewPrice').textContent = '--';
      document.getElementById('durationInfo').textContent = '--';
    }
  });

  // Update date and time preview
  appointmentDate.addEventListener('change', updateDateTimePreview);
  appointmentTime.addEventListener('change', updateDateTimePreview);

  function updateDateTimePreview() {
    const date = appointmentDate.value;
    const time = appointmentTime.value;
    
    if (date) {
      const dateObj = new Date(date + 'T00:00:00');
      document.getElementById('previewDate').textContent = dateObj.toLocaleDateString('vi-VN', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    }
    
    if (time) {
      document.getElementById('previewTime').textContent = time;
    }
  }

  // Initialize preview on page load
  document.addEventListener('DOMContentLoaded', function() {
    if (patientSelect.value) patientSelect.dispatchEvent(new Event('change'));
    if (dentistSelect.value) dentistSelect.dispatchEvent(new Event('change'));
    if (serviceSelect.value) serviceSelect.dispatchEvent(new Event('change'));
    updateDateTimePreview();
  });
</script>

<style>
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

  .sticky-top {
    z-index: 900;
  }
</style>
@endsection