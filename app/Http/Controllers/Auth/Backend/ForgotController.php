<?php

namespace App\Http\Controllers\Auth\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Both\ForgotRepository;

class ForgotController extends Controller
{
    /**
     * Constructor Method.
     *
     * @param  \App\Repositories\Both\ForgotRepository $repository
     *
    */
    public function __construct(ForgotRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest:admin');
    }

    /**
     * Show the form for requesting forgot password.
     *
     * @return \Illuminate\Http\Response
    */
    public function showForm()
    {
        return view('backend.auth.forgot');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function forgot(Request $request)
    {
        if ($data = Admin::whereEmail($request->email)->first()) {
            $this->repository->forgot($data, $request, 'backend');
            return redirect()->back()->withSuccess(__('We Have Sent a Link To Your Account!. Please Check Your Email.'));
        } else {
            return redirect()->back()->withErrors(__('No Account Found With This Email.'))->withInput($request->all());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
    */
    public function showChangePasswordForm($token)
    {
        if ($token) {
            if( Admin::whereEmailToken($token)->exists() ){
                return view('backend.auth.change-password', compact('token'));
            }else{
                abort(404);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|max:16|same:renew_password',
        ]);
        $data = Admin::whereEmailToken($request->file_token)->firstOrFail();
        $resp = $this->repository->updatePassword($data, $request, 'backend');
        if ($resp['status']) {
            return redirect($resp['redirect_url'])->withSuccess($resp['message']);
        } else {
            return redirect()->back()->withErrors($resp['message']);
        }

    }
}
