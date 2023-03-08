<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function handleLogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username'=> $request->username, 'password'=>$request->password])) {
            return redirect()->route('posts.index');
        }

        return back()->withErrors(['username'=>'We can\'t log you in with these credentials.']);
    }

    public function register() {
        return view('auth.register');
    }

    public function handleRegister(Request $request) {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'username' => 'required|unique:users'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->save();
        return redirect()->route('login.get');
    }

    public function logout() {
        Auth::logout();
        return back();
    }
}
