<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // Hiển thị lịch làm việc của bác sĩ
    public function index()
    {
        $dentist = Auth::user()->dentist;
        $schedules = $dentist ? $dentist->schedules : collect();
        return view('dentist.schedules.index', compact('schedules'));
    }

    // Hiển thị form thêm lịch làm việc
    public function create()
    {
        return view('dentist.schedules.create');
    }

    // Lưu lịch làm việc mới
    public function store(Request $request)
    {
        $request->validate([
            'weekday' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'slot_minutes' => 'required|integer|min:10',
        ]);

        $dentist = Auth::user()->dentist;

        Schedule::create([
            'dentist_id' => $dentist->id,
            'weekday' => $request->weekday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_minutes' => $request->slot_minutes,
        ]);

        return redirect()->route('dentist.schedules.index')->with('success', 'Đã thêm lịch làm việc mới!');
    }
}