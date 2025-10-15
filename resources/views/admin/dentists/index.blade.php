@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Danh sách bác sĩ</h3>
  <a class="btn btn-primary" href="{{ route('dentists.create') }}">+ Thêm bác sĩ</a>
</div>

<table class="table table-striped">
  <thead>
    <tr><th>#</th><th>Họ tên</th><th>Chuyên khoa</th><th>Email</th><th></th></tr>
  </thead>
  <tbody>
    @foreach($dentists as $d)
    <tr>
      <td>{{ $d->id }}</td>
      <td>{{ $d->user->name }}</td>
      <td>{{ $d->specialty }}</td>
      <td>{{ $d->user->email }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('dentists.edit', $d) }}">Sửa</a>
        <form action="{{ route('dentists.destroy', $d) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa bác sĩ này?')">Xóa</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $dentists->links() }}
@endsection
