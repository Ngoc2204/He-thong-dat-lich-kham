@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Quản lý lịch hẹn</h2>
      <p class="text-muted mb-0">Tổng cộng <strong>{{ $appointments->total() }}</strong> lịch hẹn</p>
    </div>
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary btn-lg">
      <i class="bi bi-plus-circle me-2"></i>Thêm lịch hẹn
    </a>
  </div>

  <!-- Filters and Search -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
      <form method="GET" action="{{ route('admin.appointments.index') }}" class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Tìm kiếm</label>
          <input type="text" 
                 class="form-control form-control-lg" 
                 name="search" 
                 placeholder="Tên bệnh nhân, bác sĩ..."
                 value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Trạng thái</label>
          <select class="form-select form-select-lg" name="status">
            <option value="">-- Tất cả --</option>
            <option value="pending" @selected(request('status') === 'pending')>Chờ xác nhận</option>
            <option value="confirmed" @selected(request('status') === 'confirmed')>Đã xác nhận</option>
            <option value="completed" @selected(request('status') === 'completed')>Hoàn tất</option>
            <option value="cancelled" @selected(request('status') === 'cancelled')>Huỷ</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Ngày</label>
          <input type="date" 
                 class="form-control form-control-lg" 
                 name="date"
                 value="{{ request('date') }}">
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Bác sĩ</label>
          <select class="form-select form-select-lg" name="dentist_id">
            <option value="">-- Tất cả --</option>
            @foreach($dentists as $d)
            <option value="{{ $d->id }}" @selected(request('dentist_id') == $d->id)>
              {{ $d->user->name }}
            </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-2 d-flex align-items-end gap-2">
          <button type="submit" class="btn btn-primary btn-lg w-100">
            <i class="bi bi-search me-1"></i>Lọc
          </button>
          <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-arrow-clockwise"></i>
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Appointments Table -->
  <div class="card border-0 shadow-sm">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th class="ps-4">
              <i class="bi bi-hash"></i> ID
            </th>
            <th>
              <i class="bi bi-calendar-event"></i> Thời gian
            </th>
            <th>
              <i class="bi bi-person"></i> Bệnh nhân
            </th>
            <th>
              <i class="bi bi-stethoscope"></i> Bác sĩ
            </th>
            <th>
              <i class="bi bi-bandaid"></i> Dịch vụ
            </th>
            <th class="text-center">
              <i class="bi bi-info-circle"></i> Trạng thái
            </th>
            <th class="text-end pe-4">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @forelse($appointments as $a)
          <tr>
            <td class="ps-4">
              <span class="badge bg-light text-dark fw-semibold">#{{ $a->id }}</span>
            </td>
            <td>
              <div class="fw-semibold">{{ $a->starts_at->format('d/m/Y') }}</div>
              <small class="text-muted">
                {{ $a->starts_at->format('H:i') }} - {{ $a->ends_at->format('H:i') }}
              </small>
            </td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-sm">
                  @if($a->patient->avatar)
                    <img src="{{ asset('storage/' . $a->patient->avatar) }}" 
                         class="rounded-circle" 
                         style="width: 32px; height: 32px; object-fit: cover;">
                  @else
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                         style="width: 32px; height: 32px;">
                      <i class="bi bi-person text-primary"></i>
                    </div>
                  @endif
                </div>
                <div>
                  <div class="fw-semibold">{{ $a->patient->name }}</div>
                  <small class="text-muted">{{ $a->patient->phone }}</small>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-sm">
                  @if($a->dentist->avatar)
                    <img src="{{ asset('storage/' . $a->dentist->avatar) }}" 
                         class="rounded-circle" 
                         style="width: 32px; height: 32px; object-fit: cover;">
                  @else
                    <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center"
                         style="width: 32px; height: 32px;">
                      <i class="bi bi-person-check text-success"></i>
                    </div>
                  @endif
                </div>
                <div>
                  <div class="fw-semibold">{{ $a->dentist->user->name }}</div>
                  <small class="text-muted">{{ $a->dentist->specialty }}</small>
                </div>
              </div>
            </td>
            <td>
              <span class="badge bg-info bg-opacity-10 text-info">{{ $a->service->name }}</span>
            </td>
            <td class="text-center">
              @php
                $statusConfig = [
                  'pending' => ['badge' => 'warning', 'text' => 'Chờ xác nhận', 'icon' => 'clock'],
                  'confirmed' => ['badge' => 'info', 'text' => 'Đã xác nhận', 'icon' => 'check-circle'],
                  'completed' => ['badge' => 'success', 'text' => 'Hoàn tất', 'icon' => 'check2-circle'],
                  'cancelled' => ['badge' => 'danger', 'text' => 'Huỷ', 'icon' => 'x-circle'],
                ];
                $config = $statusConfig[$a->status] ?? $statusConfig['pending'];
              @endphp
              <span class="badge bg-{{ $config['badge'] }} bg-opacity-10 text-{{ $config['badge'] }}">
                <i class="bi bi-{{ $config['icon'] }} me-1"></i>{{ $config['text'] }}
              </span>
            </td>
            <td class="text-end pe-4">
              <div class="btn-group btn-group-sm" role="group">
                <button type="button" 
                        class="btn btn-outline-primary" 
                        data-bs-toggle="dropdown"
                        data-bs-display="static"
                        title="Cập nhật trạng thái">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <form method="POST" action="{{ route('admin.appointments.status', $a) }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="status" value="pending">
                      <button type="submit" class="dropdown-item {{ $a->status === 'pending' ? 'active' : '' }}">
                        <i class="bi bi-clock me-2 text-warning"></i>Chờ xác nhận
                      </button>
                    </form>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('admin.appointments.status', $a) }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="status" value="confirmed">
                      <button type="submit" class="dropdown-item {{ $a->status === 'confirmed' ? 'active' : '' }}">
                        <i class="bi bi-check-circle me-2 text-info"></i>Đã xác nhận
                      </button>
                    </form>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('admin.appointments.status', $a) }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="status" value="completed">
                      <button type="submit" class="dropdown-item {{ $a->status === 'completed' ? 'active' : '' }}">
                        <i class="bi bi-check2-circle me-2 text-success"></i>Hoàn tất
                      </button>
                    </form>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form method="POST" action="{{ route('admin.appointments.status', $a) }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="status" value="cancelled">
                      <button type="submit" class="dropdown-item {{ $a->status === 'cancelled' ? 'active' : '' }}">
                        <i class="bi bi-x-circle me-2 text-danger"></i>Huỷ
                      </button>
                    </form>
                  </li>
                </ul>

                <a href="" 
                   class="btn btn-outline-secondary" 
                   title="Chỉnh sửa">
                  <i class="bi bi-pencil"></i>
                </a>

                <button type="button" 
                        class="btn btn-outline-danger" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal{{ $a->id }}"
                        title="Xoá">
                  <i class="bi bi-trash"></i>
                </button>
              </div>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal{{ $a->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0">
                    <div class="modal-header border-0 bg-danger bg-opacity-10">
                      <h5 class="modal-title fw-bold text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Xoá lịch hẹn
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-0">Bạn có chắc chắn muốn xoá lịch hẹn <strong>#{{ $a->id }}</strong> của <strong>{{ $a->patient->name }}</strong> không?</p>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                      <form method="POST" action="{{ route('admin.appointments.destroy', $a) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                          <i class="bi bi-trash me-2"></i>Xoá
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-5">
              <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
              <p class="text-muted mb-0">Không có lịch hẹn nào</p>
            </td>
          </tr>
          @endempty
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($appointments->hasPages())
    <div class="card-footer bg-white border-top py-3">
      {{ $appointments->links() }}
    </div>
    @endif
  </div>
</div>

<style>
  .table-hover tbody tr {
    transition: background-color 0.2s ease;
  }

  .table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
  }

  .btn-group-sm .btn {
    padding: 0.35rem 0.65rem;
    font-size: 0.875rem;
  }

  .dropdown-item.active {
    background-color: rgba(0, 0, 0, 0.05);
    color: inherit;
  }

  .dropdown-item.active::before {
    content: '✓ ';
    font-weight: bold;
    margin-right: 0.25rem;
  }

  .badge {
    padding: 0.4rem 0.65rem;
    font-weight: 500;
    font-size: 0.8rem;
  }

  .avatar-sm {
    display: inline-flex;
    align-items: center;
  }

  .table td, .table th {
  vertical-align: middle;
}

.dropdown-menu {
  z-index: 2000 !important;
}

.table-responsive {
  overflow: visible !important;
}


</style>
@endsection