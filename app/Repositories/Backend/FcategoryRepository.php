<?php

namespace App\Repositories\Backend;

use App\Models\Fcategory;

class FcategoryRepository{

    /**
     * Store Category.
     *
     * @param \App\Http\Requests\FcategoryRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        Fcategory::create($input);
    }

    /**
     * Update Category.
     *
     * @param \App\Http\Requests\FcategoryRequest $request
     * @param \App\Models\Fcategory $fcategory
     * @return void
    */
    public function update($fcategory, $request)
    {
        $input = $request->all();
        $fcategory->update($input);
    }

    /**
     * Delete Category.
     *
     * @param \App\Models\Fcategory $fcategory
     * @return void
    */
    public function delete($fcategory)
    {
        $fcategory->delete();
    }
}
