@extends('layouts.dentist')

@section('content')
<div class="container py-5">
    
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-2 text-gradient fw-bold">
                <i class="bi bi-people-fill me-2"></i>Danh sách bệnh nhân
            </h1>
            <p class="text-muted mb-0">
                <i class="bi bi-info-circle me-1"></i>
                Quản lý thông tin bệnh nhân đã từng khám
            </p>
        </div>
        @if(!$patients->isEmpty())
            <div class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
                <i class="bi bi-person-check-fill me-1"></i>
                {{ $patients->count() }} bệnh nhân
            </div>
        @endif
    </div>

    @if($patients->isEmpty())
        {{-- Empty State --}}
        <div class="card border-0 shadow-sm rounded-4 bg-light">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                </div>
                <h4 class="fw-bold text-dark mb-3">Chưa có bệnh nhân nào</h4>
                <p class="text-muted mb-4">
                    Danh sách bệnh nhân sẽ hiển thị sau khi có người đặt lịch khám với bạn.
                </p>
                <a href="{{ route('dentist.schedules.index') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-calendar-plus me-2"></i>Quản lý lịch làm việc
                </a>
            </div>
        </div>
    @else
        {{-- Patients Table --}}
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            
            {{-- Card Header --}}
            <div class="card-header bg-gradient-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-list-ul me-2"></i>Thông tin bệnh nhân
                    </h5>
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-white border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-0" 
                               placeholder="Tìm kiếm bệnh nhân...">
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="patientsTable">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3" style="width: 60px;">#</th>
                                <th class="py-3">
                                    <i class="bi bi-person me-1"></i>Tên bệnh nhân
                                </th>
                                <th class="py-3">
                                    <i class="bi bi-envelope me-1"></i>Email
                                </th>
                                <th class="py-3">
                                    <i class="bi bi-telephone me-1"></i>Số điện thoại
                                </th>
                                <th class="py-3 text-center">
                                    <i class="bi bi-calendar-check me-1"></i>Số lần hẹn
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $index => $patient)
                                <tr class="patient-row">
                                    <td class="px-4 fw-semibold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark patient-name">
                                                    {{ $patient->name }}
                                                </div>
                                                <small class="text-muted">ID: #{{ $patient->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-primary patient-email">
                                            <i class="bi bi-envelope-fill me-1"></i>{{ $patient->email }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($patient->phone)
                                            <span class="badge bg-light text-dark border patient-phone">
                                                <i class="bi bi-phone-fill me-1"></i>{{ $patient->phone }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">
                                                <i class="bi bi-dash-circle me-1"></i>Chưa cập nhật
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $appointmentCount = \App\Models\Appointment::where('dentist_id', Auth::user()->dentist->id)
                                                ->where('patient_id', $patient->id)
                                                ->count();
                                        @endphp
                                        <span class="badge bg-primary-subtle text-primary fs-6 px-3 py-2 rounded-pill">
                                            {{ $appointmentCount }} lần
                                        </span>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer --}}
            <div class="card-footer bg-light border-0 py-3">
                <div class="d-flex justify-content-between align-items-center text-muted small">
                    <span>
                        <i class="bi bi-info-circle me-1"></i>
                        Hiển thị <strong>{{ $patients->count() }}</strong> bệnh nhân
                    </span>
                    <span>
                        <i class="bi bi-clock-history me-1"></i>
                        Cập nhật: {{ now()->format('d/m/Y H:i') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Quick Stats Cards --}}
        <div class="row g-3 mt-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 bg-primary-subtle">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-people-fill display-4 text-primary mb-2"></i>
                        <h3 class="fw-bold text-primary mb-0">{{ $patients->count() }}</h3>
                        <p class="text-muted mb-0">Tổng bệnh nhân</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 bg-success-subtle">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-calendar-check-fill display-4 text-success mb-2"></i>
                        <h3 class="fw-bold text-success mb-0">
                            {{ \App\Models\Appointment::where('dentist_id', Auth::user()->dentist->id)->count() }}
                        </h3>
                        <p class="text-muted mb-0">Tổng lượt khám</p>
                    </div>
                </div>
            </div>
            
        </div>
    @endif
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    flex-shrink: 0;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.card {
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .table {
        font-size: 0.875rem;
    }
    
    .avatar-circle {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.patient-row');
            
            rows.forEach(row => {
                const name = row.querySelector('.patient-name')?.textContent.toLowerCase() || '';
                const email = row.querySelector('.patient-email')?.textContent.toLowerCase() || '';
                const phone = row.querySelector('.patient-phone')?.textContent.toLowerCase() || '';
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection