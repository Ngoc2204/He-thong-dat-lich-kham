@extends('layouts.app')

@section('content')
<h3 class="mb-3">Sửa lịch làm việc</h3>
<form method="POST" action="{{ route('schedules.update', $schedule) }}">
  @csrf @method('PUT')
  <div class="row">
    <div class="col-md-4 mb-3">
      <label class="form-label">Bác sĩ</label>
      <select class="form-select" name="dentist_id">
        @foreach($dentists as $d)
          <option value="{{ $d->id }}" @selected($d->id==$schedule->dentist_id)>{{ $d->user->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2 mb-3">
      <label class="form-label">Thứ</label>
      <select class="form-select" name="weekday">
        @for($i=0;$i<7;$i++)
          <option value="{{ $i }}" @selected($i==$schedule->weekday)>{{ ['CN','T2','T3','T4','T5','T6','T7'][$i] }}</option>
        @endfor
      </select>
    </div>
    <div class="col-md-2 mb-3">
      <label class="form-label">Bắt đầu</label>
      <input class="form-control" type="time" name="start_time" value="{{ $schedule->start_time }}">
    </div>
    <div class="col-md-2 mb-3">
      <label class="form-label">Kết thúc</label>
      <input class="form-control" type="time" name="end_time" value="{{ $schedule->end_time }}">
    </div>
    <div class="col-md-2 mb-3">
      <label class="form-label">Slot (phút)</label>
      <input class="form-control" type="number" name="slot_minutes" value="{{ $schedule->slot_minutes }}">
    </div>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
