<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Models\Fcategory;
use FFI;
use Illuminate\Http\Request;

class FaqController extends Controller
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
        return view('backend.faq.index', [
            'datas'       => Faq::with('category')->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faq.create', [
            'fcategories' => Fcategory::whereStatus(1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        Faq::create($request->all());
        return redirect()->route('backend.faq.index')->withSuccess(__('New Faq Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $fcategories = Fcategory::whereStatus(1)->get();
        return view('backend.faq.edit', compact('faq', 'fcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FaqRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->update($request->all());
        return redirect()->route('backend.faq.index')->withSuccess(__('Faq Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('backend.faq.index')->withSuccess(__('Faq Deleted Successfully.'));
    }
}
