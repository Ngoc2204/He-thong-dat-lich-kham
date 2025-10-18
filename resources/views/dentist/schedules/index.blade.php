@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">Lịch làm việc của tôi</h3>

  <a href="{{ route('dentist.schedules.create') }}" class="btn btn-primary mb-3">
    + Thêm lịch làm việc
  </a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Thứ</th>
        <th>Giờ bắt đầu</th>
        <th>Giờ kết thúc</th>
        <th>Khoảng cách (phút)</th>
      </tr>
    </thead>
    <tbody>
      @forelse($schedules as $s)
        <tr>
          <td>{{ ucfirst($s->weekday) }}</td>
          <td>{{ $s->start_time }}</td>
          <td>{{ $s->end_time }}</td>
          <td>{{ $s->slot_minutes }}</td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center">Chưa có lịch làm việc</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
