<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function show(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['required', 'regex:/^\+?[0-9\s\-]{8,15}$/', 'unique:users,phone'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'phone.regex' => 'Please enter a valid phone number.',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard');
    }
}