<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaxRequest;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
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
        return view('backend.tax.index', [
            'datas' => Tax::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.tax.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(TaxRequest $request)
    {
        Tax::create($request->all());
        return redirect()->route('backend.tax.index')->withSuccess(__('New Tax Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Tax $tax)
    {
        return view('backend.tax.edit', compact('tax'));
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
        Tax::find($id)->update([ 'status' => $status ]);
        return redirect()->route('backend.tax.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(TaxRequest $request, Tax $tax)
    {
        $tax->update($request->all());
        return redirect()->route('backend.tax.index')->withSuccess(__('Tax Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();
        return redirect()->route('backend.tax.index')->withSuccess(__('Tax Deleted Successfully.'));
    }
}
