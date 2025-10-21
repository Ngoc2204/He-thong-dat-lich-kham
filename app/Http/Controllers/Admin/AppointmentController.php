<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Danh sách bác sĩ cho bộ lọc
        $dentists = \App\Models\Dentist::with('user:id,name')->get();

        // Query cơ bản
        $query = \App\Models\Appointment::with(['patient', 'dentist.user', 'service']);

        // Tìm kiếm (theo tên bệnh nhân hoặc bác sĩ)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', fn($sub) => $sub->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('dentist.user', fn($sub) => $sub->where('name', 'like', "%{$search}%"));
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('starts_at', $request->date);
        }

        // Lọc theo bác sĩ
        if ($request->filled('dentist_id')) {
            $query->where('dentist_id', $request->dentist_id);
        }

        // Phân trang và giữ query string
        $appointments = $query->orderByDesc('starts_at')->paginate(20)->withQueryString();

        return view('admin.appointments.index', compact('appointments', 'dentists'));
    }


    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,completed,cancelled']);
        $appointment->update(['status' => $request->status]);
        return back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Xoá lịch hẹn thành công.');
    }

        public function create()
    {
        $dentists = Dentist::with('user:id,name')->get();
        $services = Service::orderBy('name')->get();
        $patients = User::role('patient')->select('id', 'name', 'email', 'phone')->get();

        return view('admin.appointments.create', compact('dentists', 'services', 'patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'        => 'required|exists:users,id',
            'dentist_id'        => 'required|exists:dentists,id',
            'service_id'        => 'required|exists:services,id',
            'appointment_date'  => 'required|date|after_or_equal:today',
            'appointment_time'  => 'required',
            'notes'             => 'nullable|string|max:500',
        ]);

        $startsAt = Carbon::parse("{$validated['appointment_date']} {$validated['appointment_time']}");
        $service  = Service::find($validated['service_id']);
        $endsAt   = $startsAt->copy()->addMinutes($service->duration_mins ?? 30);

        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'dentist_id' => $validated['dentist_id'],
            'service_id' => $validated['service_id'],
            'starts_at'  => $startsAt,
            'ends_at'    => $endsAt,
            'notes'      => $validated['notes'] ?? null,
            'status'     => 'pending',
        ]);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Tạo lịch hẹn thành công!');
    }
}
