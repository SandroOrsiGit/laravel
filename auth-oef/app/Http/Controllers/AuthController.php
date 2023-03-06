<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout() {

    }

    public function login() {
        return view('auth.login');
    }

    public function handleLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    }

    public function register() {
        return view('auth.register');
    }

    public function handleRegister(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        return view('auth.register');
    }
}
