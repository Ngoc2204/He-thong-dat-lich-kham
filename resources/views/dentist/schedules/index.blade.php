@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Tiêu đề trang --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Lịch Làm Việc Của Tôi</h2>
        <p class="text-muted">Theo dõi và quản lý thời gian làm việc của bạn dễ dàng</p>
        <hr class="w-25 mx-auto">
    </div>

    {{-- Nút thêm mới --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('dentist.schedules.create') }}" class="btn btn-success rounded-3 shadow-sm px-4">
            <i class="bi bi-plus-circle"></i> Thêm lịch làm việc
        </a>
    </div>

    {{-- Bảng lịch làm việc --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @if($schedules->isEmpty())
                <div class="text-center text-muted py-4">
                    <i class="bi bi-calendar-x display-5 d-block mb-3"></i>
                    <h5>Chưa có lịch làm việc</h5>
                    <p>Nhấn nút <strong>“Thêm lịch làm việc”</strong> để bắt đầu tạo lịch mới.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-hover text-center">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Thứ</th>
                                <th scope="col">Giờ bắt đầu</th>
                                <th scope="col">Giờ kết thúc</th>
                                <th scope="col">Khoảng cách (phút)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $s)
                                <tr>
                                    <td class="fw-semibold">{{ ucfirst($s->weekday) }}</td>
                                    <td>{{ $s->start_time }}</td>
                                    <td>{{ $s->end_time }}</td>
                                    <td>{{ $s->slot_minutes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection