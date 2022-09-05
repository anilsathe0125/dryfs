<?php

namespace App\Http\Controllers\Auth\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showForm()
    {
        return view('backend.auth.login');
    }

    public function login(AuthRequest $request)
    {
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
            return redirect()->intended(route('backend.dashboard'));
        }

        // if unsuccessful, then redirect back to the login with form data
        return redirect()->back()->withErrors(__('Email Or Password Doesn\'t Match !'))->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
