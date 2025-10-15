@extends('layouts.app')

@section('content')
<h3 class="mb-3">Lịch làm việc của bác sĩ (sắp tới)</h3>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Thời gian</th>
      <th>Bệnh nhân</th>
      <th>Dịch vụ</th>
      <th>Trạng thái</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
  @forelse($appointments as $a)
    <tr>
      <td>{{ $a->starts_at->format('d/m/Y H:i') }} - {{ $a->ends_at->format('H:i') }}</td>
      <td>{{ $a->patient->name }}</td>
      <td>{{ $a->service->name }}</td>
      <td><span class="badge text-bg-secondary">{{ $a->status }}</span></td>
      <td>
        <form method="POST" action="{{ route('dentist.appointments.status', $a) }}" class="d-flex gap-2">
          @csrf
          <select name="status" class="form-select form-select-sm w-auto">
            <option value="pending" @selected($a->status=='pending')>pending</option>
            <option value="confirmed" @selected($a->status=='confirmed')>confirmed</option>
            <option value="completed" @selected($a->status=='completed')>completed</option>
            <option value="cancelled" @selected($a->status=='cancelled')>cancelled</option>
          </select>
          <button class="btn btn-sm btn-outline-primary">Lưu</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="5" class="text-center">Chưa có lịch hẹn</td></tr>
  @endforelse
  </tbody>
</table>
@endsection
