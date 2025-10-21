@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Quản lý Bác sĩ</h2>
      <p class="text-muted mb-0">Danh sách và thông tin bác sĩ trong hệ thống</p>
    </div>
    <a class="btn btn-primary px-4 py-2 rounded-3 shadow-sm" href="{{ route('dentists.create') }}">
      <i class="bi bi-plus-circle me-2"></i>Thêm bác sĩ
    </a>
  </div>

  <!-- Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-muted mb-1 small">Tổng số bác sĩ</p>
              <h4 class="mb-0 fw-bold">{{ $dentists->total() }}</h4>
            </div>
            <div class="bg-primary bg-opacity-10 p-3 rounded-3">
              <i class="bi bi-people-fill fs-4 text-primary"></i>
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
              <th class="px-4 py-3 text-muted fw-semibold">Bác sĩ</th>
              <th class="px-4 py-3 text-muted fw-semibold">Chuyên khoa</th>
              <th class="px-4 py-3 text-muted fw-semibold">Kinh nghiệm</th>
              <th class="px-4 py-3 text-muted fw-semibold">Liên hệ</th>
              <th class="px-4 py-3 text-muted fw-semibold text-center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dentists as $d)
            <tr>
              <td class="px-4 py-3">
                <span class="badge bg-light text-dark">{{ $d->id }}</span>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  @if($d->avatar)
                  <img src="{{ asset('storage/' . $d->avatar) }}" 
                       class="rounded-circle me-3" 
                       style="width: 45px; height: 45px; object-fit: cover;"
                       alt="{{ $d->user->name }}">
                  @else
                  <div class="avatar-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                       style="width: 45px; height: 45px;">
                    <span class="fw-bold">{{ strtoupper(substr($d->user->name, 0, 1)) }}</span>
                  </div>
                  @endif
                  <div>
                    <div class="fw-semibold">{{ $d->user->name }}</div>
                    @if($d->degree)
                    <small class="text-muted">{{ $d->degree }}</small>
                    @else
                    <small class="text-muted">BS.{{ $d->id }}</small>
                    @endif
                  </div>
                </div>
              </td>
              <td class="px-4 py-3">
                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                  {{ $d->specialty }}
                </span>
              </td>
              <td class="px-4 py-3">
                @if($d->experience_years)
                <div class="d-flex align-items-center">
                  <i class="bi bi-award text-warning me-2"></i>
                  <span class="fw-semibold">{{ $d->experience_years }} năm</span>
                </div>
                @else
                <span class="text-muted small">Chưa cập nhật</span>
                @endif
              </td>
              <td class="px-4 py-3">
                <div class="small">
                  @if($d->email)
                  <div class="d-flex align-items-center text-muted mb-1">
                    <i class="bi bi-envelope me-2"></i>
                    <span>{{ $d->email }}</span>
                  </div>
                  @endif
                  @if($d->phone)
                  <div class="d-flex align-items-center text-muted">
                    <i class="bi bi-telephone me-2"></i>
                    <span>{{ $d->phone }}</span>
                  </div>
                  @endif
                  @if(!$d->email && !$d->phone)
                  <span class="text-muted small">Chưa có thông tin</span>
                  @endif
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="d-flex gap-2 justify-content-center">
                  <a class="btn btn-sm btn-outline-info rounded-pill px-3" 
                     href="#" 
                     data-bs-toggle="modal" 
                     data-bs-target="#viewModal{{ $d->id }}"
                     title="Xem chi tiết">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                     href="{{ route('dentists.edit', $d) }}" 
                     title="Chỉnh sửa">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('dentists.destroy', $d) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                            onclick="return confirm('Bạn có chắc chắn muốn xóa bác sĩ {{ $d->user->name }}?')"
                            title="Xóa">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- Modal xem chi tiết -->
            <div class="modal fade" id="viewModal{{ $d->id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Thông tin Bác sĩ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-4 text-center mb-3 mb-md-0">
                        @if($d->avatar)
                        <img src="{{ asset('storage/' . $d->avatar) }}" 
                             class="rounded-circle shadow-sm mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover;"
                             alt="{{ $d->user->name }}">
                        @else
                        <div class="avatar-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" 
                             style="width: 150px; height: 150px;">
                          <span class="fw-bold fs-1">{{ strtoupper(substr($d->user->name, 0, 1)) }}</span>
                        </div>
                        @endif
                        <h5 class="fw-bold mb-1">{{ $d->user->name }}</h5>
                        @if($d->degree)
                        <p class="text-muted mb-0">{{ $d->degree }}</p>
                        @endif
                      </div>
                      <div class="col-md-8">
                        <div class="mb-3">
                          <label class="text-muted small mb-1">Chuyên khoa</label>
                          <p class="fw-semibold">{{ $d->specialty }}</p>
                        </div>
                        @if($d->experience_years)
                        <div class="mb-3">
                          <label class="text-muted small mb-1">Kinh nghiệm</label>
                          <p class="fw-semibold">{{ $d->experience_years }} năm</p>
                        </div>
                        @endif
                        @if($d->email)
                        <div class="mb-3">
                          <label class="text-muted small mb-1">Email</label>
                          <p class="fw-semibold">{{ $d->email }}</p>
                        </div>
                        @endif
                        @if($d->phone)
                        <div class="mb-3">
                          <label class="text-muted small mb-1">Số điện thoại</label>
                          <p class="fw-semibold">{{ $d->phone }}</p>
                        </div>
                        @endif
                        @if($d->bio)
                        <div class="mb-3">
                          <label class="text-muted small mb-1">Tiểu sử</label>
                          <p>{{ $d->bio }}</p>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a href="{{ route('dentists.edit', $d) }}" class="btn btn-primary">
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
                <p class="text-muted">Chưa có bác sĩ nào trong hệ thống</p>
                <a href="{{ route('dentists.create') }}" class="btn btn-primary">Thêm bác sĩ đầu tiên</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    
    @if($dentists->hasPages())
    <div class="card-footer bg-white border-top py-3">
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">
          Hiển thị {{ $dentists->firstItem() }} - {{ $dentists->lastItem() }} trong tổng số {{ $dentists->total() }} bác sĩ
        </small>
        {{ $dentists->links() }}
      </div>
    </div>
    @endif
  </div>
</div>

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
  .modal-content {
    border: none;
    border-radius: 15px;
  }
</style>
@endsection