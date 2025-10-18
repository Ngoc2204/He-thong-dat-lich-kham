@extends('layouts.app')

@section('content')
    <div class="appointment-booking-page">
        <!-- Header Section -->
        <div class="booking-header text-center mb-5">
            <div class="icon-wrapper mb-3">
                <i class="bi bi-calendar-heart"></i>
            </div>
            <h2 class="fw-bold mb-2">Đặt lịch khám răng</h2>
            <p class="text-muted">Chọn thông tin để tìm giờ khám phù hợp</p>
        </div>

        <!-- Search Form -->
        <div class="booking-form-card mb-4">
            <form method="GET" action="{{ route('appointments.create') }}">
                <div class="row g-3 align-items-end justify-content-center">
                    <!-- Bác sĩ -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-badge text-primary me-2"></i>Chọn bác sĩ
                        </label>
                        <select class="form-select form-select-modern" name="dentist_id" required>
                            <option value="">-- Chọn bác sĩ --</option>
                            @foreach ($dentists as $d)
                                <option value="{{ $d->id }}" @selected(($selected['dentist_id'] ?? null) == $d->id)>
                                    {{ $d->user->name }} - {{ $d->specialty }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dịch vụ -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-heart-pulse text-danger me-2"></i>Chọn dịch vụ
                        </label>
                        <select class="form-select form-select-modern" name="service_id" required>
                            <option value="">-- Chọn dịch vụ --</option>
                            @foreach ($services as $s)
                                <option value="{{ $s->id }}" @selected(($selected['service_id'] ?? null) == $s->id)>
                                    {{ $s->name }} ({{ number_format($s->price) }}đ - {{ $s->duration_mins }}')
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ngày khám -->
                    <div class="col-md-4 col-lg-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-calendar-event text-success me-2"></i>Ngày khám
                        </label>
                        <input type="date" class="form-control form-control-modern" name="date"
                            value="{{ $selected['date'] ?? '' }}" required>
                    </div>

                    <!-- Nút tìm giờ khám (đưa ra giữa) -->
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-gradient px-5 py-2 d-inline-flex align-items-center gap-2" type="submit">
                            <i class="bi bi-search"></i>
                            <span>Tìm giờ khám</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        </form>
    </div>

    @if (!empty($slots))
        <!-- Available Slots Section -->
        <div class="slots-section">
            <div class="section-header mb-4">
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Giờ khám trống
                </h4>
                <p class="text-muted mb-0">Vui lòng chọn giờ khám phù hợp</p>
            </div>

            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <input type="hidden" name="dentist_id" value="{{ $selected['dentist_id'] }}">
                <input type="hidden" name="service_id" value="{{ $selected['service_id'] }}">
                <input type="hidden" name="date" value="{{ $selected['date'] }}">

                <!-- Time Slots & Notes Row -->
                <div class="row g-4 mb-4">
                    <!-- Time Slots Grid - Left Side -->
                    <div class="col-lg-7">
                        <div class="time-slots-wrapper">
                            <div class="time-slots-grid">
                                @foreach ($slots as $i => $t)
                                    <div class="time-slot-item">
                                        <input type="radio" class="btn-check" name="time" id="slot{{ $i }}"
                                            value="{{ $t }}" required>
                                        <label class="time-slot-label" for="slot{{ $i }}">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ $t }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section - Right Side -->
                    <div class="col-lg-5">
                        <div class="notes-card h-100">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-pencil-square text-info me-2"></i>Ghi chú (không bắt buộc)
                            </label>
                            <textarea class="form-control form-control-modern" name="notes" rows="10"
                                placeholder="Mô tả triệu chứng hoặc lý do khám...&#10;&#10;Ví dụ:&#10;• Đau răng bên trái&#10;• Chảy máu chân răng&#10;• Răng ê buốt khi ăn lạnh"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button class="btn btn-confirm-booking" type="submit">
                        <i class="bi bi-check-circle me-2"></i>
                        Xác nhận đặt lịch
                    </button>
                </div>
            </form>
        </div>
    @elseif(isset($selected['date']))
        <!-- No Slots Available -->
        <div class="no-slots-card">
            <div class="text-center">
                <i class="bi bi-calendar-x mb-3"></i>
                <h5 class="fw-bold mb-2">Không có giờ trống</h5>
                <p class="text-muted mb-0">
                    Vui lòng chọn ngày khác hoặc thử với bác sĩ/dịch vụ khác
                </p>
            </div>
        </div>
    @endif
    </div>


@endsection
