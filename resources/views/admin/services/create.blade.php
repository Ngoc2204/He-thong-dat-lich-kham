@extends('layouts.app')

@section('content')
<h3 class="mb-3">Thêm dịch vụ</h3>
<form method="POST" action="{{ route('services.store') }}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Tên</label>
    <input class="form-control" name="name" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Giá</label>
    <input class="form-control" name="price" type="number" value="0" min="0">
  </div>
  <div class="mb-3">
    <label class="form-label">Thời lượng (phút)</label>
    <input class="form-control" name="duration_mins" type="number" value="30" min="10" max="480">
  </div>
  <div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea class="form-control" name="description" rows="3"></textarea>
  </div>
  <button class="btn btn-primary">Lưu</button>
</form>
@endsection
