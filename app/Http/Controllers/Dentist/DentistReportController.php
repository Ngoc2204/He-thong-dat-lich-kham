<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DentistReportController extends Controller
{
    public function index()
    {
        $dentist = Auth::user()->dentist;

        // Tổng số lịch hẹn
        $totalAppointments = Appointment::where('dentist_id', $dentist->id)->count();

        // Tổng bệnh nhân từng khám
        $totalPatients = Appointment::where('dentist_id', $dentist->id)
            ->distinct('patient_id')
            ->count('patient_id');

        // Số lịch hẹn hoàn thành / hủy / đang chờ
        $completed = Appointment::where('dentist_id', $dentist->id)->where('status', 'completed')->count();
        $cancelled = Appointment::where('dentist_id', $dentist->id)->where('status', 'cancelled')->count();
        $pending = Appointment::where('dentist_id', $dentist->id)->where('status', 'pending')->count();
        $confirmed = Appointment::where('dentist_id', $dentist->id)->where('status', 'confirmed')->count();

        // Tỷ lệ hoàn thành (%)
        $completionRate = $totalAppointments > 0 ? round(($completed / $totalAppointments) * 100, 1) : 0;

        // Dữ liệu biểu đồ số lịch hẹn theo tháng
        $monthlyData = Appointment::selectRaw('MONTH(starts_at) as month, COUNT(*) as total')
            ->where('dentist_id', $dentist->id)
            ->whereYear('starts_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('M'),
                    'total' => $item->total
                ];
            });

        // Dịch vụ phổ biến nhất
        $popularServices = Appointment::with('service')
            ->where('dentist_id', $dentist->id)
            ->selectRaw('service_id, COUNT(*) as total')
            ->groupBy('service_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('dentist.reports.index', compact(
            'totalAppointments',
            'totalPatients',
            'completed',
            'cancelled',
            'pending',
            'confirmed',
            'completionRate',
            'monthlyData',
            'popularServices'
        ));
    }
}
