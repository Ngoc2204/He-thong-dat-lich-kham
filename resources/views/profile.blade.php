@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Hồ sơ cá nhân</h2>
      <p class="text-muted mb-0">Quản lý thông tin và cài đặt tài khoản của bạn</p>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
      <i class="bi bi-check-circle me-2"></i>
      <strong>Thành công!</strong> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
      <i class="bi bi-exclamation-circle me-2"></i>
      <strong>Lỗi!</strong> Vui lòng kiểm tra lại thông tin.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row">
    <!-- Avatar and Basic Info -->
    <div class="col-lg-4 mb-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4 text-center">
          <!-- Avatar -->
          <div class="position-relative d-inline-block mb-4">
            <img id="avatarPreview"
                 src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}"
                 class="rounded-circle shadow-sm"
                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #f8f9fa;">
            <label for="avatarInput"
                   class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0"
                   style="cursor: pointer;">
              <i class="bi bi-camera-fill"></i>
            </label>
            <input type="file"
                   id="avatarInput"
                   class="d-none"
                   accept="image/*"
                   onchange="previewAvatar(this)">
          </div>

          <!-- User Info Display -->
          <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
          <p class="text-muted mb-3">{{ $user->email }}</p>

          @if($user->phone)
            <div class="d-flex align-items-center justify-content-center gap-2 text-muted mb-3">
              <i class="bi bi-telephone"></i>
              <span>{{ $user->phone }}</span>
            </div>
          @endif

         

          <!-- Account Stats -->
          <hr class="my-4">
          <div class="row text-center">
            <div class="col-6">
              <small class="text-muted d-block mb-1">Ngày tạo</small>
              <div class="fw-semibold">{{ $user->created_at->format('d/m/Y') }}</div>
            </div>
            <div class="col-6">
              <small class="text-muted d-block mb-1">Cập nhật</small>
              <div class="fw-semibold">{{ $user->updated_at->format('d/m/Y') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Form -->
    <div class="col-lg-8">
      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
        @csrf

        <!-- Basic Information -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-person text-primary me-2"></i>Thông tin cơ bản
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">
                Họ và tên <span class="text-danger">*</span>
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">
                Email <span class="text-danger">*</span>
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">
                Số điện thoại
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="tel"
                       class="form-control @error('phone') is-invalid @enderror"
                       name="phone"
                       value="{{ old('phone', $user->phone) }}"
                       placeholder="0123456789">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>

        <!-- Security -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-lock text-warning me-2"></i>Bảo mật
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="alert alert-info alert-dismissible fade show border-0" role="alert">
              <i class="bi bi-info-circle me-2"></i>
              <strong>Lưu ý:</strong> Để thay đổi mật khẩu, vui lòng nhập mật khẩu mới và xác nhận.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">
                Mật khẩu mới
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-key"></i></span>
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       id="password"
                       placeholder="Để trống nếu không đổi">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <small class="text-muted d-block mt-2">Tối thiểu 6 ký tự</small>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">
                Xác nhận mật khẩu
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-key"></i></span>
                <input type="password"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       name="password_confirmation"
                       id="passwordConfirmation"
                       placeholder="Nhập lại mật khẩu">
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                  <i class="bi bi-eye"></i>
                </button>
                @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Password Strength Indicator -->
            <div id="passwordStrength" class="d-none">
              <small class="text-muted d-block mb-2">Độ mạnh mật khẩu:</small>
              <div class="progress" style="height: 6px;">
                <div id="passwordStrengthBar"
                     class="progress-bar"
                     role="progressbar"
                     style="width: 0%"></div>
              </div>
              <small id="passwordStrengthText" class="text-muted d-block mt-2"></small>
            </div>
          </div>
        </div>

        <!-- Avatar Upload Hidden -->
        <input type="hidden" id="avatarInputHidden" name="avatar">

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
          <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>Lưu thay đổi
          </button>
          <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
            <i class="bi bi-x-circle me-2"></i>Hủy bỏ
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Avatar Preview
  function previewAvatar(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('avatarPreview').src = e.target.result;
        document.getElementById('avatarInputHidden').value = input.files[0].name;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Toggle Password Visibility
  document.getElementById('togglePassword').addEventListener('click', function() {
    const input = document.getElementById('password');
    const icon = this.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
    }
  });

  document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
    const input = document.getElementById('passwordConfirmation');
    const icon = this.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
    }
  });

  // Password Strength Indicator
  document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');

    if (password.length === 0) {
      strengthDiv.classList.add('d-none');
      return;
    }

    strengthDiv.classList.remove('d-none');

    let strength = 0;
    let text = 'Yếu';
    let color = 'bg-danger';

    if (password.length >= 6) strength++;
    if (password.length >= 10) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[!@#$%^&*]/.test(password)) strength++;

    if (strength <= 1) {
      text = 'Yếu';
      color = 'bg-danger';
      strengthBar.style.width = '20%';
    } else if (strength === 2) {
      text = 'Trung bình';
      color = 'bg-warning';
      strengthBar.style.width = '40%';
    } else if (strength === 3) {
      text = 'Tốt';
      color = 'bg-info';
      strengthBar.style.width = '60%';
    } else if (strength === 4) {
      text = 'Rất tốt';
      color = 'bg-success';
      strengthBar.style.width = '80%';
    } else {
      text = 'Rất mạnh';
      color = 'bg-success';
      strengthBar.style.width = '100%';
    }

    strengthBar.className = 'progress-bar ' + color;
    strengthText.textContent = text;
  });

  // Form validation
  document.getElementById('profileForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('passwordConfirmation').value;

    if (password && password !== passwordConfirmation) {
      e.preventDefault();
      alert('Mật khẩu xác nhận không khớp!');
      return false;
    }

    if (password && password.length < 6) {
      e.preventDefault();
      alert('Mật khẩu phải có ít nhất 6 ký tự!');
      return false;
    }
  });
</script>

<style>
  .form-control:focus,
  .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
  }

  .input-group-text {
    background-color: #f8f9fa;
  }

  .card {
    transition: all 0.3s ease;
  }

  .card:hover {
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
  }

  .badge {
    padding: 0.4rem 0.65rem;
    font-weight: 500;
  }

  #avatarPreview {
    transition: all 0.3s ease;
  }
</style>
@endsection