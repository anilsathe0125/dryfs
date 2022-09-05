<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentSettingRequest;
use App\Repositories\Backend\PaymentSettingRepository;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\PaymentSettingRepository $repository
     * @return void
    */
    public function __construct(PaymentSettingRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }

    /**
     * Show the form for editing resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function payment()
    {
        return view('backend.settings.payment', $this->repository->payment());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function update(PaymentSettingRequest $request)
    {
        $this->repository->update($request);
        return redirect()->back()->withSuccess(__('Payment Information Updated Successfully.'));
    }


}
