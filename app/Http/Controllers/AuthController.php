<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function loginAction(LoginValidationRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
