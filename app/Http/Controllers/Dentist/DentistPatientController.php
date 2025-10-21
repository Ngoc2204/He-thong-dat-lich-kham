<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DentistPatientController extends Controller
{
    public function index()
    {
        $dentist = Auth::user()->dentist;

        // Lấy danh sách bệnh nhân từng có lịch hẹn với bác sĩ này
        $patients = Appointment::with('patient')
            ->where('dentist_id', $dentist->id)
            ->get()
            ->pluck('patient')
            ->unique('id')
            ->values();

        return view('dentist.patients.index', compact('patients'));
    }

    
}
