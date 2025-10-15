@extends('layouts.app')

@section('content')
<div class="p-5 bg-light rounded-3">
  <h1 class="display-6">Hệ thống đặt lịch khám răng</h1>
  <p class="lead">Đặt lịch nhanh chóng – Quản lý thuận tiện cho khách hàng, bác sĩ và admin.</p>
  @guest
  <a href="{{ route('register') }}" class="btn btn-primary">Bắt đầu đăng ký</a>
  @endguest
</div>
@endsection
