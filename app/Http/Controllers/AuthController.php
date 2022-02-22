<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginIndex() {
        return view('auth.web.login');
    }

    public function loginAuth(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->with('failed', 'Email or password wrong');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function registerIndex() {
        return view('auth.web.register');
    }

    public function registerCreate(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'address' => 'required',
            'password' => [
                'required',
                Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
            ]
        ]);

        $credentials['password'] = Hash::make($credentials['password']);
        User::create($credentials);

        return redirect('/login')->with('success', 'User created successfully, please login first');
    }
}
