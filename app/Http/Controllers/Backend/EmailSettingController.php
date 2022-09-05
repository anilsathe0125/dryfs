<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Setting;
use Illuminate\Http\Request;

class EmailSettingController extends Controller
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
    public function email()
    {
        return view('backend.settings.email', [
            'datas' => EmailTemplate::get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(EmailTemplate $template)
    {
        return view('backend.email_template.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function emailUpdate(Request $request)
    {
        $request->validate([
            'email_host'       => 'required|max:200',
            'email_port'       => 'required|max:10',
            'email_encryption' => 'required|max:10',
            'email_user'       => 'required|max:100',
            'email_pass'       => 'required|max:100',
            'email_from'       => 'required|max:100',
            'email_from_name'  => 'required|max:100',
            'contact_email'    => 'required|max:100',
        ]);

        $input = $request->all();
        if (isset($request->smtp_check)) {
            $input['smtp_check'] = 1;
        } else {
            $input['smtp_check'] = 0;
        }

        Setting::first()->update($input);
        return redirect()->back()->withSuccess(__('Data Updated Successfully.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, EmailTemplate $template)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required',
        ]);
        $template->update($request->all());
        return redirect()->route('backend.setting.email')->withSuccess(__('Email Template Updated Successfully.'));
    }
}
