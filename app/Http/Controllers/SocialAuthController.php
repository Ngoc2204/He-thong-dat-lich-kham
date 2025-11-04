<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Exception;

class SocialAuthController extends Controller
{
    // 1️⃣ Redirect đến Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2️⃣ Nhận callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect('/login')->withErrors(['google' => 'Không thể kết nối đến Google.']);
        }

        // Tìm user theo email
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Nếu chưa có, tạo mới user
            $user = User::create([
                'name'     => $googleUser->getName() ?? 'Người dùng Google',
                'email'    => $googleUser->getEmail(),
                'password' => Hash::make(uniqid('google_', true)), // tránh lỗi null
                'phone'    => null,
            ]);

            // Gán role mặc định
            $user->assignRole('patient');
        }

        // Đăng nhập
        Auth::login($user, true);

        // Điều hướng theo role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('dentist')) {
            return redirect()->route('dentist.dashboard');
        }

        return redirect()->route('appointments.home');
    }



    // 1️⃣ Redirect người dùng đến Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // 2️⃣ Nhận callback từ Facebook
    public function handleFacebookCallback()
    {
        try {
            // Lấy thông tin user từ Facebook
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('/login')->withErrors([
                'facebook' => 'Không thể đăng nhập bằng Facebook: ' . $e->getMessage(),
            ]);
        }

        // Tìm user theo email hoặc facebook_id
        $user = User::where('email', $facebookUser->getEmail())
            ->orWhere('facebook_id', $facebookUser->getId())
            ->first();

        if (!$user) {
            // Nếu chưa có -> tạo mới user
            $user = User::create([
                'name'        => $facebookUser->getName() ?? 'Người dùng Facebook',
                'email'       => $facebookUser->getEmail(),
                'facebook_id' => $facebookUser->getId(),
                'password'    => Hash::make(uniqid('facebook_', true)),
            ]);

            // Gán role mặc định
            $user->assignRole('patient');
        }

        // Đăng nhập user
        Auth::login($user, true);

        // Điều hướng theo vai trò
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('dentist')) {
            return redirect()->route('dentist.dashboard');
        }

        return redirect()->route('appointments.home');
    }
}
