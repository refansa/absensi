<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login Page',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'  => ['required', 'string', 'max:255'],
            'password'  => ['required', 'string', 'max:255'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with([
                'alert-content' => 'Login berhasil!',
                'alert-type'    => 'success',
            ]);
        } else {
            return redirect()->back()->with([
                'alert-content' => 'Login gagal!',
                'alert-type'    => 'error',
            ]);
        }
    }
}
