<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the form for updating resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function sms()
    {
        return view('backend.settings.sms');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function smsUpdate(Request $request)
    {
        $request->validate([
            'twilio_sid'          => 'required|max:200',
            'twilio_token'        => 'required|max:100',
            'twilio_form_number'  => 'required|max:100',
            'twilio_country_code' => 'required|max:100',
        ]);

        $input = $request->all();

        if (isset($request->is_twilio)) {
            $input['is_twilio'] = 1;
        } else {
            $input['is_twilio'] = 0;
        }
        Setting::first()->update($input);
        return redirect()->back()->withSuccess(__('Data Updated Successfully.'));
    }
}
