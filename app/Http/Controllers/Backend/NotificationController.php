<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
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
    public function notifications()
    {
        return view('backend.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewNotification()
    {
        return view('backend.notification.notification', [
            'data' => Notification::orderBy('id', 'desc')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteNotification($id)
    {
        Notification::findOrFail($id)->delete();
        return redirect()->back()->withSuccess(__('Notification Delete Successfully.'));
    }

    /**
     * Clear a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearNotifications()
    {
        Notification::truncate();
    }
}
