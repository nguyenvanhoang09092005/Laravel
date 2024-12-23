<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        LoginHistory::create([
            'user_id' => Auth::id(),
            'login_at' => now(),
        ]);

        $authUserRole = Auth::user()->role;

        if ($authUserRole == 1) {
            return redirect()->intended(route('admin', absolute: false));
        } elseif ($authUserRole == 2) {
            return redirect()->intended(route('dashboard', absolute: false));
        } elseif ($authUserRole == 3) {
            return redirect()->intended(route('personnel', absolute: false));
        }


        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
