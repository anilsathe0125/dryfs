<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Repositories\Backend\CurrencyRepository;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\CurrencyRepository $repository
     * @return void
    */
    public function __construct(CurrencyRepository $repository)
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
        return view('backend.currency.index', [
            'datas' => Currency::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(CurrencyRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.currency.index')->withSuccess(__('New Currency Added Successfully.'));
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
        Currency::find($id)->update([ 'is_default' => $status ]);
        Currency::where('id', '!=', $id)->update([ 'is_default' => 0 ]);
        return redirect()->route('backend.currency.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Show the form editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Currency $currency)
    {
        return view('backend.currency.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        $this->repository->update($currency, $request);
        return redirect()->route('backend.currency.index')->withSuccess(__('Currency Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $this->repository->delete($currency);
        return redirect()->route('backend.currency.index')->withSuccess(__('Currency Deleted Successfully.'));
    }
}
