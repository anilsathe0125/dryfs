<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show listing of resources.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $orders = Order::whereUserId(auth()->user()->id)->latest('id')->get();
        return view('user.order.index', compact('orders'));
    }

    /**
     * Show details of order.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function details($id)
    {
        $user = Auth::user();
        $order = Order::where(['id' => $id, 'user_id' => $user->id])->firstOrFail();
        $cart = json_decode($order->cart, true);
        return view('user.order.invoice', compact('user', 'order', 'cart'));
    }

    /**
     * Print Order.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function printOrder($id)
    {
        $user = Auth::user();
        $order = Order::where(['id' => $id, 'user_id' => $user->id])->firstOrFail();
        $cart = json_decode($order->cart, true);
        return view('user.order.print', compact('user', 'order', 'cart'));
    }
}
