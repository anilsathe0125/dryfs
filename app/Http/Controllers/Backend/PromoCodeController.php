<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoCodeRequest;
use App\Models\Currency;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication.
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
        return view('backend.code.index', [
            'datas' => PromoCode::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
    */
    public function store(PromoCodeRequest $request)
    {
        $curr = Currency::where('is_default', 1)->first();
        $input = $request->all();
        if ($input['type'] == 'amount') {
            $input['discount'] = $input['discount'] / $curr->value;
        }
        PromoCode::create($input);
        return redirect()->route('backend.code.index')->withSuccess(__('New Promo Code Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(PromoCode $code)
    {
        $curr = Currency::where('is_default', 1)->first();
        return view('backend.code.edit', compact('code', 'curr'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param int $id
     * @param int $status
     * @return \Illuminate\Http\Response
    */
    public function status($id, $status)
    {
        PromoCode::find($id)->update([ 'status' => $status ]);
        return redirect()->route('backend.code.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(PromoCodeRequest $request, PromoCode $code)
    {
        $curr = Currency::where('is_default', 1)->first();
        $input = $request->all();
        if ($input['type'] == 'amount') {
            $input['discount'] = $input['discount'] / $curr->value;
        }
        $code->update($input);
        return redirect()->route('backend.code.index')->withSuccess(__('Promo Code Updated Successfully.'));
    }

    /**
     * Remove the specified resrouce from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $code = PromoCode::findOrFail($id);
        $code->delete();
        return redirect()->route('backend.code.index')->withSuccess(__('Promo Code Deleted Successfully.'));
    }
}
