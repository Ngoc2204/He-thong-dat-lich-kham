@extends('layouts.app')

@section('content')
<h3 class="mb-3">Lịch hẹn của tôi</h3>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Thời gian</th>
      <th>Bác sĩ</th>
      <th>Dịch vụ</th>
      <th>Trạng thái</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @forelse($apps as $a)
    <tr>
      <td>{{ $a->starts_at->format('d/m/Y H:i') }}</td>
      <td>{{ $a->dentist->user->name }}</td>
      <td>{{ $a->service->name }}</td>
      <td><span class="badge text-bg-secondary">{{ $a->status }}</span></td>
      <td class="text-end">
        @if(!in_array($a->status,['completed','cancelled']))
        <form method="POST" action="{{ route('appointments.cancel', $a) }}" onsubmit="return confirm('Huỷ lịch hẹn này?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger">Huỷ</button>
        </form>
        @endif
      </td>
    </tr>
  @empty
    <tr><td colspan="5" class="text-center">Chưa có lịch hẹn</td></tr>
  @endforelse
  </tbody>
</table>

{{ $apps->links() }}
@endsection
