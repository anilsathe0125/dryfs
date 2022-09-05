<?php

namespace App\Repositories\Backend;

use App\Models\Bcategory;

class BcategoryRepository{

    /**
     * Store Category
     * @param \App\Http\Requests\BcategoryRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        Bcategory::create($input);
    }

    /**
     * Update category.
     *
     * @param  \App\Models\Bcategory  $bcategory
     * @param  \App\Http\Requests\BcategoryRequest  $request
     * @return void
    */
    public function update($bcategory, $request)
    {
        $input = $request->all();
        $bcategory->update($input);
    }

    /**
     * Delete category.
     *
     * @param  \App\Models\Bcategory  $bcategory
     * @return void
    */
    public function delete($bcategory)
    {
        $bcategory->delete();
    }
}
