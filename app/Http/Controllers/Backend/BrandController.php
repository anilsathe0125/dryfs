<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Repositories\Backend\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\BrandRepository  $repository
     * @return void
    */
    public function __construct(BrandRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.brand.index', [
            'datas' => Brand::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(BrandRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.brand.index')->withSuccess(__('New Brand Added Successfully.'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param int $id
     * @param int $status
     * @param string $type
     * @return \Illuminate\Http\Response
    */
    public function status($id, $status, $type)
    {
        Brand::findOrFail($id)->update([ $type => $status ]);
        return redirect()->route('backend.brand.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Brand $brand)
    {
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(BrandRequest $request, Brand $brand)
    {
        $this->repository->update($brand, $request);
        return redirect()->route('backend.brand.index')->withSuccess(__('Brand Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $this->repository->delete($brand);
        return redirect()->route('backend.brand.index')->withSuccess(__('Brand Deleted Successfully.'));
    }
}
