@extends('layouts.app')

@section('content')
<h3 class="mb-3">Tất cả lịch hẹn</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Thời gian</th>
      <th>Bệnh nhân</th>
      <th>Bác sĩ</th>
      <th>Dịch vụ</th>
      <th>Trạng thái</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($appointments as $a)
    <tr>
      <td>{{ $a->id }}</td>
      <td>{{ $a->starts_at->format('d/m/Y H:i') }} - {{ $a->ends_at->format('H:i') }}</td>
      <td>{{ $a->patient->name }}</td>
      <td>{{ $a->dentist->user->name }}</td>
      <td>{{ $a->service->name }}</td>
      <td>{{ $a->status }}</td>
      <td class="text-end">
        <form method="POST" action="{{ route('admin.appointments.status', $a) }}" class="d-inline">
          @csrf
          <select name="status" class="form-select form-select-sm w-auto d-inline">
            <option value="pending" @selected($a->status=='pending')>pending</option>
            <option value="confirmed" @selected($a->status=='confirmed')>confirmed</option>
            <option value="completed" @selected($a->status=='completed')>completed</option>
            <option value="cancelled" @selected($a->status=='cancelled')>cancelled</option>
          </select>
          <button class="btn btn-sm btn-outline-primary">Lưu</button>
        </form>
        <form method="POST" action="{{ route('admin.appointments.destroy', $a) }}" class="d-inline" onsubmit="return confirm('Xoá lịch hẹn này?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger">Xoá</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $appointments->links() }}
@endsection
