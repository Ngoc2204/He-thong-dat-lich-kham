<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Dental Appointment System' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">🦷 Dental</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        @auth
          @role('patient')
          <li class="nav-item"><a class="nav-link" href="{{ route('appointments.create') }}">Đặt lịch</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('appointments.mine') }}">Lịch hẹn của tôi</a></li>
          @endrole
          @role('dentist')
          <li class="nav-item"><a class="nav-link" href="{{ route('dentist.dashboard') }}">Lịch bác sĩ</a></li>
          @endrole
          @role('admin')
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
          @endrole
        @endauth
      </ul>
      <ul class="navbar-nav">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
        @else
          <li class="nav-item"><span class="nav-link">Xin chào, {{ auth()->user()->name }}</span></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-link nav-link" type="submit">Đăng xuất</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<main class="container">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{ $slot ?? '' }}
  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
