<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dentist = Auth::user()->dentist;
        
        // Lấy appointments hôm nay
        $appointments = Appointment::where('dentist_id', $dentist->id)
            ->whereDate('starts_at', today())
            ->with(['patient', 'service'])
            ->orderBy('starts_at')
            ->get();
        
        // Lấy pending appointments
        $pendingList = Appointment::where('dentist_id', $dentist->id)
            ->where('status', 'pending')
            ->with(['patient', 'service'])
            ->orderBy('starts_at')
            ->take(5)
            ->get();
        
        // Statistics
        $todayAppointments = $appointments->count();
        
        $pendingAppointments = Appointment::where('dentist_id', $dentist->id)
            ->where('status', 'pending')
            ->count();
            
        $confirmedAppointments = Appointment::where('dentist_id', $dentist->id)
            ->where('status', 'confirmed')
            ->whereBetween('starts_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
            
        $completedThisMonth = Appointment::where('dentist_id', $dentist->id)
            ->where('status', 'completed')
            ->whereMonth('starts_at', now()->month)
            ->whereYear('starts_at', now()->year)
            ->count();
        
        // Lấy số appointment hôm qua để so sánh
        $yesterdayAppointments = Appointment::where('dentist_id', $dentist->id)
            ->whereDate('starts_at', today()->subDay())
            ->count();
        
        $todayDiff = $todayAppointments - $yesterdayAppointments;
        
        // Tính tỷ lệ hoàn thành tháng này
        $totalThisMonth = Appointment::where('dentist_id', $dentist->id)
            ->whereMonth('starts_at', now()->month)
            ->whereYear('starts_at', now()->year)
            ->whereIn('status', ['completed', 'cancelled'])
            ->count();
            
        $completionRate = $totalThisMonth > 0 ? round(($completedThisMonth / $totalThisMonth) * 100) : 0;
        
        // Lấy số lịch hẹn theo ngày trong tuần
        $weekAppointments = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            $count = Appointment::where('dentist_id', $dentist->id)
                ->whereDate('starts_at', $date)
                ->count();
            $weekAppointments[$i] = $count;
        }
        
        return view('dentist.dashboard', compact(
            'appointments',
            'pendingList',
            'todayAppointments',
            'pendingAppointments',
            'confirmedAppointments',
            'completedThisMonth',
            'todayDiff',
            'completionRate',
            'weekAppointments'
        ));
    }
    
    public function updateStatus(Appointment $appointment)
    {
        // Verify dentist owns this appointment
        if ($appointment->dentist_id !== Auth::user()->dentist->id) {
            abort(403);
        }
        
        $appointment->update([
            'status' => request('status')
        ]);
        
        return redirect()->back()->with('success', 'Đã cập nhật trạng thái lịch hẹn!');
    }
}