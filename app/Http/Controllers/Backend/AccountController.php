<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\PriceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUpdateRequest;
use App\Models\Order;
use App\Repositories\Backend\AccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\AccountRepository $repository
     * @return void
     *
    */
    public function __construct(AccountRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $days = "";
        $sales = "";

        for ($i = 0; $i < 30; $i++) {
            $days .= "'" . date("d M", strtotime('-' . $i . ' days')) . "',";
            $sales .= "'". Order::where('order_status', '=', 'Delivered')->whereDate('created_at', '=', date("Y-m-d", strtotime('-' . $i . ' days')))->count() ."',";
        }

        $earning_days = "";
        $total_incomes = "";
        $income = "";
        $check = 0;

        for ($i = 0; $i < 30; $i++) {
            $earning_days .= "'" . date("d M", strtotime('-' . $i . ' days')) . "',";
            $incomes = Order::where('order_status', '=', 'Delivered')->whereDate('created_at', '=', date("Y-m-d", strtotime('-' . $i . ' days')))->get();

            if ($incomes->count() > 0) {
                foreach ($incomes as $income) {
                    $check += PriceHelper::orderTotalChart($income);
                }
                $total_incomes .= "'" . $check . "',";
            }else{
                $total_incomes .= "'". '0' . "',";
            }
        }

        $earning_days = rtrim($earning_days, ", ");
        $check_income = rtrim($total_incomes, ", ");

        return view('backend.dashboard.index', [
            'totalUsers' => $this->repository->getTotalUsers(),//
            'totalItems' => $this->repository->getTotalItems(),//
            'totalOrders' => $this->repository->getTotalOrders(),
            'totalPendingOrders' => $this->repository->getPendingOrders(),
            'totalDeliveredOrders' => $this->repository->getDeliveredOrders(),
            'totalCanceledOrders' => $this->repository->getCanceledOrders(),
            'recentOrders' => $this->repository->getRecentOrders(),
            'totalProductSale' => $this->repository->getTotalProductSale(),
            'totalEarning' => $this->repository->getTotalEarning(),
            'order_days' => $days,
            'earning_days' => $earning_days,
            'order_sales' => $sales,
            'total_incomes' => $check_income,
        ]);
    }

    /**
     * Display listing of the resource
     *
     * @return \Illuminate\Http\Response
    */
    public function profileForm()
    {
        $data = Auth::guard('admin')->user();
        return view('backend.dashboard.profile', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function updateProfile(ImageUpdateRequest $request)
    {
        $this->repository->updateProfile($request);
        return redirect()->back()->withSuccess(__('Profile Updated Successfully!'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function passwordResetForm()
    {
        return view('backend.dashboard.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6|max:16',
            'new_password' => 'required|min:6|max:16',
            'renew_password' => 'required|min:6|max:16',
        ]);

        $resp = $this->repository->updatePassword($request);

        if ($resp['status']) {
            return redirect()->back()->withSuccess(__($resp['message']));
        } else {
            return redirect()->back()->withErrors(__($resp['message']));
        }

    }
}
