<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('name', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to the intended page or dashboard
            return redirect()->intended(route('dashboard'))->with('success', 'Login successful!');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->route('login.index')->withInput()->withErrors(['loginError' => 'Invalid credentials. Please try
                                                                            again.']);
    }


    public function logout(){

        Auth::logout();

        return redirect('/');
    }
}