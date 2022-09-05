<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Backend\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\ServiceRepository $repository
     * @return void
    */
    public function __construct(ServiceRepository $repository)
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
        return view('backend.service.index', [
            'datas' => Service::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:100',
            'details' => 'required',
            'photo'   => 'required|image',
        ]);
        $this->repository->store($request);
        return redirect()->route('backend.service.index')->withSuccess(__('New Service Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Service $service)
    {
        return view('backend.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'   => 'required|max:100',
            'details' => 'required',
            'photo'   => 'required|image',
        ]);
        $this->repository->update($service, $request);
        return redirect()->route('backend.service.index')->withSuccess(__('Service Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $this->repository->delete($service);
        return redirect()->route('backend.service.index')->withSuccess(__('Service Deleted Successfully.'));
    }
}
