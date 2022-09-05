<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Repositories\Backend\SliderRepository;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\SliderRepository $repository
     * @return void
    */
    public function __construct(SliderRepository $repository)
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
        return view('backend.slider.index', [
            'datas' => Slider::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $required = 'required|';
        if ($request->home_page == 'theme4') {
            $required = '';
        }

        $request->validate([
            'logo'    => 'image|mimes:jpeg,png,jpg,svg|nullable',
            'photo'   => 'image|required|mimes:jpeg,png,jpg,svg',
            'title'   => $required . 'max:100',
            'link'    => $required . 'max:255',
            'details' => $required . 'max:255',
        ]);
        $this->repository->store($request);
        return redirect()->route('backend.slider.index')->withSuccess(__('New Slider Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Slider $slider)
    {
        $required = 'required|';
        if ($request->home_page == 'theme4') {
            $required = '';
        }
        $request->validate([
            'logo'    => 'image|mimes:jpeg,png,jpg,svg|nullable',
            'photo'   => 'image|mimes:jpeg,png,jpg,svg',
            'title'   => $required . 'max:100',
            'link'    => $required . 'max:255',
            'details' => $required . 'max:255',
        ]);
        $this->repository->update($slider, $request);
        return redirect()->route('backend.slider.index')->withSuccess(__('Slider Updated Successfully.'));
    }

    /**
     * Remove the specified resource from strage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $this->repository->delete($slider);
        return redirect()->route('backend.slider.index')->withSuccess(__('Slider Deleted Successfully.'));
    }
}
