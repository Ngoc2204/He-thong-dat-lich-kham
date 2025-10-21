@extends('layouts.dentist')

@section('content')
<div class="container py-5">

    {{-- Tiêu đề trang --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary mb-3">
            <i class="bi bi-calendar-plus-fill me-2"></i>Thêm Lịch Làm Việc
        </h1>
        <p class="text-muted fs-6">Thiết lập ca làm việc để quản lý lịch khám bệnh hiệu quả</p>
    </div>

    {{-- Form thêm lịch --}}
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                
                {{-- Header card --}}
                <div class="card-header bg-primary bg-gradient text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-clipboard-check me-2"></i>Thông tin ca làm việc
                    </h5>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('dentist.schedules.store') }}">
                        @csrf

                        {{-- Chọn thứ --}}
                        <div class="mb-4">
                            <label for="weekday" class="form-label fw-semibold text-dark mb-2">
                                <i class="bi bi-calendar-week text-primary me-2"></i>Ngày trong tuần
                            </label>
                            <select name="weekday" id="weekday" class="form-select form-select-lg rounded-3 shadow-sm border-2" required>
                                <option value="">-- Chọn ngày --</option>
                                <option value="monday">Thứ Hai</option>
                                <option value="tuesday">Thứ Ba</option>
                                <option value="wednesday">Thứ Tư</option>
                                <option value="thursday">Thứ Năm</option>
                                <option value="friday">Thứ Sáu</option>
                                <option value="saturday">Thứ Bảy</option>
                                <option value="sunday">Chủ Nhật</option>
                            </select>
                        </div>

                        {{-- Thời gian làm việc --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="start_time" class="form-label fw-semibold text-dark mb-2">
                                    <i class="bi bi-clock text-success me-2"></i>Giờ bắt đầu
                                </label>
                                <input type="time" class="form-control form-control-lg rounded-3 shadow-sm border-2" 
                                       name="start_time" id="start_time" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_time" class="form-label fw-semibold text-dark mb-2">
                                    <i class="bi bi-clock-fill text-danger me-2"></i>Giờ kết thúc
                                </label>
                                <input type="time" class="form-control form-control-lg rounded-3 shadow-sm border-2" 
                                       name="end_time" id="end_time" required>
                            </div>
                        </div>

                        {{-- Khoảng cách giữa các ca --}}
                        <div class="mb-4">
                            <label for="slot_minutes" class="form-label fw-semibold text-dark mb-2">
                                <i class="bi bi-hourglass-split text-warning me-2"></i>Thời lượng mỗi ca khám (phút)
                            </label>
                            <input type="number" class="form-control form-control-lg rounded-3 shadow-sm border-2" 
                                   name="slot_minutes" id="slot_minutes" min="10" max="180" step="5" 
                                   required placeholder="Ví dụ: 30, 45, 60">
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>Khuyến nghị: 30-60 phút/ca
                            </div>
                        </div>

                        {{-- Thông báo lưu ý --}}
                        <div class="alert alert-info border-0 rounded-3 d-flex align-items-start mb-4" role="alert">
                            <i class="bi bi-lightbulb-fill fs-5 me-2 mt-1"></i>
                            <div>
                                <strong>Lưu ý:</strong> Hệ thống sẽ tự động tạo các khung giờ khám dựa trên thời gian và khoảng cách bạn thiết lập.
                            </div>
                        </div>

                        {{-- Nút hành động --}}
                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 pt-3 border-top">
                            <a href="{{ route('dentist.schedules.index') }}" 
                               class="btn btn-outline-secondary btn-lg px-4 rounded-3 order-2 order-sm-1">
                                <i class="bi bi-arrow-left me-2"></i>Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-3 shadow order-1 order-sm-2">
                                <i class="bi bi-check-circle-fill me-2"></i>Lưu lịch làm việc
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Hướng dẫn nhanh --}}
            <div class="card border-0 bg-light rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-question-circle-fill text-primary me-2"></i>Hướng dẫn sử dụng
                    </h6>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Chọn ngày trong tuần bạn muốn làm việc
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Đặt giờ bắt đầu và kết thúc ca làm việc
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Nhập thời lượng cho mỗi ca khám (tối thiểu 10 phút)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .card {
        transition: all 0.3s ease;
    }

    .alert-info {
        background: linear-gradient(135deg, #cfe2ff 0%, #e7f3ff 100%);
    }
</style>
@endsection