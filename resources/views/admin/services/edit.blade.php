@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Chỉnh sửa dịch vụ</h2>
      <p class="text-muted mb-0">Cập nhật thông tin cho dịch vụ {{ $service->name }}</p>
    </div>
    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-2"></i>Quay lại
    </a>
  </div>

  <!-- Form Card -->
  <div class="row">
    <div class="col-lg-8 col-xl-7">
      <form method="POST" action="{{ route('services.update', $service) }}">
        @csrf @method('PUT')
        
        <!-- Thông tin cơ bản -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-heart-pulse text-success me-2"></i>Thông tin dịch vụ
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">
                Tên dịch vụ <span class="text-danger">*</span>
              </label>
              <input type="text" 
                     class="form-control @error('name') is-invalid @enderror" 
                     name="name" 
                     value="{{ old('name', $service->name) }}"
                     placeholder="Ví dụ: Tẩy trắng răng, Nhổ răng khôn..."
                     required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Danh mục</label>
              <select class="form-select @error('category') is-invalid @enderror" name="category">
                <option value="">-- Chọn danh mục --</option>
                <option value="Điều trị tổng quát" {{ old('category', $service->category) == 'Điều trị tổng quát' ? 'selected' : '' }}>Điều trị tổng quát</option>
                <option value="Thẩm mỹ" {{ old('category', $service->category) == 'Thẩm mỹ' ? 'selected' : '' }}>Thẩm mỹ</option>
                <option value="Chỉnh nha" {{ old('category', $service->category) == 'Chỉnh nha' ? 'selected' : '' }}>Chỉnh nha</option>
                <option value="Phục hồi răng" {{ old('category', $service->category) == 'Phục hồi răng' ? 'selected' : '' }}>Phục hồi răng</option>
                <option value="Nha chu" {{ old('category', $service->category) == 'Nha chu' ? 'selected' : '' }}>Nha chu</option>
                <option value="Phẫu thuật" {{ old('category', $service->category) == 'Phẫu thuật' ? 'selected' : '' }}>Phẫu thuật</option>
                <option value="Nội nha" {{ old('category', $service->category) == 'Nội nha' ? 'selected' : '' }}>Nội nha</option>
                <option value="Implant" {{ old('category', $service->category) == 'Implant' ? 'selected' : '' }}>Implant</option>
              </select>
              @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Mô tả dịch vụ</label>
              <textarea class="form-control @error('description') is-invalid @enderror" 
                        name="description" 
                        rows="4"
                        placeholder="Mô tả chi tiết về dịch vụ, quy trình thực hiện, lợi ích...">{{ old('description', $service->description) }}</textarea>
              <small class="text-muted">Mô tả giúp khách hàng hiểu rõ hơn về dịch vụ</small>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <!-- Giá và thời lượng -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-cash-coin text-warning me-2"></i>Giá & Thời lượng
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Giá dịch vụ <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                  <input type="number" 
                         class="form-control @error('price') is-invalid @enderror" 
                         name="price" 
                         value="{{ old('price', $service->price) }}"
                         min="0"
                         step="1000"
                         placeholder="500000"
                         required>
                  <span class="input-group-text">VNĐ</span>
                  @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="text-muted">Giá tính bằng VNĐ</small>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                  Thời lượng <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-clock"></i></span>
                  <input type="number" 
                         class="form-control @error('duration_mins') is-invalid @enderror" 
                         name="duration_mins" 
                         value="{{ old('duration_mins', $service->duration_mins) }}"
                         min="10"
                         max="480"
                         placeholder="30"
                         required>
                  <span class="input-group-text">phút</span>
                  @error('duration_mins')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="text-muted">Thời gian dự kiến thực hiện</small>
              </div>
            </div>

            <!-- Quick select duration -->
            <div class="mb-3">
              <label class="form-label fw-semibold small text-muted">Chọn nhanh thời lượng:</label>
              <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setDuration(15)">15 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setDuration(30)">30 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setDuration(45)">45 phút</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setDuration(60)">1 giờ</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setDuration(90)">1.5 giờ</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setDuration(120)">2 giờ</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Ghi chú bổ sung -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
              <i class="bi bi-journal-text text-info me-2"></i>Thông tin bổ sung
            </h5>
          </div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">Ghi chú</label>
              <textarea class="form-control @error('notes') is-invalid @enderror" 
                        name="notes" 
                        rows="3"
                        placeholder="Ghi chú về lưu ý đặc biệt, chuẩn bị trước khi thực hiện...">{{ old('notes', $service->notes) }}</textarea>
              <small class="text-muted">Thông tin này giúp bác sĩ và nhân viên chuẩn bị tốt hơn</small>
              @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" 
                     type="checkbox" 
                     id="isActive" 
                     name="is_active" 
                     value="1"
                     {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="isActive">
                Kích hoạt dịch vụ
              </label>
              <small class="d-block text-muted">Dịch vụ sẽ hiển thị cho khách hàng đặt lịch</small>
            </div>
          </div>
        </div>

        <!-- Statistics (if available) -->
        @if(isset($service->appointments_count))
        <div class="card border-0 shadow-sm mb-4 bg-light">
          <div class="card-body p-4">
            <h6 class="fw-semibold mb-3">
              <i class="bi bi-graph-up text-primary me-2"></i>Thống kê
            </h6>
            <div class="row">
              <div class="col-md-4">
                <small class="text-muted d-block">Số lượt đặt</small>
                <h5 class="fw-bold mb-0">{{ $service->appointments_count ?? 0 }}</h5>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">Doanh thu</small>
                <h5 class="fw-bold text-success mb-0">
                  {{ number_format(($service->appointments_count ?? 0) * $service->price) }}đ
                </h5>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">Ngày tạo</small>
                <h6 class="mb-0">{{ $service->created_at->format('d/m/Y') }}</h6>
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
          <button type="submit" class="btn btn-primary px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>Cập nhật dịch vụ
          </button>
          <a href="{{ route('services.index') }}" class="btn btn-outline-secondary px-4 py-2">
            <i class="bi bi-x-circle me-2"></i>Hủy bỏ
          </a>
        </div>
      </form>
    </div>

    <!-- Preview Card -->
    <div class="col-lg-4 col-xl-5">
      <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
        <div class="card-header bg-primary text-white py-3">
          <h6 class="mb-0 fw-semibold">
            <i class="bi bi-eye me-2"></i>Xem trước
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="text-center mb-3">
            <div class="service-preview-icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                 style="width: 80px; height: 80px;">
              <i class="bi bi-heart-pulse fs-1"></i>
            </div>
            <h5 class="fw-bold mb-1" id="previewName">{{ $service->name }}</h5>
            <span class="badge bg-info bg-opacity-10 text-info" id="previewCategory">
              {{ $service->category ?? 'Danh mục' }}
            </span>
          </div>

          <div class="mb-3">
            <label class="text-muted small mb-1">Mô tả</label>
            <p class="small" id="previewDescription">
              {{ $service->description ?? 'Chưa có mô tả' }}
            </p>
          </div>

          <div class="row mb-3">
            <div class="col-6">
              <label class="text-muted small mb-1">Giá</label>
              <p class="fw-bold text-success mb-0 fs-5" id="previewPrice">
                {{ number_format($service->price) }}đ
              </p>
            </div>
            <div class="col-6">
              <label class="text-muted small mb-1">Thời lượng</label>
              <p class="fw-bold mb-0" id="previewDuration">
                {{ $service->duration_mins }} phút
              </p>
            </div>
          </div>

          <div class="alert alert-light mb-0">
            <small class="text-muted">
              <i class="bi bi-info-circle me-1"></i>
              Khách hàng sẽ thấy thông tin này khi đặt lịch
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Real-time preview
  function updatePreview() {
    const name = document.querySelector('input[name="name"]').value || 'Tên dịch vụ';
    const category = document.querySelector('select[name="category"]').value || 'Danh mục';
    const description = document.querySelector('textarea[name="description"]').value || 'Chưa có mô tả';
    const price = document.querySelector('input[name="price"]').value || 0;
    const duration = document.querySelector('input[name="duration_mins"]').value || 30;

    document.getElementById('previewName').textContent = name;
    document.getElementById('previewCategory').textContent = category;
    document.getElementById('previewDescription').textContent = description;
    document.getElementById('previewPrice').textContent = new Intl.NumberFormat('vi-VN').format(price) + 'đ';
    document.getElementById('previewDuration').textContent = duration + ' phút';
  }

  // Quick duration set
  function setDuration(mins) {
    document.querySelector('input[name="duration_mins"]').value = mins;
    updatePreview();
  }

  // Add event listeners
  document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['input[name="name"]', 'select[name="category"]', 'textarea[name="description"]', 'input[name="price"]', 'input[name="duration_mins"]'];
    inputs.forEach(selector => {
      const element = document.querySelector(selector);
      if (element) {
        element.addEventListener('input', updatePreview);
        element.addEventListener('change', updatePreview);
      }
    });
  });
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
  
  .input-group-text {
    background-color: #f8f9fa;
  }
  
  .service-preview-icon {
    transition: all 0.3s ease;
  }
  
  .btn-outline-secondary:hover {
    transform: translateY(-1px);
  }
</style>
@endsection