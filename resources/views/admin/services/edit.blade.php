@extends('layouts.app')

@section('content')
<h3 class="mb-3">Sửa dịch vụ</h3>
<form method="POST" action="{{ route('services.update', $service) }}">
  @csrf @method('PUT')
  <div class="mb-3">
    <label class="form-label">Tên</label>
    <input class="form-control" name="name" value="{{ $service->name }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Giá</label>
    <input class="form-control" name="price" type="number" value="{{ $service->price }}" min="0">
  </div>
  <div class="mb-3">
    <label class="form-label">Thời lượng (phút)</label>
    <input class="form-control" name="duration_mins" type="number" value="{{ $service->duration_mins }}" min="10" max="480">
  </div>
  <div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea class="form-control" name="description" rows="3">{{ $service->description }}</textarea>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
