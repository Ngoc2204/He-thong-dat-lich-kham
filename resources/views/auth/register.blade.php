@extends('layouts.app')

@section('content')
<style>
    .register-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 20px 40px;
    }

    .register-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1100px;
        width: 100%;
        animation: fadeInUp 0.6s ease;
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

    .register-left {
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        padding: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .register-left::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: rotate 25s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .register-left-content {
        position: relative;
        z-index: 1;
    }

    .register-icon {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .register-right {
        padding: 3rem;
    }

    .register-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .register-subtitle {
        color: #64748b;
        margin-bottom: 2rem;
    }

    .form-floating {
        margin-bottom: 1.5rem;
    }

    .form-floating > .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1rem;
        height: 60px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-floating > .form-control:focus {
        border-color: #2dd4bf;
        box-shadow: 0 0 0 4px rgba(45, 212, 191, 0.1);
    }

    .form-floating > label {
        padding: 1rem 1rem;
        color: #64748b;
    }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        cursor: pointer;
        z-index: 4;
        transition: all 0.3s ease;
    }

    .input-icon:hover {
        color: #2dd4bf;
    }

    .password-wrapper {
        position: relative;
    }

    .password-strength {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        margin-top: 0.5rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: all 0.3s ease;
    }

    .strength-weak {
        background: #ef4444;
        width: 33%;
    }

    .strength-medium {
        background: #f59e0b;
        width: 66%;
    }

    .strength-strong {
        background: #10b981;
        width: 100%;
    }

    .password-hint {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 0.5rem;
    }

    .btn-register {
        width: 100%;
        padding: 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        color: #64748b;
    }

    .login-link a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .login-link a:hover {
        color: #2dd4bf;
        text-decoration: underline;
    }

    .benefit-list {
        list-style: none;
        padding: 0;
        margin-top: 2rem;
    }

    .benefit-list li {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.05rem;
    }

    .benefit-list li i {
        width: 35px;
        height: 35px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .stats-box {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 2rem;
        backdrop-filter: blur(10px);
    }

    .stats-row {
        display: flex;
        justify-content: space-around;
        text-align: center;
    }

    .stat-item {
        flex: 1;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .alert {
        border: none;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .form-row {
        display: flex;
        gap: 1rem;
    }

    .form-row .form-floating {
        flex: 1;
    }

    .terms-check {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
    }

    .form-check-input {
        width: 1.2rem;
        height: 1.2rem;
        border: 2px solid #cbd5e1;
        border-radius: 6px;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #2dd4bf;
        border-color: #2dd4bf;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 4px rgba(45, 212, 191, 0.1);
    }

    .form-check-label {
        margin-left: 0.5rem;
        color: #475569;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .form-check-label a {
        color: #3b82f6;
        text-decoration: none;
    }

    .form-check-label a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .register-left {
            display: none;
        }

        .register-right {
            padding: 2rem;
        }

        .register-title {
            font-size: 1.5rem;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="register-card row g-0">
                    <!-- Left Side - Benefits -->
                    <div class="col-md-5 register-left d-none d-md-flex">
                        <div class="register-left-content">
                            <div class="register-icon">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Tham gia cùng chúng tôi!</h2>
                            <p class="mb-4 opacity-90" style="font-size: 1.05rem;">
                                Đăng ký tài khoản để trải nghiệm dịch vụ nha khoa chuyên nghiệp với nhiều ưu đãi hấp dẫn.
                            </p>
                            
                            <ul class="benefit-list">
                                <li>
                                    <i class="bi bi-calendar-check"></i>
                                    <span>Đặt lịch nhanh chóng, dễ dàng</span>
                                </li>
                                <li>
                                    <i class="bi bi-bell"></i>
                                    <span>Nhận thông báo nhắc lịch hẹn</span>
                                </li>
                                <li>
                                    <i class="bi bi-gift"></i>
                                    <span>Ưu đãi dành riêng cho thành viên</span>
                                </li>
                                <li>
                                    <i class="bi bi-headset"></i>
                                    <span>Tư vấn trực tuyến miễn phí 24/7</span>
                                </li>
                                <li>
                                    <i class="bi bi-shield-check"></i>
                                    <span>Bảo mật thông tin tuyệt đối</span>
                                </li>
                            </ul>

                            <div class="stats-box">
                                <div class="stats-row">
                                    <div class="stat-item">
                                        <span class="stat-number">5000+</span>
                                        <span class="stat-label">Khách hàng</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">98%</span>
                                        <span class="stat-label">Hài lòng</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">15+</span>
                                        <span class="stat-label">Năm kinh nghiệm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Register Form -->
                    <div class="col-md-7 register-right">
                        <div class="text-center mb-4 d-md-none">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 60px;">
                        </div>

                        <h1 class="register-title">Đăng ký tài khoản</h1>
                        <p class="register-subtitle">Tạo tài khoản mới để bắt đầu sử dụng dịch vụ</p>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Có lỗi xảy ra:</strong>
                            <ul class="mb-0 mt-2" style="padding-left: 1.5rem;">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ url('/register') }}" id="registerForm">
                            @csrf

                            <!-- Full Name -->
                            <div class="form-floating">
                                <input type="text" 
                                       name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="floatingName"
                                       placeholder="Nguyễn Văn A"
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus>
                                <label for="floatingName">
                                    <i class="bi bi-person me-2"></i>Họ và tên
                                </label>
                            </div>

                            <!-- Email & Phone Row -->
                            <div class="form-row">
                                <div class="form-floating">
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="floatingEmail"
                                           placeholder="name@example.com"
                                           value="{{ old('email') }}" 
                                           required>
                                    <label for="floatingEmail">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" 
                                           name="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="floatingPhone"
                                           placeholder="0123456789"
                                           value="{{ old('phone') }}">
                                    <label for="floatingPhone">
                                        <i class="bi bi-telephone me-2"></i>Số điện thoại
                                    </label>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="password-wrapper">
                                <div class="form-floating">
                                    <input type="password" 
                                           name="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="floatingPassword"
                                           placeholder="Password"
                                           required>
                                    <label for="floatingPassword">
                                        <i class="bi bi-lock me-2"></i>Mật khẩu
                                    </label>
                                </div>
                                <i class="bi bi-eye input-icon" id="togglePassword"></i>
                            </div>
                            
                            <!-- Password Strength -->
                            <div class="password-strength">
                                <div class="password-strength-bar" id="strengthBar"></div>
                            </div>
                            <div class="password-hint" id="passwordHint">
                                Mật khẩu nên có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số
                            </div>

                            <!-- Confirm Password -->
                            <div class="password-wrapper">
                                <div class="form-floating">
                                    <input type="password" 
                                           name="password_confirmation" 
                                           class="form-control" 
                                           id="floatingPasswordConfirm"
                                           placeholder="Password"
                                           required>
                                    <label for="floatingPasswordConfirm">
                                        <i class="bi bi-lock-fill me-2"></i>Xác nhận mật khẩu
                                    </label>
                                </div>
                                <i class="bi bi-eye input-icon" id="togglePasswordConfirm"></i>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="terms-check">
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="terms"
                                           required>
                                    <label class="form-check-label" for="terms">
                                        Tôi đồng ý với 
                                        <a href="#" target="_blank">Điều khoản dịch vụ</a> 
                                        và 
                                        <a href="#" target="_blank">Chính sách bảo mật</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <button class="btn btn-register" type="submit">
                                <i class="bi bi-person-check me-2"></i>
                                Đăng ký ngay
                            </button>
                        </form>

                        <!-- Login Link -->
                        <div class="login-link">
                            Đã có tài khoản? 
                            <a href="{{ route('login') }}">Đăng nhập ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('floatingPassword');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
        const passwordInput = document.getElementById('floatingPasswordConfirm');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Password Strength Checker
    document.getElementById('floatingPassword').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('strengthBar');
        const hint = document.getElementById('passwordHint');
        
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        strengthBar.className = 'password-strength-bar';
        
        if (strength === 0) {
            strengthBar.classList.remove('strength-weak', 'strength-medium', 'strength-strong');
            hint.textContent = 'Mật khẩu nên có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số';
            hint.style.color = '#64748b';
        } else if (strength <= 2) {
            strengthBar.classList.add('strength-weak');
            hint.textContent = 'Mật khẩu yếu - Hãy thêm chữ hoa, số hoặc ký tự đặc biệt';
            hint.style.color = '#ef4444';
        } else if (strength === 3) {
            strengthBar.classList.add('strength-medium');
            hint.textContent = 'Mật khẩu trung bình - Khá tốt!';
            hint.style.color = '#f59e0b';
        } else {
            strengthBar.classList.add('strength-strong');
            hint.textContent = 'Mật khẩu mạnh - Tuyệt vời!';
            hint.style.color = '#10b981';
        }
    });

    // Password Confirmation Match
    const passwordInput = document.getElementById('floatingPassword');
    const confirmInput = document.getElementById('floatingPasswordConfirm');
    
    confirmInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value) {
            this.setCustomValidity('Mật khẩu không khớp');
        } else {
            this.setCustomValidity('');
        }
    });

    // Form Animation
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });

    // Phone Number Formatting (Vietnamese format)
    document.getElementById('floatingPhone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        e.target.value = value;
    });
</script>
@endsection