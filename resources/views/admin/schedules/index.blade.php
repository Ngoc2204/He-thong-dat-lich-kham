@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Lịch làm việc (hàng tuần)</h3>
  <a class="btn btn-primary" href="{{ route('schedules.create') }}">+ Thêm lịch</a>
</div>

<table class="table table-bordered">
  <thead><tr><th>Bác sĩ</th><th>Thứ</th><th>Bắt đầu</th><th>Kết thúc</th><th>Slot (phút)</th><th></th></tr></thead>
  <tbody>
    @foreach($schedules as $sc)
    <tr>
      <td>{{ $sc->dentist->user->name }}</td>
      <td>{{ ['CN','T2','T3','T4','T5','T6','T7'][$sc->weekday] }}</td>
      <td>{{ $sc->start_time }}</td>
      <td>{{ $sc->end_time }}</td>
      <td>{{ $sc->slot_minutes }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('schedules.edit', $sc) }}">Sửa</a>
        <form action="{{ route('schedules.destroy', $sc) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa lịch này?')">Xóa</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
