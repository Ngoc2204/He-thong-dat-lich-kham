<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Danh sách bệnh nhân
     */
        public function index(Request $request)
    {
        $query = User::whereHas('roles', fn($q) => $q->where('name', 'patient'));

        // 🔍 Tìm kiếm theo tên, email, hoặc số điện thoại
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // ⚧ Lọc theo giới tính
        if ($gender = $request->input('gender')) {
            $query->where('gender', $gender);
        }

        // 🔘 Lọc theo trạng thái
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // 🔄 Sắp xếp
        if ($sort = $request->input('sort')) {
            switch ($sort) {
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case '-name':
                    $query->orderBy('name', 'desc');
                    break;
                case 'created_at':
                    $query->orderBy('created_at', 'asc');
                    break;
                case '-created_at':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $patients = $query->paginate(10)->appends($request->all());

        return view('admin.patients.index', compact('patients'));
    }


    /**
     * Form thêm bệnh nhân
     */
    public function create()
    {
        // Danh sách chuyên ngành điều trị có sẵn (có thể mở rộng sau)
        $specializations = [
            'Nha chu',
            'Phục hình răng',
            'Chỉnh nha',
            'Cấy ghép Implant',
            'Tẩy trắng răng',
            'Nha tổng quát',
            'Răng trẻ em',
            'Phẫu thuật răng hàm mặt',
        ];

        return view('admin.patients.create', compact('specializations'));
    }


    /**
     * Lưu bệnh nhân mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('patient');

        return redirect()->route('admin.patients.index')->with('success', 'Thêm bệnh nhân thành công!');
    }

    /**
     * Form sửa
     */
    public function edit($id)
    {
        $patient = User::findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    /**
     * Cập nhật bệnh nhân
     */
    public function update(Request $request, $id)
    {
        $patient = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $patient->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $patient->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password
                ? Hash::make($request->password)
                : $patient->password,
        ]);

        return redirect()->route('admin.patients.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Xóa bệnh nhân
     */
    public function destroy($id)
    {
        $patient = User::findOrFail($id);
        $patient->delete();

        return redirect()->route('admin.patients.index')->with('success', 'Đã xóa bệnh nhân.');
    }
}
