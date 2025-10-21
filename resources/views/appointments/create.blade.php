@extends('layouts.app')

@section('content')
    <div class="appointment-booking-page">
        <!-- Header Section -->
        <div class="booking-header text-center mb-5">
            <div class="icon-wrapper mb-3">
                <i class="bi bi-calendar-heart"></i>
            </div>
            <h2 class="fw-bold mb-2">Đặt lịch khám răng</h2>
            <p class="text-muted">Chọn thông tin để tìm giờ khám phù hợp</p>
        </div>

        <!-- Search Form -->
        <div class="booking-form-card mb-4">
            <form method="GET" action="{{ route('appointments.create') }}">
                <div class="row g-3 align-items-end justify-content-center">
                    <!-- Bác sĩ -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-badge text-primary me-2"></i>Chọn bác sĩ
                        </label>
                        <select class="form-select form-select-modern" name="dentist_id" required>
                            <option value="">-- Chọn bác sĩ --</option>
                            @foreach ($dentists as $d)
                                <option value="{{ $d->id }}" @selected(($selected['dentist_id'] ?? null) == $d->id)>
                                    {{ $d->user->name }} - {{ $d->specialty }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dịch vụ -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-heart-pulse text-danger me-2"></i>Chọn dịch vụ
                        </label>
                        <select class="form-select form-select-modern" name="service_id" required>
                            <option value="">-- Chọn dịch vụ --</option>
                            @foreach ($services as $s)
                                <option value="{{ $s->id }}" @selected(($selected['service_id'] ?? null) == $s->id)>
                                    {{ $s->name }} ({{ number_format($s->price) }}đ - {{ $s->duration_mins }}')
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ngày khám -->
                    <div class="col-md-4 col-lg-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-calendar-event text-success me-2"></i>Ngày khám
                        </label>
                        <input type="date" class="form-control form-control-modern" name="date"
                            value="{{ $selected['date'] ?? '' }}" required>
                    </div>

                    <!-- Nút tìm giờ khám (đưa ra giữa) -->
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-gradient px-5 py-2 d-inline-flex align-items-center gap-2" type="submit">
                            <i class="bi bi-search"></i>
                            <span>Tìm giờ khám</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    @if (!empty($slots))
        <!-- Available Slots Section -->
        <div class="slots-section">
            <div class="section-header mb-4">
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Giờ khám trống
                </h4>
                <p class="text-muted mb-0">Vui lòng chọn giờ khám phù hợp</p>
            </div>

            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <input type="hidden" name="dentist_id" value="{{ $selected['dentist_id'] }}">
                <input type="hidden" name="service_id" value="{{ $selected['service_id'] }}">
                <input type="hidden" name="date" value="{{ $selected['date'] }}">

                <!-- Time Slots & Notes Row -->
                <div class="row g-4 mb-4">
                    <!-- Time Slots Grid - Left Side -->
                    <div class="col-lg-7">
                        <div class="time-slots-wrapper">
                            <div class="time-slots-grid">
                                @foreach ($slots as $i => $t)
                                    <div class="time-slot-item">
                                        <input type="radio" class="btn-check" name="time" id="slot{{ $i }}"
                                            value="{{ $t }}" required>
                                        <label class="time-slot-label" for="slot{{ $i }}">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ $t }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section - Right Side -->
                    <div class="col-lg-5">
                        <div class="notes-card h-100">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-pencil-square text-info me-2"></i>Ghi chú (không bắt buộc)
                            </label>
                            <textarea class="form-control form-control-modern" name="notes" rows="10"
                                placeholder="Mô tả triệu chứng hoặc lý do khám...&#10;&#10;Ví dụ:&#10;• Đau răng bên trái&#10;• Chảy máu chân răng&#10;• Răng ê buốt khi ăn lạnh"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button class="btn btn-confirm-booking" type="submit">
                        <i class="bi bi-check-circle me-2"></i>
                        Xác nhận đặt lịch
                    </button>
                </div>
            </form>
        </div>
    @elseif(isset($selected['date']))
        <!-- No Slots Available -->
        <div class="no-slots-card">
            <div class="text-center">
                <i class="bi bi-calendar-x mb-3"></i>
                <h5 class="fw-bold mb-2">Không có giờ trống</h5>
                <p class="text-muted mb-0">
                    Vui lòng chọn ngày khác hoặc thử với bác sĩ/dịch vụ khác
                </p>
            </div>
        </div>
    @endif
    </div>

    <style>
        /* Main Container - THÊM PADDING TOP */
        .appointment-booking-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 20px 40px; /* Tăng padding-top từ 40px lên 120px */
            min-height: 100vh;
        }

        /* Header Section */
        .booking-header {
            animation: fadeInDown 0.6s ease-out;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            animation: pulse 2s infinite;
        }

        .icon-wrapper i {
            font-size: 2.5rem;
            color: white;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        /* Booking Form Card */
        .booking-form-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        /* Modern Form Controls */
        .form-select-modern,
        .form-control-modern {
            border: 2px solid #e0e7ff;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f8faff;
        }

        .form-select-modern:focus,
        .form-control-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            background-color: white;
            transform: translateY(-2px);
        }

        .form-label {
            color: #1e293b;
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Gradient Button */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            padding: 14px 40px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        /* Slots Section */
        .slots-section {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .section-header {
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
        }

        /* Time Slots Grid */
        .time-slots-wrapper {
            background: #f8faff;
            border-radius: 16px;
            padding: 20px;
        }

        .time-slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .time-slot-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 16px 12px;
            background: white;
            border: 2px solid #e0e7ff;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #475569;
            min-height: 80px;
        }

        .time-slot-label i {
            font-size: 20px;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .time-slot-label:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
        }

        .time-slot-label:hover i {
            color: #667eea;
            transform: scale(1.1);
        }

        .btn-check:checked + .time-slot-label {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-check:checked + .time-slot-label i {
            color: white;
        }

        /* Notes Card */
        .notes-card {
            background: #f8faff;
            border-radius: 16px;
            padding: 20px;
        }

        .notes-card textarea {
            resize: none;
            min-height: 100%;
        }

        /* Confirm Button */
        .btn-confirm-booking {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 18px;
            padding: 16px 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .btn-confirm-booking:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        /* No Slots Card */
        .no-slots-card {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .no-slots-card i {
            font-size: 4rem;
            color: #f59e0b;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .appointment-booking-page {
                padding: 100px 15px 20px; /* Giảm padding top cho mobile */
            }

            .booking-form-card,
            .slots-section {
                padding: 25px 20px;
            }

            .time-slots-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 10px;
            }

            .time-slot-label {
                padding: 12px 8px;
                min-height: 70px;
                font-size: 14px;
            }

            .icon-wrapper {
                width: 60px;
                height: 60px;
            }

            .icon-wrapper i {
                font-size: 2rem;
            }

            .btn-gradient,
            .btn-confirm-booking {
                width: 100%;
                padding: 14px 30px;
            }
        }
    </style>
@endsection