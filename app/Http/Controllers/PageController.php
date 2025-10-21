<?php

namespace App\Http\Controllers;

use App\Models\Dentist;

class PageController extends Controller
{
    public function about()
    {
        $dentists = Dentist::with('user')->get(); // lấy toàn bộ bác sĩ
        return view('appointments.about', compact('dentists'));
    }
}
