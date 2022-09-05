<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Country;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Frontend\UserRepository;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Frontend\UserRepository
     * @return void
    */
    public function __construct(UserRepository $repository) {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    /**
     * Show user dashboard.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = Auth::user();
        return view('user.dashboard.dashboard', [
            'all_orders' => Order::whereUserId($user->id)->count(),
            'pending_orders' => Order::whereUserId($user->id)->whereOrderStatus('pending')->count(),
            'progress_orders' => Order::whereUserId($user->id)->whereOrderStatus('In Progress')->count(),
            'delivered_orders' => Order::whereUserId($user->id)->whereOrderStatus('Delivered')->count(),
            'canceled_orders' => Order::whereUserId($user->id)->whereOrderStatus('Canceled')->count(),
        ]);
    }

    /**
     * Show user profile.
     *
     * @return \Illuminate\Http\Response
    */
    public function profile()
    {
        $user = Auth::user();
        $check_newsletter = Subscriber::where('email', $user->email)->exists();
        return view('user.dashboard.index', [
            'user' => $user,
            'check_newsletter' => $check_newsletter
        ]);
    }

    /**
     * Update user profile.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
    */
    public function profileUpdate(UserRequest $request)
    {
        $this->repository->profileUpdate($request);
        return redirect()->back()->withSuccess(__('Profile Updated Successfully.'));
    }

    /**
     * Show user address.
     *
     * @return \Illuminate\Http\Response
    */
    public function addresses()
    {
        $user = Auth::user();
        $countries = Country::get();
        return view('user.dashboard.address', compact('user', 'countries'));
    }

    /**
     * Update user billing address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function billingSubmit(Request $request)
    {
        $request->validate([
            'bill_address1' => 'required|max:255',
            'bill_address2' => 'nullable|max:255',
            'bill_zip'      => 'nullable|max:255',
            'bill_city'     => 'required|max:255',
            'bill_company'  => 'nullable|max:255',
            'bill_country'  => 'required|max:255',
        ]);
        $user = Auth::user();
        $input = $request->all();
        $user->update($input);
        return redirect()->back()->withSuccess(__('Address Updated Successfully.'));
    }

    /**
     * Update user shipping address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function shippingSubmit(Request $request)
    {
        $request->validate([
            'ship_address1' => 'required|max:255',
            'ship_address2' => 'nullable|max:255',
            'ship_zip'      => 'nullable|max:255',
            'ship_city'     => 'required|max:255',
            'ship_company'  => 'nullable|max:255',
            'ship_country'  => 'required|max:255',
        ]);
        $user = Auth::user();
        $input = $request->all();
        $user->update($input);
        return redirect()->back()->withSuccess(__('Address Updated Successfully.'));
    }
}
