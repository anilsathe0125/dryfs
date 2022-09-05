<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\Backend\UserRepository;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\UserRepository $repository
     * @return void
    */
    public function __construct(UserRepository $repository)
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
        return view('backend.user.index', [
            'datas' => User::latest('id')->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function update(UserRequest $request)
    {
        $request->validate([
            'password' => 'min:6|max:16|nullable'
        ]);
        $this->repository->profileUpdate($request);
        return redirect()->back()->withSuccess(__('Profile Updated Successfull.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.user.index')->withSuccess(__('Customer Deleted Successfully.'));
    }
}
