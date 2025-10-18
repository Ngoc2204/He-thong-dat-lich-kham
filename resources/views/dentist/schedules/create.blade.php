@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Tiêu đề trang --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Thêm Lịch Làm Việc</h2>
        <p class="text-muted">Nhập thông tin ca làm của bác sĩ để quản lý lịch trình hiệu quả hơn</p>
        <hr class="w-25 mx-auto">
    </div>

    {{-- Form thêm lịch --}}
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('dentist.schedules.store') }}">
                        @csrf

                        {{-- Chọn thứ --}}
                        <div class="mb-3">
                            <label for="weekday" class="form-label fw-semibold">Thứ</label>
                            <select name="weekday" id="weekday" class="form-select form-select-lg rounded-3">
                                <option value="monday">Thứ 2</option>
                                <option value="tuesday">Thứ 3</option>
                                <option value="wednesday">Thứ 4</option>
                                <option value="thursday">Thứ 5</option>
                                <option value="friday">Thứ 6</option>
                                <option value="saturday">Thứ 7</option>
                                <option value="sunday">Chủ nhật</option>
                            </select>
                        </div>

                        {{-- Giờ bắt đầu --}}
                        <div class="mb-3">
                            <label for="start_time" class="form-label fw-semibold">Giờ bắt đầu</label>
                            <input type="time" class="form-control form-control-lg rounded-3" name="start_time" required>
                        </div>

                        {{-- Giờ kết thúc --}}
                        <div class="mb-3">
                            <label for="end_time" class="form-label fw-semibold">Giờ kết thúc</label>
                            <input type="time" class="form-control form-control-lg rounded-3" name="end_time" required>
                        </div>

                        {{-- Khoảng cách giữa các ca --}}
                        <div class="mb-4">
                            <label for="slot_minutes" class="form-label fw-semibold">Khoảng cách giữa các ca (phút)</label>
                            <input type="number" class="form-control form-control-lg rounded-3" name="slot_minutes" min="10" required placeholder="Ví dụ: 30">
                        </div>

                        {{-- Nút hành động --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dentist.schedules.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary px-4 rounded-3">
                                <i class="bi bi-check-circle"></i> Lưu lịch
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
