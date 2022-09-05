<?php

namespace App\Repositories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Slider;

class SliderRepository{

    /**
     * Store slider.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'), 'uploads/sliders');
        $input['logo'] = ImageHelper::handleUploadedImage($request->file('logo'), 'uploads/sliders');
        Slider::create($input);
    }

    /**
     * Update slider.
     *
     * @param \App\Models\Slider $slider
     * @param \App\Http\Requests\ImageUpdateRequest $request
     * @return void
    */
    public function update($slider, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/sliders', $slider, 'photo');
        }
        if ($file = $request->file('logo')) {
            $input['logo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/sliders', $slider, 'logo');
        }
        $slider->update($input);
    }

    /**
     * Delete slider.
     *
     * @param \App\Models\Slider $slider
     * @return void
    */
    public function delete($slider)
    {
        ImageHelper::handleDeletedImage($slider, 'photo');
        ImageHelper::handleDeletedImage($slider, 'logo');
        $slider->delete();
    }
}
