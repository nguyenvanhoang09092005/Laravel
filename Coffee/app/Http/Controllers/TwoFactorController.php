<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.verify'); // Giao diện nhập mã OTP
    }

    public function store(Request $request)
    {
        $request->validate([
            'otp' => 'required|array', // OTP gửi dưới dạng mảng
            'otp.*' => 'numeric', // Mỗi ký tự OTP phải là số
        ]);

        $otp = implode('', $request->input('otp')); // Gộp mảng OTP thành chuỗi
        $user = auth()->user();

        if ($otp == $user->code) {
            // OTP chính xác => Xóa mã OTP
            $user->update(['code' => null]);

            // Điều hướng theo vai trò
            if ($user->role === 1) {
                return redirect()->route('admin');
            }

            return redirect()->route('dashboard');
        }

        // Nếu OTP không chính xác
        return back()->withErrors(['otp' => 'Mã OTP không chính xác']);
    }
}
