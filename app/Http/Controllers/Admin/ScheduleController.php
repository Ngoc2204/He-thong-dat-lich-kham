<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Dentist;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('dentist.user')->orderBy('dentist_id')->orderBy('weekday')->get();
        $dentists = Dentist::with('user')->get();
        return view('admin.schedules.index', compact('schedules','dentists'));
    }

    public function create()
    {
        $dentists = Dentist::with('user')->get();
        return view('admin.schedules.create', compact('dentists'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'weekday' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_minutes' => 'required|integer|min:10|max:480',
        ]);
        Schedule::create($data);
        return redirect()->route('schedules.index')->with('success','Schedule created');
    }

    public function edit(Schedule $schedule)
    {
        $dentists = Dentist::with('user')->get();
        return view('admin.schedules.edit', compact('schedule','dentists'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'weekday' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_minutes' => 'required|integer|min:10|max:480',
        ]);
        $schedule->update($data);
        return redirect()->route('schedules.index')->with('success','Schedule updated');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success','Schedule deleted');
    }
}
