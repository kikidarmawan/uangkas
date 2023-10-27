<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidationRequest;
use App\Http\Requests\RegisterValidationRequest;
use App\Repositories\Dompet\DompetRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(protected UserRepository $userRepository, protected DompetRepository $dompetRepository)
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

    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerAction(RegisterValidationRequest $request)
    {
        $credentials = $request->only(['name', 'email', 'password']);
        $credentials = array_merge($credentials, [
            'password' => bcrypt($credentials['password'])
        ]);

        if ($user = $this->userRepository->createUser($credentials)) {
            // create dompet
            $this->dompetRepository->createDompet([
                'user_id' => $user->id,
                'saldo' => 0
            ]);

            Auth::login($user);

            // redirect to dashboard
            return redirect()->route('dashboard.index')->with('success', 'Register berhasil');
        } else {
            return redirect()->back()->with('error', 'Register gagal');
        }
    }
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
