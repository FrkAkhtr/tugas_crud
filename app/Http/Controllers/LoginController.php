<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check())
        {
            return redirect('home');
        }
        else{
            return view('login');
        }
    }

    public function loginaksi(Request $request)
    {
        $data = [
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ];

        if(Auth::Attempt($data))
        {
            return redirect('home');
        }
        else{
            session::flash('error', 'Email atau Password salah');
            return redirect('/');
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create($request->all());
        return redirect()->route('login')
            ->with('success', 'Account created successfully.');
    }

    public function register()
    {
        return view('register');
    }

    public function logoutaksi()
    {
        Auth::logout();
        return redirect('/');
    }
}