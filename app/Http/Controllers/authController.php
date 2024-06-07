<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function login()
    {
        return view('login/login');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate(
        [
            'username' => ['required'],
            'password' => ['required'],
        ],[
            'username.required' => 'username salah',
            'password.required' => 'password salah'
        ]
    
        );

        // $request->session()->regenerate();
        
        //cek apakah login valid
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        if (Auth::guard('renmi')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/renmi-dashboard');
        }

        if (Auth::guard('spn')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/spn-dashboard');
        }

        if (Auth::guard('staf')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/staf-dashboard');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login Invalid');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
