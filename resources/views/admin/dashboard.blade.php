@extends('layouts.app')

@section('content')
<h3 class="mb-4">Bảng điều khiển Admin</h3>

<div class="row text-center">
  <div class="col-md-3 mb-3">
    <div class="card"><div class="card-body">
      <h5>Bác sĩ</h5>
      <div class="display-6">{{ $stats['dentists'] }}</div>
    </div></div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card"><div class="card-body">
      <h5>Dịch vụ</h5>
      <div class="display-6">{{ $stats['services'] }}</div>
    </div></div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card"><div class="card-body">
      <h5>Lịch hẹn</h5>
      <div class="display-6">{{ $stats['appointments'] }}</div>
    </div></div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card"><div class="card-body">
      <h5>Đang chờ</h5>
      <div class="display-6">{{ $stats['pending'] }}</div>
    </div></div>
  </div>
</div>

<div class="mt-4">
  <a class="btn btn-outline-primary me-2" href="{{ route('dentists.index') }}">Quản lý Bác sĩ</a>
  <a class="btn btn-outline-primary me-2" href="{{ route('services.index') }}">Quản lý Dịch vụ</a>
  <a class="btn btn-outline-primary me-2" href="{{ route('schedules.index') }}">Quản lý Lịch làm</a>
  <a class="btn btn-outline-primary" href="{{ route('admin.appointments.index') }}">Tất cả Lịch hẹn</a>
</div>
@endsection
