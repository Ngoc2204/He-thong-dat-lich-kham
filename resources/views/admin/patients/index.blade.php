@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Quản lý bệnh nhân</h2>
      <p class="text-muted mb-0">Tổng cộng <strong>{{ $patients->total() }}</strong> bệnh nhân</p>
    </div>
    <a href="{{ route('patients.create') }}" class="btn btn-primary btn-lg">
      <i class="bi bi-plus-circle me-2"></i>Thêm bệnh nhân
    </a>
  </div>

  <!-- Stats Cards -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
              <i class="bi bi-people fs-4 text-primary"></i>
            </div>
            <div>
              <small class="text-muted d-block">Tổng bệnh nhân</small>
              <h5 class="fw-bold mb-0">{{ $patients->total() }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
              <i class="bi bi-check-circle fs-4 text-success"></i>
            </div>
            <div>
              <small class="text-muted d-block">Đang hoạt động</small>
              <h5 class="fw-bold mb-0">{{ $activeCount ?? 0 }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
              <i class="bi bi-exclamation-circle fs-4 text-warning"></i>
            </div>
            <div>
              <small class="text-muted d-block">Cần theo dõi</small>
              <h5 class="fw-bold mb-0">{{ $needFollowUp ?? 0 }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
              <i class="bi bi-calendar-check fs-4 text-info"></i>
            </div>
            <div>
              <small class="text-muted d-block">Lịch hẹn sắp tới</small>
              <h5 class="fw-bold mb-0">{{ $upcomingAppointments ?? 0 }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters and Search -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
      <form method="GET" action="{{ route('patients.index') }}" class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Tìm kiếm</label>
          <input type="text"
                 class="form-control form-control-lg"
                 name="search"
                 placeholder="Tên, email, số điện thoại..."
                 value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Giới tính</label>
          <select class="form-select form-select-lg" name="gender">
            <option value="">-- Tất cả --</option>
            <option value="male" @selected(request('gender') === 'male')>Nam</option>
            <option value="female" @selected(request('gender') === 'female')>Nữ</option>
            <option value="other" @selected(request('gender') === 'other')>Khác</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Trạng thái</label>
          <select class="form-select form-select-lg" name="status">
            <option value="">-- Tất cả --</option>
            <option value="active" @selected(request('status') === 'active')>Hoạt động</option>
            <option value="inactive" @selected(request('status') === 'inactive')>Không hoạt động</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Sắp xếp</label>
          <select class="form-select form-select-lg" name="sort">
            <option value="-created_at" @selected(request('sort') === '-created_at' || !request('sort'))>Mới nhất</option>
            <option value="created_at" @selected(request('sort') === 'created_at')>Cũ nhất</option>
            <option value="name" @selected(request('sort') === 'name')>A - Z</option>
            <option value="-name" @selected(request('sort') === '-name')>Z - A</option>
          </select>
        </div>

        <div class="col-md-2 d-flex align-items-end gap-2">
          <button type="submit" class="btn btn-primary btn-lg w-100">
            <i class="bi bi-search me-1"></i>Lọc
          </button>
          <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-arrow-clockwise"></i>
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Patients Table -->
  <div class="card border-0 shadow-sm">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th class="ps-4">
              <i class="bi bi-person"></i> Bệnh nhân
            </th>
            <th>
              <i class="bi bi-telephone"></i> Liên hệ
            </th>
            <th>
              <i class="bi bi-calendar"></i> Ngày sinh
            </th>
            <th class="text-center">
              <i class="bi bi-info-circle"></i> Trạng thái
            </th>
            <th>
              <i class="bi bi-calendar-event"></i> Lịch hẹn
            </th>
            <th class="text-end pe-4">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @forelse($patients as $patient)
          <tr>
            <td class="ps-4">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-sm">
                  @if($patient->avatar)
                    <img src="{{ asset('storage/' . $patient->avatar) }}"
                         class="rounded-circle"
                         style="width: 40px; height: 40px; object-fit: cover;">
                  @else
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                         style="width: 40px; height: 40px;">
                      <i class="bi bi-person text-primary"></i>
                    </div>
                  @endif
                </div>
                <div>
                  <div class="fw-semibold">{{ $patient->name }}</div>
                  <small class="text-muted">
                    @if($patient->gender === 'male')
                      <i class="bi bi-mars text-primary"></i> Nam
                    @elseif($patient->gender === 'female')
                      <i class="bi bi-venus text-danger"></i> Nữ
                    @else
                      <i class="bi bi-question-circle text-secondary"></i> Khác
                    @endif
                  </small>
                </div>
              </div>
            </td>
            <td>
              <div class="fw-semibold">{{ $patient->phone }}</div>
              <small class="text-muted text-break">{{ $patient->email }}</small>
            </td>
            <td>
              @if($patient->date_of_birth)
                <div>{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}</div>
                <small class="text-muted">{{ $patient->getAge() }} tuổi</small>
              @else
                <span class="text-muted">--</span>
              @endif
            </td>
            <td class="text-center">
              @if($patient->status === 'active')
                <span class="badge bg-success bg-opacity-10 text-success">
                  <i class="bi bi-check-circle me-1"></i>Hoạt động
                </span>
              @else
                <span class="badge bg-secondary bg-opacity-10 text-secondary">
                  <i class="bi bi-x-circle me-1"></i>Không hoạt động
                </span>
              @endif
            </td>
            
            <td>
              @php
                $appointmentCount = $patient->appointments()->whereIn('status', ['pending', 'confirmed'])->count();
              @endphp
              @if($appointmentCount > 0)
                <span class="badge bg-warning bg-opacity-10 text-warning">
                  <i class="bi bi-calendar-check me-1"></i>{{ $appointmentCount }}
                </span>
              @else
                <span class="text-muted">0</span>
              @endif
            </td>
            <td class="text-end pe-4">
              <div class="btn-group btn-group-sm" role="group">
                

                <a href="{{ route('patients.edit', $patient) }}"
                   class="btn btn-outline-secondary"
                   title="Chỉnh sửa">
                  <i class="bi bi-pencil"></i>
                </a>

                <button type="button"
                        class="btn btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $patient->id }}"
                        title="Xoá">
                  <i class="bi bi-trash"></i>
                </button>
              </div>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0">
                    <div class="modal-header border-0 bg-danger bg-opacity-10">
                      <h5 class="modal-title fw-bold text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Xoá bệnh nhân
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-0">Bạn có chắc chắn muốn xoá bệnh nhân <strong>{{ $patient->name }}</strong> không?</p>
                      <p class="text-muted small mt-2 mb-0">Tất cả dữ liệu liên quan sẽ bị xoá.</p>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                      <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="d-inline">
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
              <p class="text-muted mb-0">Không có bệnh nhân nào</p>
            </td>
          </tr>
          @endempty
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($patients->hasPages())
    <div class="card-footer bg-white border-top py-3">
      {{ $patients->links() }}
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

  .badge {
    padding: 0.4rem 0.65rem;
    font-weight: 500;
    font-size: 0.8rem;
  }

  .avatar-sm {
    display: inline-flex;
    align-items: center;
  }

  .card {
    transition: all 0.3s ease;
  }

  .stats-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }
</style>
@endsection