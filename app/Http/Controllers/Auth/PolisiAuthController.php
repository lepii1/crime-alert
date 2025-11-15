<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Polisi;
use Illuminate\Support\Facades\Hash;

class PolisiAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('polisi.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('polisi')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('polisi.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('polisi')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('polisi.login');
    }

    public function showRegisterForm()
    {
        return view('polisi.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:polisis,email',
            'no_hp' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar/polisi', 'public');
        }

        $polisi = Polisi::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'jabatan' => $validated['jabatan'] ?? null,
            'avatar' => $avatarPath,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('polisi')->login($polisi);

        return redirect()->route('polisi.dashboard')->with('success', 'Registrasi berhasil!');
    }
}
