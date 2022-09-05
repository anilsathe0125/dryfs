<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Both\ForgotRepository;

class ForgotController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Both\ForgotRepository $repository
     * @return void
    */
    public function __construct(ForgotRepository $repository) {
        $this->repository = $repository;
        $this->middleware('guest');
    }

    /**
     * Show the form for requesting forgot password.
     *
     * @return \Illuminate\Http\Response
    */
    public function showForm()
    {
        return view('user.auth.forgot');
    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        if ($data = User::whereEmail($request->email)->first()) {
            $this->repository->forgot($data, $request, 'user');
            return redirect()->back()->withSuccess(__('We have sent a password reset link to your email!. Please check your E-mail.'));
        } else {
            return redirect()->back()->withError(__('No account found linked with this E-mail.'));
        }

    }

    /**
     * Show the form editing the specified resource.
     *
     * @param string $token
     * @return \Illuminate\Http\Response
    */
    public function showChangePasswordForm($token)
    {
        if($token) {
            if (User::whereEmailToken($token)->exists()) {
                return view('user.auth.change-password', compact('token'));
            } else {
                abort(404);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|max:16|same:renew_password',
        ]);
        $data = User::whereEmailToken($request->file_token)->firstOrFail();
        $response = $this->repository->updatePassword($data, $request, 'user');
        if ($response['status']) {
            return redirect($response['redirect_url'])->withSuccess($response['message']);
        } else {
            return redirect()->back()->withError($response['message']);
        }

    }
}
