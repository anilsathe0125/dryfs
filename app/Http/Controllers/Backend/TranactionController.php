<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TranactionController extends Controller
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
     * Display a listing of resources.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.transaction.index', [
            'datas' => Transaction::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->back()->withSuccess(__('Transaction Updated Successfully.'));
    }
}
