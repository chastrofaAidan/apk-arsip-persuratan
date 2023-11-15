<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index()
    {
        return view('login/login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib di isi',
            'password.required' => 'Password Wajib di isi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'superadmin') {
                return redirect('dashboard');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('dashboard');
            } elseif (Auth::user()->role == 'user') {
                return redirect('dashboard');
            }
        } else {
            return redirect('')->withErrors('Username dan Passord tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
