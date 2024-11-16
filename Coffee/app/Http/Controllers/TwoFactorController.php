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
            'otp' => 'required|numeric', // OTP phải là số
        ]);

        $user = auth()->user();

        if ($request->otp == $user->code) {
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
