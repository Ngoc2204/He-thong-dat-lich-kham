<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dentist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'dentist_email' => 'nullable|email|max:255',
            'dentist_phone' => 'nullable|string|max:30',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'degree' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'experience_years' => 'nullable|integer|min:0|max:50',
        ]);

        // Tạo user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
        ]);

        $user->assignRole('dentist');

        // Xử lý avatar
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('dentists/avatars', 'public');
        }

        // Tạo dentist với đầy đủ thông tin
        Dentist::create([
            'user_id' => $user->id,
            'specialty' => $data['specialty'],
            'avatar' => $avatarPath,
            'degree' => $data['degree'] ?? null,
            'bio' => $data['bio'] ?? null,
            'experience_years' => $data['experience_years'] ?? null,
            'email' => $data['dentist_email'] ?? null,
            'phone' => $data['dentist_phone'] ?? null,
        ]);

        return redirect()->route('dentists.index')
            ->with('success', 'Bác sĩ đã được thêm thành công!');
    }

    public function edit(Dentist $dentist)
    {
        return view('admin.dentists.edit', compact('dentist'));
    }

    public function update(Request $request, Dentist $dentist)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dentist->user_id,
            'password' => 'nullable|min:6',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'dentist_email' => 'nullable|email|max:255',
            'dentist_phone' => 'nullable|string|max:30',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'degree' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'remove_avatar' => 'nullable|boolean',
        ]);

        // Cập nhật user
        $dentist->user->name = $data['name'];
        $dentist->user->email = $data['email'];
        if (!empty($data['password'])) {
            $dentist->user->password = Hash::make($data['password']);
        }
        $dentist->user->phone = $data['phone'] ?? null;
        $dentist->user->save();

        // Xử lý avatar
        if ($request->boolean('remove_avatar')) {
            // Xóa avatar cũ
            if ($dentist->avatar) {
                Storage::disk('public')->delete($dentist->avatar);
                $dentist->avatar = null;
            }
        } elseif ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($dentist->avatar) {
                Storage::disk('public')->delete($dentist->avatar);
            }
            // Upload avatar mới
            $dentist->avatar = $request->file('avatar')->store('dentists/avatars', 'public');
        }

        // Cập nhật thông tin dentist
        $dentist->specialty = $data['specialty'];
        $dentist->degree = $data['degree'] ?? null;
        $dentist->bio = $data['bio'] ?? null;
        $dentist->experience_years = $data['experience_years'] ?? null;
        $dentist->email = $data['dentist_email'] ?? null;
        $dentist->phone = $data['dentist_phone'] ?? null;
        $dentist->save();

        return redirect()->route('dentists.index')
            ->with('success', 'Thông tin bác sĩ đã được cập nhật!');
    }

    public function destroy(Dentist $dentist)
    {
        // Xóa avatar nếu có
        if ($dentist->avatar) {
            Storage::disk('public')->delete($dentist->avatar);
        }

        // Xóa dentist và user
        $dentist->user->delete();
        $dentist->delete();

        return redirect()->route('dentists.index')
            ->with('success', 'Bác sĩ đã được xóa!');
    }
}