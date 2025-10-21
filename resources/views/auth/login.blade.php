@extends('layouts.app')

@section('content')
<style>
    .login-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 20px 40px;

    }

    .login-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1000px;
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

    .login-left {
        background: linear-gradient(135deg, #2dd4bf 0%, #3b82f6 100%);
        padding: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .login-left::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .login-left-content {
        position: relative;
        z-index: 1;
    }

    .login-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
    }

    .login-right {
        padding: 3rem;
    }

    .login-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .login-subtitle {
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
    }

    .input-icon:hover {
        color: #2dd4bf;
    }

    .password-wrapper {
        position: relative;
    }

    .form-check {
        margin-bottom: 1.5rem;
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
    }

    .btn-login {
        width: 100%;
        padding: 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #2dd4bf 0%, #3b82f6 100%);
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(45, 212, 191, 0.4);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: #94a3b8;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #e2e8f0;
    }

    .divider span {
        padding: 0 1rem;
        font-size: 0.9rem;
    }

    .social-login {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .social-btn {
        flex: 1;
        padding: 0.8rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        color: #475569;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .social-btn:hover {
        border-color: #2dd4bf;
        background: #f0fdfa;
        transform: translateY(-2px);
    }

    .register-link {
        text-align: center;
        margin-top: 1.5rem;
        color: #64748b;
    }

    .register-link a {
        color: #2dd4bf;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .register-link a:hover {
        color: #3b82f6;
        text-decoration: underline;
    }

    .forgot-password {
        text-align: right;
        margin-top: -0.5rem;
        margin-bottom: 1.5rem;
    }

    .forgot-password a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .forgot-password a:hover {
        color: #2dd4bf;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin-top: 2rem;
    }

    .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .feature-list li i {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.1rem;
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

    @media (max-width: 768px) {
        .login-left {
            display: none;
        }

        .login-right {
            padding: 2rem;
        }

        .login-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="login-card row g-0">
                    <!-- Left Side - Decorative -->
                    <div class="col-md-5 login-left d-none d-md-block">
                        <div class="login-left-content">
                            <div class="login-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Chào mừng trở lại!</h2>
                            <p class="mb-4 opacity-90">
                                Đăng nhập để quản lý lịch hẹn nha khoa của bạn một cách dễ dàng và nhanh chóng.
                            </p>
                            
                            <ul class="feature-list">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Đặt lịch hẹn trực tuyến 24/7</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Quản lý lịch sử khám bệnh</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Nhận thông báo nhắc nhở</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Tư vấn trực tuyến miễn phí</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="col-md-7 login-right">
                        <div class="text-center mb-4 d-md-none">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 60px;">
                        </div>

                        <h1 class="login-title">Đăng nhập</h1>
                        <p class="login-subtitle">Nhập thông tin để tiếp tục</p>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <form method="POST" action="{{ url('/login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="form-floating">
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="floatingEmail"
                                       placeholder="name@example.com"
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus>
                                <label for="floatingEmail">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                            </div>

                            <!-- Password Input -->
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

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input type="checkbox" 
                                           name="remember" 
                                           class="form-check-input" 
                                           id="remember">
                                    <label class="form-check-label" for="remember">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                <div class="forgot-password m-0">
                                    <a href="#">Quên mật khẩu?</a>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <button class="btn btn-login" type="submit">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Đăng nhập
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="divider">
                            <span>hoặc đăng nhập với</span>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login">
                            <button class="social-btn" type="button">
                                <i class="bi bi-google"></i>
                                Google
                            </button>
                            <button class="social-btn" type="button">
                                <i class="bi bi-facebook"></i>
                                Facebook
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="register-link">
                            Chưa có tài khoản? 
                            <a href="{{ route('register') }}">Đăng ký ngay</a>
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
        
        // Toggle icon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Add animation to form inputs
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection