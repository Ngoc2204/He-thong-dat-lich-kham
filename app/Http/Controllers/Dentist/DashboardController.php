<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dentist = $user->dentistProfile;
        $appointments = Appointment::with(['patient','service'])
            ->where('dentist_id', $dentist->id)
            ->whereDate('starts_at', '>=', now()->toDateString())
            ->orderBy('starts_at')
            ->get();

        return view('dentist.dashboard', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);
        $appointment->status = $request->status;
        $appointment->save();

        return back()->with('success','Status updated');
    }
}
