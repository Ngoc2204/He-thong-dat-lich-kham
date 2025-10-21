<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // Tổng quan
        $totalPatients     = User::role('patient')->count();
        $totalDentists     = User::role('dentist')->count();
        $totalAppointments = Appointment::count();
        $totalServices     = Service::count();

        // Lịch hẹn theo trạng thái
        $statusStats = Appointment::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusStats = array_merge([
            'pending'   => 0,
            'confirmed' => 0,
            'completed' => 0,
            'cancelled' => 0,
        ], $statusStats);

        // Thống kê 7 ngày gần nhất
        $dailyAppointments = Appointment::selectRaw('DATE(starts_at) as date, COUNT(*) as total')
            ->where('starts_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($item) => [
                'date'  => Carbon::parse($item->date)->format('d/m'),
                'total' => $item->total
            ]);

        // Tổng doanh thu (dựa trên dịch vụ hoàn tất)
        $totalRevenue = Appointment::where('status', 'completed')
            ->with('service:id,price')
            ->get()
            ->sum(fn($a) => $a->service->price ?? 0);

        // Top dịch vụ phổ biến
        $topServices = Appointment::select('service_id', DB::raw('COUNT(*) as count'))
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->with('service:id,name')
            ->take(5)
            ->get()
            ->map(fn($item) => (object)[
                'name'  => $item->service->name ?? 'Không rõ',
                'count' => $item->count
            ]);

        // 🦷 Top bác sĩ có nhiều lịch hẹn nhất
        $topDentists = Appointment::select('dentist_id', DB::raw('COUNT(*) as count'))
            ->groupBy('dentist_id')
            ->orderByDesc('count')
            ->with('dentist.user:id,name')
            ->take(5)
            ->get()
            ->map(fn($item) => (object)[
                'name'  => $item->dentist->user->name ?? 'Không rõ',
                'count' => $item->count
            ]);

        return view('admin.statistics', compact(
            'totalPatients',
            'totalDentists',
            'totalAppointments',
            'totalServices',
            'statusStats',
            'dailyAppointments',
            'totalRevenue',
            'topServices',
            'topDentists'
        ));


        
    }
}
