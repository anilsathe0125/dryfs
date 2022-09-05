<?php

namespace App\Repositories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Admin;

class StaffRepository{

    /**
     * Store Admin.
     *
     * @param  \App\Http\Requests\StaffRequest  $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request['password']);
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'), 'uploads/profile');
        Admin::create($input);
    }

    /**
     * Store Admin.
     *
     * @param  \App\Http\Requests\StaffRequest $request
     * @param  \App\Models\Admin $staff
     * @return void
    */
    public function update($staff, $request)
    {
        $input = $request->all();
        if ($request->password) {
            $input['password'] = bcrypt($request['password']);
        } else {
            unset($input['password']);
        }
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/profile', $staff, 'photo');
        }
        $staff->update($input);
    }

    /**
     * Delete category.
     *
     * @param  \App\Models\Admin $staff
     * @return void
    */
    public function delete($staff)
    {
        ImageHelper::handleDeletedImage($staff, 'photo');
        $staff->delete();
    }
}
