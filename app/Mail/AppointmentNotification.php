<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class AppointmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $type;

    public function __construct(Appointment $appointment, $type = 'created')
    {
        $this->appointment = $appointment;
        $this->type = $type;
    }

    public function build()
    {
        $subject = match ($this->type) {
            'cancelled' => 'Lịch hẹn của bạn đã bị hủy',
            'updated' => 'Lịch hẹn của bạn đã được cập nhật',
            default => 'Xác nhận đặt lịch nha khoa'
        };

        return $this->subject($subject)
            ->view('emails.appointment')
            ->with([
                'appointment' => $this->appointment,
                'type' => $this->type,
            ]);
    }
}
