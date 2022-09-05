<?php

namespace App\Repositories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Service;

class ServiceRepository{

    /**
     * Store Service
     *
     * @param \Illuminate\Http\Request $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'), 'uploads/services');
        Service::create($input);
    }

    /**
     * Update Service
     *
     * @param \App\Models\Service $service
     * @param \Illuminate\Http\Request $request
     * @return void
    */
    public function update($service, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/services', $service, 'photo');
        }
        $service->update($input);
    }

    /**
     * Delete Service
     *
     * @param \App\Models\Service $service
     * @return void
    */
    public function delete($service)
    {
        ImageHelper::handleDeletedImage($service, 'photo');
        $service->delete();
    }
}
