@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <h3 class="mb-3">Đăng nhập</h3>
    <form method="POST" action="{{ url('/login') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Ghi nhớ</label>
      </div>
      <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
    </form>
  </div>
</div>
@endsection
