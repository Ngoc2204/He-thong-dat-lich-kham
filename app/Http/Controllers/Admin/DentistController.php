<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dentist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DentistController extends Controller
{
    public function index()
    {
        $dentists = Dentist::with('user')->paginate(10);
        return view('admin.dentists.index', compact('dentists'));
    }

    public function create()
    {
        return view('admin.dentists.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'specialty' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:30',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
        ]);
        $user->assignRole('dentist');

        Dentist::create([
            'user_id' => $user->id,
            'specialty' => $data['specialty'] ?? 'Dentist',
        ]);

        return redirect()->route('dentists.index')->with('success','Dentist created');
    }

    public function edit(Dentist $dentist)
    {
        return view('admin.dentists.edit', compact('dentist'));
    }

    public function update(Request $request, Dentist $dentist)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$dentist->user_id,
            'password' => 'nullable|min:6',
            'specialty' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:30',
        ]);

        $dentist->user->name = $data['name'];
        $dentist->user->email = $data['email'];
        if (!empty($data['password'])) {
            $dentist->user->password = Hash::make($data['password']);
        }
        $dentist->user->phone = $data['phone'] ?? null;
        $dentist->user->save();

        $dentist->specialty = $data['specialty'] ?? $dentist->specialty;
        $dentist->save();

        return redirect()->route('dentists.index')->with('success','Dentist updated');
    }

    public function destroy(Dentist $dentist)
    {
        $dentist->user->delete();
        $dentist->delete();
        return redirect()->route('dentists.index')->with('success','Dentist deleted');
    }
}
