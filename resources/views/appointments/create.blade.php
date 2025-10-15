@extends('layouts.app')

@section('content')
<h3 class="mb-4">Đặt lịch khám răng</h3>

<form method="GET" action="{{ route('appointments.create') }}" class="mb-3">
  <div class="row g-2">
    <div class="col-md-4">
      <label class="form-label">Bác sĩ</label>
      <select class="form-select" name="dentist_id" required>
        <option value="">-- Chọn bác sĩ --</option>
        @foreach($dentists as $d)
          <option value="{{ $d->id }}" @selected(($selected['dentist_id'] ?? null)==$d->id)>
            {{ $d->user->name }} ({{ $d->specialty }})
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Dịch vụ</label>
      <select class="form-select" name="service_id" required>
        <option value="">-- Chọn dịch vụ --</option>
        @foreach($services as $s)
          <option value="{{ $s->id }}" @selected(($selected['service_id'] ?? null)==$s->id)>
            {{ $s->name }} ({{ number_format($s->price) }}đ / {{ $s->duration_mins }}')
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Ngày khám</label>
      <input type="date" class="form-control" name="date" value="{{ $selected['date'] ?? '' }}" required>
    </div>
    <div class="col-md-1 d-flex align-items-end">
      <button class="btn btn-outline-primary w-100">Tìm giờ</button>
    </div>
  </div>
</form>

@if(!empty($slots))
  <form method="POST" action="{{ route('appointments.store') }}">
    @csrf
    <input type="hidden" name="dentist_id" value="{{ $selected['dentist_id'] }}">
    <input type="hidden" name="service_id" value="{{ $selected['service_id'] }}">
    <input type="hidden" name="date" value="{{ $selected['date'] }}">

    <div class="mb-3">
      <label class="form-label">Chọn giờ trống</label>
      <div class="row">
        @foreach($slots as $i => $t)
          <div class="col-6 col-md-3 mb-2">
            <input type="radio" class="btn-check" name="time" id="slot{{ $i }}" value="{{ $t }}" required>
            <label class="btn btn-outline-success w-100" for="slot{{ $i }}">{{ $t }}</label>
          </div>
        @endforeach
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Ghi chú (tuỳ chọn)</label>
      <textarea class="form-control" name="notes" rows="3" placeholder="Triệu chứng..."></textarea>
    </div>

    <button class="btn btn-primary">Xác nhận đặt lịch</button>
  </form>
@elseif(isset($selected['date']))
  <div class="alert alert-warning">Không có giờ trống cho lựa chọn hiện tại. Vui lòng chọn ngày/giờ khác.</div>
@endif
@endsection
