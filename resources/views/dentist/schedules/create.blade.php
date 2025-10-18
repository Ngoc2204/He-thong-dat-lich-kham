@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">Thêm lịch làm việc</h3>

  <form method="POST" action="{{ route('dentist.schedules.store') }}">
    @csrf
    <div class="mb-3">
      <label for="weekday" class="form-label">Thứ</label>
      <select name="weekday" id="weekday" class="form-select">
        <option value="monday">Thứ 2</option>
        <option value="tuesday">Thứ 3</option>
        <option value="wednesday">Thứ 4</option>
        <option value="thursday">Thứ 5</option>
        <option value="friday">Thứ 6</option>
        <option value="saturday">Thứ 7</option>
        <option value="sunday">Chủ nhật</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="start_time" class="form-label">Giờ bắt đầu</label>
      <input type="time" class="form-control" name="start_time" required>
    </div>

    <div class="mb-3">
      <label for="end_time" class="form-label">Giờ kết thúc</label>
      <input type="time" class="form-control" name="end_time" required>
    </div>

    <div class="mb-3">
      <label for="slot_minutes" class="form-label">Khoảng cách giữa các ca (phút)</label>
      <input type="number" class="form-control" name="slot_minutes" min="10" required>
    </div>

    <button type="submit" class="btn btn-success">Lưu lịch làm việc</button>
    <a href="{{ route('dentist.schedules.index') }}" class="btn btn-secondary">Quay lại</a>

  </form>
</div>
@endsection
