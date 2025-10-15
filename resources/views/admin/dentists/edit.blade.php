@extends('layouts.app')

@section('content')
<h3 class="mb-3">Sửa bác sĩ</h3>
<form method="POST" action="{{ route('dentists.update', $dentist) }}">
  @csrf @method('PUT')
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Họ tên</label>
      <input class="form-control" name="name" value="{{ $dentist->user->name }}" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Email</label>
      <input class="form-control" type="email" name="email" value="{{ $dentist->user->email }}" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Mật khẩu (để trống nếu giữ nguyên)</label>
      <input class="form-control" type="text" name="password">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Số điện thoại</label>
      <input class="form-control" name="phone" value="{{ $dentist->user->phone }}">
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Chuyên khoa</label>
    <input class="form-control" name="specialty" value="{{ $dentist->specialty }}">
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
