@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Tiêu đề trang --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Lịch Hẹn Khám Sắp Tới</h2>
        <p class="text-muted">Theo dõi và quản lý lịch hẹn với bệnh nhân của bạn dễ dàng</p>
        <hr class="w-25 mx-auto">
    </div>

    {{-- Nút đăng ký lịch làm việc --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('dentist.schedules.create') }}" class="btn btn-success rounded-3 shadow-sm px-4">
            <i class="bi bi-calendar-plus"></i> Đăng ký lịch làm việc
        </a>
    </div>

    {{-- Bảng danh sách lịch hẹn --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @if($appointments->isEmpty())
                <div class="text-center text-muted py-5">
                    <i class="bi bi-calendar-x display-5 d-block mb-3"></i>
                    <h5>Chưa có lịch hẹn nào</h5>
                    <p>Các lịch hẹn của bạn sẽ hiển thị tại đây khi bệnh nhân đặt lịch.</p>
                    <a href="{{ route('dentist.schedules.create') }}" class="btn btn-outline-primary mt-3">
                        <i class="bi bi-calendar-plus"></i> Đăng ký lịch làm việc
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-hover text-center">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Bệnh nhân</th>
                                <th scope="col">Dịch vụ</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $a)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $a->starts_at->format('d/m/Y H:i') }} - {{ $a->ends_at->format('H:i') }}
                                    </td>
                                    <td>{{ $a->patient->name }}</td>
                                    <td>{{ $a->service->name }}</td>
                                    <td>
                                        @php
                                            $badgeColors = [
                                                'pending' => 'secondary',
                                                'confirmed' => 'info',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $badgeColors[$a->status] ?? 'secondary' }}">
                                            {{ ucfirst($a->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('dentist.appointments.status', $a) }}" class="d-flex justify-content-center align-items-center gap-2">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm w-auto shadow-sm">
                                                <option value="pending" @selected($a->status=='pending')>pending</option>
                                                <option value="confirmed" @selected($a->status=='confirmed')>confirmed</option>
                                                <option value="completed" @selected($a->status=='completed')>completed</option>
                                                <option value="cancelled" @selected($a->status=='cancelled')>cancelled</option>
                                            </select>
                                            <button class="btn btn-sm btn-outline-primary rounded-3 shadow-sm">
                                                <i class="bi bi-save"></i> Lưu
                                            </button>
                                        </form>
                                    </td>
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
