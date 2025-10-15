@extends('layouts.app')

@section('content')
<h3 class="mb-3">Thêm bác sĩ</h3>
<form method="POST" action="{{ route('dentists.store') }}">
  @csrf
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Họ tên</label>
      <input class="form-control" name="name" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Email</label>
      <input class="form-control" type="email" name="email" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Mật khẩu (mặc định)</label>
      <input class="form-control" type="text" name="password" value="password">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Số điện thoại</label>
      <input class="form-control" name="phone">
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Chuyên khoa</label>
    <input class="form-control" name="specialty" placeholder="Nha chu / Chỉnh nha / ...">
  </div>
  <button class="btn btn-primary">Lưu</button>
</form>
@endsection
