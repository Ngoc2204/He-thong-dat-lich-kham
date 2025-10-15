@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Dịch vụ</h3>
  <a class="btn btn-primary" href="{{ route('services.create') }}">+ Thêm dịch vụ</a>
</div>

<table class="table table-striped">
  <thead>
    <tr><th>#</th><th>Tên</th><th>Giá</th><th>Thời lượng (phút)</th><th></th></tr>
  </thead>
  <tbody>
    @foreach($services as $s)
    <tr>
      <td>{{ $s->id }}</td>
      <td>{{ $s->name }}</td>
      <td>{{ number_format($s->price) }}đ</td>
      <td>{{ $s->duration_mins }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('services.edit', $s) }}">Sửa</a>
        <form action="{{ route('services.destroy', $s) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa dịch vụ này?')">Xóa</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $services->links() }}
@endsection
