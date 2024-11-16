<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (auth()->check() && $user->code) {
            if (!$request->is('verify*')) { // Nếu không phải đang ở trang nhập mã OTP
                return redirect()->route('verify.index'); // Chuyển hướng đến trang nhập mã OTP
            }
        }

        return $next($request);
    }
}
