<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->input('remember'))) {
            return back()->with('message', __('Incorrect Credentials'));
        }
        return redirect()->route('posts.index', auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
