<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FcategoryRequest;
use App\Models\Fcategory;
use App\Repositories\Backend\FcategoryRepository;
use Illuminate\Http\Request;

class FcategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\FcategoryRepository $repository
     * @return void
    */
    public function __construct(FcategoryRepository $repository)
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
        return view('backend.fcategory.index', [
            'datas' => Fcategory::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.fcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\http\Requests\FcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FcategoryRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.fcategory.index')->withSuccess(__('New Faq Category Added Successfully.'));
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
        Fcategory::findOrFail($id)->update(['status' => $status]);
        return redirect()->route('backend.fcategory.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fcategory $fcategory)
    {
        return view('backend.fcategory.edit', compact('fcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\http\Requests\FcategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FcategoryRequest $request, Fcategory $fcategory)
    {
        $this->repository->update($fcategory, $request);
        return redirect()->route('backend.fcategory.index')->withSuccess(__('Faq Category Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fcategory = Fcategory::findOrFail($id);
        $this->repository->delete($fcategory);
        return redirect()->route('backend.fcategory.index')->withSuccess(__('Faq Category Deleted Successfully.'));
    }
}
