@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Quản lý Dịch vụ</h2>
      <p class="text-muted mb-0">Danh sách các dịch vụ nha khoa trong hệ thống</p>
    </div>
    <a class="btn btn-primary px-4 py-2 rounded-3 shadow-sm" href="{{ route('services.create') }}">
      <i class="bi bi-plus-circle me-2"></i>Thêm dịch vụ
    </a>
  </div>

  <!-- Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-muted mb-1 small">Tổng dịch vụ</p>
              <h4 class="mb-0 fw-bold">{{ $services->total() }}</h4>
            </div>
            <div class="bg-success bg-opacity-10 p-3 rounded-3">
              <i class="bi bi-heart-pulse-fill fs-4 text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  <!-- Table Card -->
  <div class="card border-0 shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-muted fw-semibold">#</th>
              <th class="px-4 py-3 text-muted fw-semibold">Tên dịch vụ</th>
              <th class="px-4 py-3 text-muted fw-semibold">Mô tả</th>
              <th class="px-4 py-3 text-muted fw-semibold">Giá</th>
              <th class="px-4 py-3 text-muted fw-semibold">Thời lượng</th>
              <th class="px-4 py-3 text-muted fw-semibold text-center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @forelse($services as $s)
            <tr>
              <td class="px-4 py-3">
                <span class="badge bg-light text-dark">{{ $s->id }}</span>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <div class="service-icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                       style="width: 40px; height: 40px; min-width: 40px;">
                    <i class="bi bi-{{ getServiceIcon($s->name) }} fs-5"></i>
                  </div>
                  <div>
                    <div class="fw-semibold">{{ $s->name }}</div>
                    @if($s->category)
                    <small class="text-muted">{{ $s->category }}</small>
                    @endif
                  </div>
                </div>
              </td>
              <td class="px-4 py-3">
                @if($s->description)
                <small class="text-muted">{{ Str::limit($s->description, 50) }}</small>
                @else
                <small class="text-muted fst-italic">Chưa có mô tả</small>
                @endif
              </td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-currency-dollar text-success me-1"></i>
                  <span class="fw-bold text-success">{{ number_format($s->price) }}đ</span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-clock text-info me-1"></i>
                  <span>{{ $s->duration_mins }} phút</span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex gap-2 justify-content-center">
                  <button class="btn btn-sm btn-outline-info rounded-pill px-3" 
                          data-bs-toggle="modal" 
                          data-bs-target="#viewModal{{ $s->id }}"
                          title="Xem chi tiết">
                    <i class="bi bi-eye"></i>
                  </button>
                  <a class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                     href="{{ route('services.edit', $s) }}" 
                     title="Chỉnh sửa">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('services.destroy', $s) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                            onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ {{ $s->name }}?')"
                            title="Xóa">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- Modal xem chi tiết -->
            <div class="modal fade" id="viewModal{{ $s->id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Chi tiết Dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="text-center mb-4">
                      <div class="service-icon-large bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                           style="width: 80px; height: 80px;">
                        <i class="bi bi-{{ getServiceIcon($s->name) }} fs-1"></i>
                      </div>
                      <h5 class="fw-bold mb-1">{{ $s->name }}</h5>
                      @if($s->category)
                      <span class="badge bg-info bg-opacity-10 text-info">{{ $s->category }}</span>
                      @endif
                    </div>

                    <div class="mb-3">
                      <label class="text-muted small mb-1">Mô tả dịch vụ</label>
                      @if($s->description)
                      <p>{{ $s->description }}</p>
                      @else
                      <p class="text-muted fst-italic">Chưa có mô tả</p>
                      @endif
                    </div>

                    <div class="row">
                      <div class="col-6 mb-3">
                        <label class="text-muted small mb-1">Giá dịch vụ</label>
                        <p class="fw-bold text-success fs-5 mb-0">{{ number_format($s->price) }}đ</p>
                      </div>
                      <div class="col-6 mb-3">
                        <label class="text-muted small mb-1">Thời lượng</label>
                        <p class="fw-bold mb-0">{{ $s->duration_mins }} phút</p>
                      </div>
                    </div>

                    @if($s->notes)
                    <div class="mb-3">
                      <label class="text-muted small mb-1">Ghi chú</label>
                      <p class="small">{{ $s->notes }}</p>
                    </div>
                    @endif
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a href="{{ route('services.edit', $s) }}" class="btn btn-primary">
                      <i class="bi bi-pencil me-2"></i>Chỉnh sửa
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <tr>
              <td colspan="6" class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <p class="text-muted">Chưa có dịch vụ nào trong hệ thống</p>
                <a href="{{ route('services.create') }}" class="btn btn-primary">Thêm dịch vụ đầu tiên</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    
    @if($services->hasPages())
    <div class="card-footer bg-white border-top py-3">
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">
          Hiển thị {{ $services->firstItem() }} - {{ $services->lastItem() }} trong tổng số {{ $services->total() }} dịch vụ
        </small>
        {{ $services->links() }}
      </div>
    </div>
    @endif
  </div>
</div>

@php
function getServiceIcon($serviceName) {
    $icons = [
        'Tẩy trắng' => 'brightness-high',
        'Nhổ răng' => 'x-circle',
        'Trám răng' => 'bezier2',
        'Chỉnh nha' => 'braces',
        'Implant' => 'diagram-3',
        'Cạo vôi' => 'tools',
        'Bọc răng' => 'shield-check',
        'Niềng răng' => 'grid-3x3',
        'Phục hồi' => 'arrow-repeat',
    ];
    
    foreach ($icons as $keyword => $icon) {
        if (stripos($serviceName, $keyword) !== false) {
            return $icon;
        }
    }
    
    return 'heart-pulse';
}
@endphp

<style>
  .table tbody tr {
    transition: all 0.2s ease;
  }
  .table tbody tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
  }
  .btn {
    transition: all 0.2s ease;
  }
  .btn:hover {
    transform: translateY(-2px);
  }
  .service-icon {
    transition: all 0.3s ease;
  }
  tr:hover .service-icon {
    transform: scale(1.1);
    background-color: rgba(var(--bs-primary-rgb), 0.2) !important;
  }
  .modal-content {
    border: none;
    border-radius: 15px;
  }
</style>
@endsection