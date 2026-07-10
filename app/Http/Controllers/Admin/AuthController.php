<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('Admin/Login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Allow logging in with either an e-mail address or a username (the user's name).
        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $attempt = [
            $field => $credentials['login'],
            'password' => $credentials['password'],
        ];

        if (! Auth::attempt($attempt, $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => 'Неточно корисничко име/е-пошта или лозинка.',
            ])->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
