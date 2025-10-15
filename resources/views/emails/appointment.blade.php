<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông báo lịch hẹn</title>
</head>
<body>
    <h2>
        @if ($type === 'cancelled')
            Lịch hẹn của bạn đã bị hủy
        @elseif ($type === 'updated')
            Lịch hẹn của bạn đã được cập nhật
        @else
            Xác nhận đặt lịch nha khoa
        @endif
    </h2>

    <p>Xin chào {{ $appointment->patient->name ?? 'Quý khách' }},</p>

    <p><b>Dịch vụ:</b> {{ $appointment->service->name }}</p>
    <p><b>Bác sĩ:</b> {{ $appointment->dentist->user->name }}</p>
    <p><b>Thời gian:</b> {{ $appointment->starts_at->format('H:i d/m/Y') }}</p>
    <p><b>Trạng thái:</b> {{ ucfirst($appointment->status) }}</p>

    <p>Cảm ơn bạn đã tin tưởng sử dụng dịch vụ nha khoa của chúng tôi.</p>

    <p>— <b>Nha Khoa Demo</b></p>
</body>
</html>
