<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     * @return void
    */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);

        $setting = Setting::first();
        if ( $setting->recaptcha == 1 ) {
            Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
            Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
        }
    }

    /**
     * Show form for loggin in user.
     *
     * @return \Illuminate\Http\Resources
    */
    public function showForm()
    {
        return view('user.auth.login');
    }

    /**
     * Login user by creating session.
     *
     * @param \App\Http\Requests\AuthRequest $request
     * @return \Illuminate\Http\Response
    */
    public function login(AuthRequest $request)
    {
        // Attempt to login the user in
        if (Auth::attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
            // If successfuull, then redirect to intended lcoation
            if (!Auth::user()->email_token) {
                return redirect()->back()->withError(__('Email is not verified.'));
            }
            if ($request->has('modal')) {
                return redirect()->back();
            } else {
                return redirect()->intended(route('user.dashboard'));
            }

        }

        // If unsuccessfull, then redirect back to the login with the form data
        return redirect()->back()->withError(__("Email Or Password Doesn't Match!"))->withInput($request->all());
    }

    /**
     * Logout user by destroying session.
     *
     * @return \Illuminate\Http\Response
    */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
