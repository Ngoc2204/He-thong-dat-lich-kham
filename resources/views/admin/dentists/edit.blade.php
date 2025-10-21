@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Chỉnh sửa thông tin bác sĩ</h2>
      <p class="text-muted mb-0">Cập nhật thông tin cho bác sĩ {{ $dentist->user->name }}</p>
    </div>
    <a href="{{ route('dentists.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-2"></i>Quay lại
    </a>
  </div>

  <!-- Form Card -->
  <div class="row">
    <div class="">
      <form method="POST" action="{{ route('dentists.update', $dentist) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <!-- Thông tin cơ bản -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-person-badge text-primary me-2"></i>Thông tin cơ bản
            </h5>
          </div>
          <div class="card-body p-4">
            <!-- Avatar Upload -->
            <div class="mb-4 text-center">
              <label class="form-label d-block mb-3 fw-semibold">Ảnh đại diện</label>
              <div class="avatar-preview mb-3">
                @if($dentist->avatar)
                <img id="avatarPreview" 
                     src="{{ asset('storage/' . $dentist->avatar) }}" 
                     class="rounded-circle shadow-sm" 
                     style="width: 150px; height: 150px; object-fit: cover;">
                @else
                <img id="avatarPreview" 
                     src="https://ui-avatars.com/api/?name={{ urlencode($dentist->user->name) }}&size=150&background=e3f2fd&color=1976d2" 
                     class="rounded-circle shadow-sm" 
                     style="width: 150px; height: 150px; object-fit: cover;">
                @endif
              </div>
              
              <input type="file" 
                     class="form-control d-none" 
                     id="avatarInput" 
                     name="avatar" 
                     accept="image/*">
              
              <div class="d-flex gap-2 justify-content-center">
                <button type="button" 
                        class="btn btn-outline-primary btn-sm" 
                        onclick="document.getElementById('avatarInput').click()">
                  <i class="bi bi-camera me-2"></i>Thay đổi ảnh
                </button>
                
                @if($dentist->avatar)
                <button type="button" 
                        class="btn btn-outline-danger btn-sm" 
                        onclick="removeAvatar()">
                  <i class="bi bi-trash me-2"></i>Xóa ảnh
                </button>
                <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">
                @endif
              </div>
              
              <small class="d-block text-muted mt-2">JPG, PNG hoặc GIF (Max: 2MB)</small>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Họ và tên <span class="text-danger">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       name="name" 
                       value="{{ old('name', $dentist->user->name) }}"
                       placeholder="Nguyễn Văn A"
                       required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Học vị
                </label>
                <select class="form-select @error('degree') is-invalid @enderror" name="degree">
                  <option value="">-- Chọn học vị --</option>
                  <option value="Bác sĩ" {{ old('degree', $dentist->degree) == 'Bác sĩ' ? 'selected' : '' }}>Bác sĩ (BS)</option>
                  <option value="Thạc sĩ" {{ old('degree', $dentist->degree) == 'Thạc sĩ' ? 'selected' : '' }}>Thạc sĩ (ThS)</option>
                  <option value="Tiến sĩ" {{ old('degree', $dentist->degree) == 'Tiến sĩ' ? 'selected' : '' }}>Tiến sĩ (TS)</option>
                  <option value="Giáo sư" {{ old('degree', $dentist->degree) == 'Giáo sư' ? 'selected' : '' }}>Giáo sư (GS)</option>
                  <option value="Phó Giáo sư" {{ old('degree', $dentist->degree) == 'Phó Giáo sư' ? 'selected' : '' }}>Phó Giáo sư (PGS)</option>
                </select>
                @error('degree')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Chuyên khoa <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('specialty') is-invalid @enderror" name="specialty" required>
                  <option value="">-- Chọn chuyên khoa --</option>
                  <option value="Nha chu" {{ old('specialty', $dentist->specialty) == 'Nha chu' ? 'selected' : '' }}>Nha chu</option>
                  <option value="Chỉnh nha" {{ old('specialty', $dentist->specialty) == 'Chỉnh nha' ? 'selected' : '' }}>Chỉnh nha</option>
                  <option value="Răng hàm mặt" {{ old('specialty', $dentist->specialty) == 'Răng hàm mặt' ? 'selected' : '' }}>Răng hàm mặt</option>
                  <option value="Nội nha" {{ old('specialty', $dentist->specialty) == 'Nội nha' ? 'selected' : '' }}>Nội nha</option>
                  <option value="Phục hồi răng" {{ old('specialty', $dentist->specialty) == 'Phục hồi răng' ? 'selected' : '' }}>Phục hồi răng</option>
                  <option value="Implant" {{ old('specialty', $dentist->specialty) == 'Implant' ? 'selected' : '' }}>Implant</option>
                  <option value="Tổng quát" {{ old('specialty', $dentist->specialty) == 'Tổng quát' ? 'selected' : '' }}>Tổng quát</option>
                </select>
                @error('specialty')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Kinh nghiệm (năm)
                </label>
                <input type="number" 
                       class="form-control @error('experience_years') is-invalid @enderror" 
                       name="experience_years" 
                       value="{{ old('experience_years', $dentist->experience_years) }}"
                       min="0" 
                       max="50"
                       placeholder="5">
                @error('experience_years')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Tiểu sử / Giới thiệu</label>
              <textarea class="form-control @error('bio') is-invalid @enderror" 
                        name="bio" 
                        rows="4"
                        placeholder="Giới thiệu về bác sĩ, chuyên môn, thành tích...">{{ old('bio', $dentist->bio) }}</textarea>
              <small class="text-muted">Tối đa 1000 ký tự</small>
              @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <!-- Thông tin tài khoản -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-shield-lock text-success me-2"></i>Thông tin tài khoản
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Email đăng nhập <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="email" 
                         class="form-control @error('email') is-invalid @enderror" 
                         name="email" 
                         value="{{ old('email', $dentist->user->email) }}"
                         placeholder="example@clinic.com"
                         required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="text-muted">Email này dùng để đăng nhập hệ thống</small>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Mật khẩu mới
                </label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-key"></i></span>
                  <input type="password" 
                         class="form-control @error('password') is-invalid @enderror" 
                         name="password" 
                         placeholder="Để trống nếu không đổi">
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                  </button>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="text-muted">Để trống nếu muốn giữ nguyên mật khẩu</small>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">
                Số điện thoại (tài khoản)
              </label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="text" 
                       class="form-control @error('phone') is-invalid @enderror" 
                       name="phone" 
                       value="{{ old('phone', $dentist->user->phone) }}"
                       placeholder="0912345678">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-telephone text-info me-2"></i>Thông tin liên hệ công khai
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <i class="bi bi-info-circle me-2"></i>
              <small>Thông tin này sẽ được hiển thị công khai cho bệnh nhân. Để trống nếu muốn sử dụng thông tin tài khoản.</small>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Email liên hệ</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="email" 
                         class="form-control @error('dentist_email') is-invalid @enderror" 
                         name="dentist_email" 
                         value="{{ old('dentist_email', $dentist->email) }}"
                         placeholder="doctor@example.com">
                  @error('dentist_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Số điện thoại liên hệ</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                  <input type="text" 
                         class="form-control @error('dentist_phone') is-invalid @enderror" 
                         name="dentist_phone" 
                         value="{{ old('dentist_phone', $dentist->phone) }}"
                         placeholder="0987654321">
                  @error('dentist_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
          <button type="submit" class="btn btn-primary px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>Cập nhật thông tin
          </button>
          <a href="{{ route('dentists.index') }}" class="btn btn-outline-secondary px-4 py-2">
            <i class="bi bi-x-circle me-2"></i>Hủy bỏ
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Preview avatar khi chọn file mới
  document.getElementById('avatarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('avatarPreview').src = e.target.result;
        document.getElementById('removeAvatarInput').value = '0';
      }
      reader.readAsDataURL(file);
    }
  });

  // Xóa avatar
  function removeAvatar() {
    if (confirm('Bạn có chắc muốn xóa ảnh đại diện?')) {
      document.getElementById('avatarPreview').src = 'https://ui-avatars.com/api/?name={{ urlencode($dentist->user->name) }}&size=150&background=e3f2fd&color=1976d2';
      document.getElementById('removeAvatarInput').value = '1';
      document.getElementById('avatarInput').value = '';
    }
  }

  // Toggle password visibility
  const togglePassword = document.getElementById('togglePassword');
  if (togglePassword) {
    togglePassword.addEventListener('click', function() {
      const passwordInput = document.querySelector('input[name="password"]');
      const icon = this.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    });
  }
</script>

<style>
  .form-control:focus,
  .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
  }
  
  .card {
    transition: all 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-2px);
  }
  
  .input-group-text {
    background-color: #f8f9fa;
    border-right: none;
  }
  
  .input-group .form-control {
    border-left: none;
  }
  
  .input-group .form-control:focus {
    border-left: none;
  }
  
  .input-group-text + .form-control:focus {
    border-left: 1px solid #0d6efd;
  }
  
  .avatar-preview img {
    transition: all 0.3s ease;
  }
  
  .avatar-preview img:hover {
    transform: scale(1.05);
  }
</style>
@endsection