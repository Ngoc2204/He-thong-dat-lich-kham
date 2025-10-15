<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Service;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'dentists' => Dentist::count(),
            'services' => Service::count(),
            'appointments' => Appointment::count(),
            'pending' => Appointment::where('status','pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
