<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'uname' => ['required', 'string'],
            'psw' => ['required', 'string'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt([
            'username' => $credentials['uname'],
            'password' => $credentials['psw'],
        ], $remember)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'uname' => 'The provided credentials do not match our records.',
        ])->onlyInput('uname');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
