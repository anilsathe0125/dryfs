<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\Role;
use App\Repositories\Backend\StaffRepository;

class StaffController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\StaffRepository $repository
     * @return void
    */
    public function __construct(StaffRepository $repository)
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
        return view('backend.staff.index', [
            'datas' => Admin::where('id', '!=', 1)->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.staff.create', [
            'roles' => Role::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StaffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.staff.index')->withSuccess(__('New User Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $staff)
    {
        return view('backend.staff.edit', [
            'admin' => $staff,
            'roles' => Role::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StaffRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, Admin $staff)
    {
        $this->repository->update($staff, $request);
        return redirect()->route('backend.staff.index')->withSuccess(__('User Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Admin::findOrFail($id);
        $this->repository->delete($staff);
        return redirect()->route('backend.staff.index')->withSuccess(__('User Deleted Successfully.'));
    }
}
