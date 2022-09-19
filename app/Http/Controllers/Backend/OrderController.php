<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SmsHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PromoCode;
use App\Models\TrackOrder;

class OrderController extends Controller
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
     * Display a listing of resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if ($request->type) {
            if ($request->start_date && $request->end_date) {
                $datas = $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
                $datas = Order::latest('id')->whereOrderStatus($request->type)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
            } else {
                $datas = Order::latest('id')->whereOrderStatus($request->type)->get();
            }
        } else {
            if ($request->start_date && $request->end_date) {
                $datas = $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
                $datas = Order::latest('id')->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
            } else {
                $datas = Order::latest('id')->get();
            }
        }
        return view('backend.order.index', compact('datas'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('backend.order.invoice', compact('order', 'cart'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function printOrder($id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('backend.order.print', compact('order', 'cart'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param int $id
     * @param string $field
     * @param string $value
     * @return \Illuminate\Http\Response
    */
    public function status($id, $field, $value)
    {
        $order = Order::findOrFail($id);

        if ($field == 'payment_status') {
            if ($order['payment_status'] == 'Paid') {
                return redirect()->route('backend.order.index')->withError(__('Order is already Paid.'));
            }
        }

        if ($field == 'order_status') {
            if ($order['order_status'] == 'Delivered') {
                return redirect()->route('backend.order.index')->withError(__('Order is already Delivered.'));
            }
        }

        $order->update([ $field => $value ]);
        if ($order->payment_status == 'Paid') {
            $this->setPromoCode($order);
        }
        $this->setTrackOrder($order);
        $sms = new SmsHelper();
        $user_number = $order->user->phone;
        if ($user_number) {
            $sms->sendSms($user_number, "'order_status'");
        }

        return redirect()->route('backend.order.index')->withSuccess(__('Status Updated Successfully'));
    }

    /**
     * Set order status in track order
     *
     * @param \App\Models\Order $order
     * @return void
    */
    public function setTrackOrder($order)
    {
        if ($order->order_status == 'In Progress') {
            if (!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()) {
                TrackOrder::create([
                    'title'    => 'In Progress',
                    'order_id' => $order->id
                ]);
            }
        }

        if ($order->order_status == 'Canceled') {
            if (!TrackOrder::whereOrderId($order->id)->whereTitle('Canceled')->exists()) {

                if (!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()) {
                    TrackOrder::create([
                        'title'    => 'In Progress',
                        'order_id' => $order->id
                    ]);
                }

                if (!TrackOrder::whereOrderId($order->id)->whereTitle('Delivered')->exists()) {
                    TrackOrder::create([
                        'title'    => 'Delivered',
                        'order_id' => $order->id
                    ]);
                }

                if (!TrackOrder::whereOrderId($order->id)->whereTitle('Canceled')->exists()) {
                    TrackOrder::create([
                        'title'    => 'Canceled',
                        'order_id' => $order->id
                    ]);
                }
            }
        }

        if ($order->order_status == 'Delivered') {

            if (!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()) {
                TrackOrder::create([
                    'title'    => 'In Progress',
                    'order_id' => $order->id
                ]);
            }

            if (!TrackOrder::whereOrderId($order->id)->whereTitle('Delivered')->exists()) {
                TrackOrder::create([
                    'title'    => 'Delivered',
                    'order_id' => $order->id
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
    */
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->transaction->delete();

        if (Notification::where('order_id', $id)->exists()) {
            Notification::where('order_id', $id)->delete();
        }

        if (count($order->tracks_data) > 0) {
            foreach ($order->tracks_data as $track) {
                $track->delete();
            }
        }

        $order->delete();
        return redirect()->route('backend.order.index')->withSuccess(__('Order Deleted Successfully.'));
    }
}
