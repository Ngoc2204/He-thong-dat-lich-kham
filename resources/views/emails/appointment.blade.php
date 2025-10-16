<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo lịch hẹn</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 30px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 16px;
            color: #333333;
            margin-bottom: 25px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-updated {
            background-color: #fff3cd;
            color: #856404;
        }

        .appointment-card {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            border-radius: 8px;
            padding: 25px;
            margin: 20px 0;
        }

        .appointment-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #e9ecef;
        }

        .appointment-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .item-icon {
            width: 40px;
            height: 40px;
            background-color: #667eea;
            color: #ffffff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 18px;
        }

        .item-content {
            flex: 1;
        }

        .item-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .item-value {
            font-size: 16px;
            color: #333333;
            font-weight: 500;
        }

        .message {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #0c5460;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .footer-brand {
            font-size: 18px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }

        .footer-text {
            font-size: 13px;
            color: #6c757d;
            margin: 5px 0;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e9ecef, transparent);
            margin: 30px 0;
        }


        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .appointment-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">

            <h1>
                @if ($type === 'cancelled')
                Lịch hẹn đã bị hủy
                @elseif ($type === 'updated')
                Cập nhật lịch hẹn
                @else
                Xác nhận lịch hẹn
                @endif
            </h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Xin chào <strong>{{ $appointment->patient->name ?? 'Quý khách' }}</strong>,</p>

            <!-- Status Badge -->
            <div>
                <span class="status-badge 
                    @if ($type === 'cancelled')
                        status-cancelled
                    @elseif ($type === 'updated')
                        status-updated
                    @else
                        status-confirmed
                    @endif
                ">
                    @if ($type === 'cancelled')
                    ❌ Đã hủy
                    @elseif ($type === 'updated')
                    🔄 Đã cập nhật
                    @else
                    ✓ Đã xác nhận
                    @endif
                </span>
            </div>

            @if ($type === 'cancelled')
            <div class="message">
                <strong>Thông báo:</strong> Lịch hẹn của bạn đã được hủy. Nếu bạn cần đặt lại lịch hẹn, vui lòng liên hệ với chúng tôi.
            </div>
            @elseif ($type === 'updated')
            <div class="message">
                <strong>Thông báo:</strong> Thông tin lịch hẹn của bạn đã được cập nhật. Vui lòng kiểm tra lại thông tin bên dưới.
            </div>
            @else
            <div class="message">
                <strong>Cảm ơn bạn!</strong> Chúng tôi đã nhận được yêu cầu đặt lịch của bạn. Dưới đây là thông tin chi tiết.
            </div>
            @endif

            <!-- Appointment Details Card -->
            <div class="appointment-card">
                <div class="appointment-item">
                    <div class="item-icon">🏥</div>
                    <div class="item-content">
                        <div class="item-label">Dịch vụ</div>
                        <div class="item-value">{{ $appointment->service->name }}</div>
                    </div>
                </div>

                <div class="appointment-item">
                    <div class="item-icon">👨‍⚕️</div>
                    <div class="item-content">
                        <div class="item-label">Bác sĩ điều trị</div>
                        <div class="item-value">{{ $appointment->dentist->user->name }}</div>
                    </div>
                </div>

                <div class="appointment-item">
                    <div class="item-icon">📅</div>
                    <div class="item-content">
                        <div class="item-label">Thời gian</div>
                        <div class="item-value">{{ $appointment->starts_at->format('H:i - d/m/Y') }}</div>
                    </div>
                </div>

                <div class="appointment-item">
                    <div class="item-icon">📋</div>
                    <div class="item-content">
                        <div class="item-label">Trạng thái</div>
                        <div class="item-value">{{ ucfirst($appointment->status) }}</div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <p style="font-size: 14px; color: #6c757d; text-align: center;">
                Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ nha khoa của chúng tôi.<br>
                Chúng tôi cam kết mang đến cho bạn trải nghiệm tốt nhất!
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-brand">🦷 Nha Khoa Một Nụ Cười</div>
            <p class="footer-text">Chăm sóc nụ cười của bạn</p>
            <p class="footer-text" style="margin-top: 15px; font-size: 12px;">
                Email này được gửi tự động, vui lòng không trả lời.<br>
                Nếu có thắc mắc, vui lòng liên hệ: <strong>support@nhakhoademo.com</strong>
            </p>
        </div>
    </div>
</body>

</html>