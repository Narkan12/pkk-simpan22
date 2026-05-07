<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('success')) {
            return view('auth.login');
        }

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            return redirect()->route($user->isAdmin() ? 'dashboard' : 'dashboard.pegawai');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $redirectUrl = $user->isAdmin() ? route('dashboard') : route('dashboard.pegawai');

            return redirect()->route('login')->with('success', $redirectUrl);
        }

        return back()->with('error', 'Email atau password salah.')->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}