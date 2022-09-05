<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.subscribers.index', [
            'datas' => Subscriber::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for sending mail to subscribers.
     *
     * @return \Illuminate\Http\Response
    */
    public function sendMail()
    {
        return view('backend.subscribers.mail');
    }

    /**
     * Sending mail to the subscribers
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function sendMailSubmit(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'details' => 'required'
        ]);

        $subject = $request->subject;
        $msg     = $request->details;
        foreach (Subscriber::oldest('id')->get() as $subscriber) {
            $emailData = [
                'to'      => $subscriber->email,
                'subject' => $subject,
                'body'    => $msg
            ];

            $email = new EmailHelper();
            $email->sendCustomMail($emailData);
        }
        return redirect()->route('backend.subscribers.index')->withSuccess(__('Email Sent Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
        Subscriber::findOrFail($id)->delete();
        return redirect()->route('backend.subscribers.index')->withSuccess(__('Email Delete Successfully.'));
    }
}
