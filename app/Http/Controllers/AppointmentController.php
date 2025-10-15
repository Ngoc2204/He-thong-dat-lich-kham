<?php

namespace App\Http\Controllers;

use App\Models\{Appointment, Dentist, Service, Schedule};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $dentists = Dentist::with('user')->get();
        $services = Service::all();

        $slots = [];
        $selected = [
            'dentist_id' => $request->query('dentist_id'),
            'service_id' => $request->query('service_id'),
            'date'       => $request->query('date'),
        ];

        if ($selected['dentist_id'] && $selected['service_id'] && $selected['date']) {
            $slots = $this->generateSlots(
                (int) $selected['dentist_id'],
                (int) $selected['service_id'],
                $selected['date']
            );
        }

        return view('appointments.create', compact('dentists','services','slots','selected'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dentist_id' => ['required','exists:dentists,id'],
            'service_id' => ['required','exists:services,id'],
            'date'       => ['required','date','after_or_equal:today'],
            'time'       => ['required','date_format:H:i'],
            'notes'      => ['nullable','string','max:1000'],
        ]);

        $service = Service::findOrFail($data['service_id']);
        $start = Carbon::parse($data['date'].' '.$data['time']);
        $end   = (clone $start)->addMinutes($service->duration_mins ?? 30);

        // must be inside schedule window
        if (!$this->isWithinSchedule($data['dentist_id'], $start, $end)) {
            return back()->withErrors(['time' => 'Selected time is out of dentist schedule.'])->withInput();
        }

        // must not overlap any existing appointment
        $overlap = Appointment::where('dentist_id', $data['dentist_id'])
            ->where('starts_at', '<', $end)
            ->where('ends_at', '>', $start)
            ->exists();

        if ($overlap) {
            return back()->withErrors(['time' => 'Time slot already booked.'])->withInput();
        }

        Appointment::create([
            'patient_id' => Auth::id(),
            'dentist_id' => $data['dentist_id'],
            'service_id' => $data['service_id'],
            'starts_at'  => $start,
            'ends_at'    => $end,
            'status'     => 'pending',
            'notes'      => $data['notes'] ?? null,
        ]);

        return redirect()->route('appointments.mine')->with('success','Appointment booked!');
    }

    public function myAppointments()
    {
        $apps = Appointment::with(['dentist.user','service'])
            ->where('patient_id', Auth::id())
            ->orderBy('starts_at','desc')
            ->paginate(10);

        return view('appointments.mine', compact('apps'));
    }

    public function cancel(Appointment $appointment)
    {
        abort_unless($appointment->patient_id === Auth::id(), 403);
        if (in_array($appointment->status, ['completed','cancelled'])) {
            return back()->withErrors(['status' => 'Appointment can no longer be cancelled.']);
        }
        $appointment->status = 'cancelled';
        $appointment->save();

        return back()->with('success','Appointment cancelled.');
    }

    private function isWithinSchedule(int $dentistId, Carbon $start, Carbon $end): bool
    {
        $weekday = (int) $start->dayOfWeek; // 0..6
        $schedule = Schedule::where('dentist_id',$dentistId)
            ->where('weekday',$weekday)->first();

        if (!$schedule) return false;

        $s = Carbon::parse($start->toDateString().' '.$schedule->start_time);
        $e = Carbon::parse($start->toDateString().' '.$schedule->end_time);
        return $start->greaterThanOrEqualTo($s) && $end->lessThanOrEqualTo($e);
    }

    private function generateSlots(int $dentistId, int $serviceId, string $date): array
    {
        $service = Service::findOrFail($serviceId);
        $weekday = (int) Carbon::parse($date)->dayOfWeek;
        $schedule = Schedule::where('dentist_id',$dentistId)->where('weekday',$weekday)->first();
        if (!$schedule) return [];

        $start = Carbon::parse("$date {$schedule->start_time}");
        $end   = Carbon::parse("$date {$schedule->end_time}");
        $slots = [];

        for ($t = $start->copy(); $t->lt($end); $t->addMinutes($schedule->slot_minutes)) {
            $slotEnd = $t->copy()->addMinutes($service->duration_mins ?? 30);
            if ($slotEnd->gt($end)) break;

            $overlap = Appointment::where('dentist_id', $dentistId)
                ->where('starts_at', '<', $slotEnd)
                ->where('ends_at', '>', $t)
                ->exists();
            if (!$overlap) {
                $slots[] = $t->format('H:i');
            }
        }
        return $slots;
    }
}
