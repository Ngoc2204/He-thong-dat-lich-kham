<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DentistAppointmentController extends Controller
{
    public function index()
    {
        $dentist = Auth::user()->dentist; // user có role 'dentist'

        // Lấy lịch hẹn theo bác sĩ
        $appointments = Appointment::with(['patient', 'service'])
            ->where('dentist_id', $dentist->id)
            ->orderBy('starts_at', 'asc')
            ->get();

        // Thống kê
        $today = Carbon::today();
        $todayAppointments = $appointments->whereBetween('starts_at', [$today, $today->copy()->endOfDay()])->count();
        $pendingAppointments = $appointments->where('status', 'pending')->count();
        $confirmedAppointments = $appointments->where('status', 'confirmed')->count();
        $completedThisMonth = $appointments->whereBetween('starts_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->where('status', 'completed')
            ->count();

        // Tính % hoàn thành
        $completionRate = $appointments->count() > 0
            ? round($completedThisMonth / $appointments->count() * 100, 1)
            : 0;

        // Danh sách hôm nay
        $todayList = Appointment::with(['patient', 'service'])
            ->where('dentist_id', $dentist->id)
            ->whereDate('starts_at', now())
            ->orderBy('starts_at')
            ->get();

        // Danh sách chờ xác nhận
        $pendingList = $appointments->where('status', 'pending');

        // Lịch tuần này
        $weekAppointments = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            $count = Appointment::where('dentist_id', $dentist->id)
                ->whereDate('starts_at', $date)
                ->count();
            $weekAppointments[$i] = $count;
        }

        return view('dentist.appointments.index', compact(
            'appointments',
            'todayAppointments',
            'pendingAppointments',
            'confirmedAppointments',
            'completedThisMonth',
            'completionRate',
            'todayList',
            'pendingList',
            'weekAppointments'
        ));
    }

    public function updateStatus(Appointment $appointment)
    {
        $appointment->update(['status' => request('status')]);
        return back()->with('success', 'Cập nhật trạng thái lịch hẹn thành công!');
    }
}
