<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập / Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-wrapper {
            position: relative;
            width: 100%;
            max-width: 450px;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .auth-container::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
            position: relative;
            z-index: 1;
        }

        .auth-header h2 {
            color: #333;
            font-weight: 700;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #666;
            font-size: 14px;
        }

        .tab-selector {
            display: flex;
            background: #f0f0f0;
            border-radius: 50px;
            padding: 5px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: transparent;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            font-size: 15px;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .form-content {
            position: relative;
            z-index: 1;
        }

        .tab-pane {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .tab-pane.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #999;
            font-size: 13px;
            position: relative;
        }

        .social-login {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
            color: #666;
        }

        .social-btn:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .social-btn i {
            font-size: 18px;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 30px 25px;
            }

            .auth-header h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-header">
                <h2>Chào Mừng Trở Lại</h2>
                <p>Vui lòng đăng nhập để tiếp tục</p>
            </div>

            <div class="tab-selector">
                <button class="tab-btn active" onclick="switchTab('login')">
                    <i class="fas fa-sign-in-alt"></i> Đăng Nhập
                </button>
                <button class="tab-btn" onclick="switchTab('register')">
                    <i class="fas fa-user-plus"></i> Đăng Ký
                </button>
            </div>

            <div class="form-content">
                {{-- Form Đăng Nhập --}}
                <div class="tab-pane active" id="login">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Địa Chỉ Email</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                            </div>
                            @error('email') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Mật Khẩu</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                            </div>
                            @error('password') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="forgot-password">
                            <a href="#">Quên Mật Khẩu?</a>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-sign-in-alt"></i> Đăng Nhập Ngay
                        </button>
                    </form>

                    <div class="divider">
                        <span>HOẶC TIẾP TỤC VỚI</span>
                    </div>

                    <div class="social-login">
                        <button class="social-btn" type="button">
                            <i class="fab fa-google" style="color: #DB4437;"></i>
                        </button>
                        <button class="social-btn" type="button">
                            <i class="fab fa-facebook-f" style="color: #4267B2;"></i>
                        </button>
                        <button class="social-btn" type="button">
                            <i class="fab fa-github" style="color: #333;"></i>
                        </button>
                    </div>
                </div>

                {{-- Form Đăng Ký --}}
                <div class="tab-pane" id="register">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Họ và Tên</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên" value="{{ old('name') }}" required>
                            </div>
                            @error('name') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Địa Chỉ Email</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                            </div>
                            @error('email') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Mật Khẩu</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control" placeholder="Tạo mật khẩu" required>
                            </div>
                            @error('password') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Xác Nhận Mật Khẩu</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-user-plus"></i> Tạo Tài Khoản
                        </button>
                    </form>

                    <div class="divider">
                        <span>HOẶC ĐĂNG KÝ VỚI</span>
                    </div>

                    <div class="social-login">
                        <button class="social-btn" type="button">
                            <i class="fab fa-google" style="color: #DB4437;"></i>
                        </button>
                        <button class="social-btn" type="button">
                            <i class="fab fa-facebook-f" style="color: #4267B2;"></i>
                        </button>
                        <button class="social-btn" type="button">
                            <i class="fab fa-github" style="color: #333;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchTab(tab) {
            const tabs = document.querySelectorAll('.tab-pane');
            const btns = document.querySelectorAll('.tab-btn');
            
            tabs.forEach(t => t.classList.remove('active'));
            btns.forEach(b => b.classList.remove('active'));
            
            document.getElementById(tab).classList.add('active');
            event.target.closest('.tab-btn').classList.add('active');
            
            // Cập nhật tiêu đề
            const header = document.querySelector('.auth-header h2');
            const subtext = document.querySelector('.auth-header p');
            
            if (tab === 'login') {
                header.textContent = 'Chào Mừng Trở Lại';
                subtext.textContent = 'Vui lòng đăng nhập để tiếp tục';
            } else {
                header.textContent = 'Tạo Tài Khoản';
                subtext.textContent = 'Đăng ký để bắt đầu';
            }
        }

        // Tự động chuyển sang tab Register nếu có lỗi validation từ form đăng ký
        @if($errors->has('name') || (old('_token') && request()->route()->getName() === 'register'))
            document.addEventListener('DOMContentLoaded', function() {
                switchTab('register');
                document.querySelectorAll('.tab-btn')[1].classList.add('active');
                document.querySelectorAll('.tab-btn')[0].classList.remove('active');
            });
        @endif
    </script>
</body>
</html>