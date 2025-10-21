@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Sửa thông tin bệnh nhân</h2>
      <p class="text-muted mb-0">Cập nhật hồ sơ bệnh nhân: <strong>{{ $patient->name }}</strong></p>
    </div>
    <a href="{{ route('patients.index', $patient) }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-2"></i>Quay lại
    </a>
  </div>

  <div class="row">
    <div class="col-lg-8 col-xl-7">
      <form method="POST" action="{{ route('patients.update', $patient) }}" enctype="multipart/form-data" id="patientForm">
        @csrf
        @method('PUT')

        <!-- Thông tin cơ bản -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-person-badge text-primary me-2"></i>Thông tin cơ bản
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
                       id="name"
                       placeholder="Nhập họ và tên"
                       value="{{ old('name', $patient->name) }}"
                       required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Email <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="email"
                         class="form-control @error('email') is-invalid @enderror"
                         name="email"
                         id="email"
                         placeholder="example@email.com"
                         value="{{ old('email', $patient->email) }}"
                         required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Số điện thoại <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                  <input type="tel"
                         class="form-control @error('phone') is-invalid @enderror"
                         name="phone"
                         id="phone"
                         placeholder="0123456789"
                         value="{{ old('phone', $patient->phone) }}"
                         required>
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Ngày sinh <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                  <input type="date"
                         class="form-control @error('date_of_birth') is-invalid @enderror"
                         name="date_of_birth"
                         id="dateOfBirth"
                         value="{{ old('date_of_birth', $patient->date_of_birth?->format('Y-m-d')) }}"
                         required>
                  @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="text-muted d-block mt-2">Tuổi: <span id="ageDisplay">
                  @if($patient->date_of_birth)
                    {{ $patient->getAge() ?? '--' }}
                  @else
                    --
                  @endif
                </span></small>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Giới tính <span class="text-danger">*</span>
                </label>
                <div class="btn-group w-100" role="group">
                  <input type="radio"
                         class="btn-check"
                         name="gender"
                         id="genderMale"
                         value="male"
                         {{ old('gender', $patient->gender) === 'male' ? 'checked' : '' }}
                         required>
                  <label class="btn btn-outline-primary" for="genderMale">
                    <i class="bi bi-mars me-2"></i>Nam
                  </label>

                  <input type="radio"
                         class="btn-check"
                         name="gender"
                         id="genderFemale"
                         value="female"
                         {{ old('gender', $patient->gender) === 'female' ? 'checked' : '' }}>
                  <label class="btn btn-outline-danger" for="genderFemale">
                    <i class="bi bi-venus me-2"></i>Nữ
                  </label>

                  <input type="radio"
                         class="btn-check"
                         name="gender"
                         id="genderOther"
                         value="other"
                         {{ old('gender', $patient->gender) === 'other' ? 'checked' : '' }}>
                  <label class="btn btn-outline-secondary" for="genderOther">
                    <i class="bi bi-question-circle me-2"></i>Khác
                  </label>
                </div>
                @error('gender')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">
                Địa chỉ
              </label>
              <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                <input type="text"
                       class="form-control @error('address') is-invalid @enderror"
                       name="address"
                       id="address"
                       placeholder="Nhập địa chỉ"
                       value="{{ old('address', $patient->address) }}">
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>

        <!-- Ảnh đại diện -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-image text-info me-2"></i>Ảnh đại diện
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">Tải lên ảnh</label>
              <div class="upload-area border-2 border-dashed rounded-3 p-5 text-center"
                   id="uploadArea"
                   style="cursor: pointer; transition: all 0.3s ease; background-color: rgba(0,0,0,0.02);">
                <i class="bi bi-cloud-arrow-up fs-1 text-primary d-block mb-3"></i>
                <p class="fw-semibold mb-1">Kéo thả hoặc click để chọn ảnh</p>
                <small class="text-muted">Định dạng: JPG, PNG, GIF (Max 2MB)</small>
                <input type="file"
                       class="d-none"
                       id="avatarInput"
                       name="avatar"
                       accept="image/*"
                       @error('avatar') is-invalid @enderror>
              </div>

              <!-- Image preview -->
              <div id="previewContainer" class="mt-3 @if(!$patient->avatar) d-none @endif">
                <div class="position-relative d-inline-block">
                  <img id="previewImage"
                       src="{{ $patient->avatar ? asset('storage/' . $patient->avatar) : '' }}"
                       class="rounded-3"
                       style="max-width: 200px; height: auto;">
                  <button type="button"
                          class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle"
                          id="removeImageBtn"
                          style="transform: translate(10%, -10%);">
                    <i class="bi bi-x"></i>
                  </button>
                </div>
              </div>

              @error('avatar')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        

        

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
          <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>Cập nhật thông tin
          </button>
          <a href="{{ route('patients.index', $patient) }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
            <i class="bi bi-x-circle me-2"></i>Hủy bỏ
          </a>
        </div>
      </form>
    </div>

    <!-- Info Card -->
    <div class="col-lg-4 col-xl-5">
      <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
        <div class="card-header bg-primary text-white py-3">
          <h6 class="mb-0 fw-semibold">
            <i class="bi bi-info-circle me-2"></i>Xem trước hồ sơ
          </h6>
        </div>
        <div class="card-body p-4">
          <!-- Avatar Preview -->
          <div class="text-center mb-4">
            <div id="avatarPreview"
                 class="rounded-circle mx-auto mb-3 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                 style="width: 100px; height: 100px; overflow: hidden;">
              @if($patient->avatar)
                <img src="{{ asset('storage/' . $patient->avatar) }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
              @else
                <i class="bi bi-person fs-1 text-primary"></i>
              @endif
            </div>
            <h5 class="fw-bold" id="previewName">{{ $patient->name }}</h5>
            <span class="badge bg-info bg-opacity-10 text-info" id="previewAge">
              @if($patient->date_of_birth)
                {{ $patient->getAge() }} tuổi
              @else
                --
              @endif
            </span>
          </div>

          <!-- Contact Info -->
          <div class="mb-3">
            <small class="text-muted d-block mb-2">Liên hệ</small>
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="bi bi-envelope text-primary"></i>
              <span id="previewEmail">{{ $patient->email }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-telephone text-success"></i>
              <span id="previewPhone">{{ $patient->phone }}</span>
            </div>
          </div>

          <!-- Gender & Address -->
          <div class="mb-3">
            <small class="text-muted d-block mb-2">Thông tin cơ bản</small>
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="bi bi-person-badge text-warning"></i>
              <span id="previewGender">
                @if($patient->gender === 'male')
                  👨 Nam
                @elseif($patient->gender === 'female')
                  👩 Nữ
                @else
                  ❓ Khác
                @endif
              </span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-geo-alt text-danger"></i>
              <span id="previewAddress">{{ $patient->address ?? '--' }}</span>
            </div>
          </div>

          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const dateInput = document.getElementById('dateOfBirth');
  const genderInputs = document.querySelectorAll('input[name="gender"]');
  const addressInput = document.getElementById('address');
  const statusInputs = document.querySelectorAll('input[name="status"]');
  const avatarInput = document.getElementById('avatarInput');
  const uploadArea = document.getElementById('uploadArea');
  const previewContainer = document.getElementById('previewContainer');
  const previewImage = document.getElementById('previewImage');
  const removeImageBtn = document.getElementById('removeImageBtn');

  // Calculate age
  function calculateAge(birthDate) {
    const today = new Date();
    const birth = new Date(birthDate);
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
      age--;
    }
    return age;
  }

  // Update preview
  function updatePreview() {
    document.getElementById('previewName').textContent = nameInput.value || '--';
    document.getElementById('previewEmail').textContent = emailInput.value || '--';
    document.getElementById('previewPhone').textContent = phoneInput.value || '--';
    document.getElementById('previewAddress').textContent = addressInput.value || '--';

    if (dateInput.value) {
      const age = calculateAge(dateInput.value);
      document.getElementById('previewAge').textContent = age + ' tuổi';
      document.getElementById('ageDisplay').textContent = age;
    }

    const selectedGender = document.querySelector('input[name="gender"]:checked');
    if (selectedGender) {
      const genderText = {
        'male': '👨 Nam',
        'female': '👩 Nữ',
        'other': '❓ Khác'
      };
      document.getElementById('previewGender').textContent = genderText[selectedGender.value];
    }

    const selectedStatus = document.querySelector('input[name="status"]:checked');
    if (selectedStatus) {
      const statusBadge = document.getElementById('previewStatus');
      if (selectedStatus.value === 'active') {
        statusBadge.className = 'badge bg-success bg-opacity-10 text-success';
        statusBadge.innerHTML = '<i class="bi bi-check-circle me-1"></i>Hoạt động';
      } else {
        statusBadge.className = 'badge bg-secondary bg-opacity-10 text-secondary';
        statusBadge.innerHTML = '<i class="bi bi-x-circle me-1"></i>Không hoạt động';
      }
    }
  }

  // Image upload handlers
  uploadArea.addEventListener('click', () => avatarInput.click());

  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.style.backgroundColor = 'rgba(13, 110, 253, 0.1)';
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.style.backgroundColor = 'rgba(0,0,0,0.02)';
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.style.backgroundColor = 'rgba(0,0,0,0.02)';
    if (e.dataTransfer.files.length) {
      avatarInput.files = e.dataTransfer.files;
      handleImageSelect();
    }
  });

  avatarInput.addEventListener('change', handleImageSelect);

  function handleImageSelect() {
    const file = avatarInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewContainer.classList.remove('d-none');

        const avatarPreview = document.getElementById('avatarPreview');
        avatarPreview.innerHTML = `<img src="${e.target.result}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">`;
      };
      reader.readAsDataURL(file);
    }
  }

  removeImageBtn.addEventListener('click', () => {
    avatarInput.value = '';
    previewContainer.classList.add('d-none');
    const avatarPreview = document.getElementById('avatarPreview');
    if (!avatarInput.value) {
      avatarPreview.innerHTML = '<i class="bi bi-person fs-1 text-primary"></i>';
    }
  });

  // Event listeners
  nameInput.addEventListener('input', updatePreview);
  emailInput.addEventListener('input', updatePreview);
  phoneInput.addEventListener('input', updatePreview);
  dateInput.addEventListener('change', updatePreview);
  addressInput.addEventListener('input', updatePreview);
  genderInputs.forEach(input => input.addEventListener('change', updatePreview));
  statusInputs.forEach(input => input.addEventListener('change', updatePreview));

  // Initialize preview
  document.addEventListener('DOMContentLoaded', updatePreview);
</script>

<style>
  .upload-area:hover {
    background-color: rgba(13, 110, 253, 0.05);
    border-color: #0d6efd !important;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
  }

  .input-group-text {
    background-color: #f8f9fa;
  }

  .btn-check:checked + .btn {
    transform: scale(1.05);
  }

  .card {
    transition: all 0.3s ease;
  }

  .sticky-top {
    z-index: 900;
  }

  .btn-group .btn {
    padding: 0.75rem 1rem;
  }
</style>
@endsection