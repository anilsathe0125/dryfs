<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BcategoryRequest;
use App\Models\Bcategory;
use App\Repositories\Backend\BcategoryRepository;
use Illuminate\Http\Request;

class BcategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\BcategoryRepository $repository
     * @return void
    */
    public function __construct(BcategoryRepository $repository)
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
        return view('backend.bcategory.index', [
            'datas' => Bcategory::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.bcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BcategoryRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.bcategory.index')->withSuccess(__('New Blog Category Added Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id, $status)
    {
        Bcategory::findOrFail($id)->update(['status' => $status]);
        return redirect()->route('backend.bcategory.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bcategory $bcategory)
    {
        return view('backend.bcategory.edit', compact('bcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BcategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BcategoryRequest $request, Bcategory $bcategory)
    {
        $this->repository->update($bcategory, $request);
        return redirect()->route('backend.bcategory.index')->withSuccess(__('Blog Category Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bcategory = Bcategory::findOrFail($id);
        $this->repository->delete($bcategory);
        return redirect()->route('backend.bcategory.index')->withSuccess(__('Blog Category Deleted Successfully.'));
    }
}
