<?php

namespace App\Repositories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Brand;

class BrandRepository {

    /**
     * Store brand.
     *
     * @param \App\Http\Requests\BrandRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'), 'uploads/brands');
        Brand::create($input);
    }

    /**
     * Update brand.
     *
     * @param \App\Http\Requests\BrandRequest $request
     * @param \App\Models\Brand $brand
     * @return void
    */
    public function update($brand, $request)
    {
        $input = $request->all();
        if( $file = $request->file('photo') ) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/brands', $brand, 'photo');
        }
        $brand->update($input);
    }

    /**
     * Delete brand
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($brand)
    {
        ImageHelper::handleDeletedImage($brand, 'photo');
        $brand->delete();
    }
}
