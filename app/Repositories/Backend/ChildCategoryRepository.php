<?php

namespace App\Repositories\Backend;

use App\Models\ChildCategory;

class ChildCategoryRepository {

    /**
     * Store childcategory.
     *
     * @param \App\Http\Requests\ChildCategoryRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        ChildCategory::create($input);
    }

    /**
     * Update childcategory.
     *
     * @param \App\Http\Requests\ChildCategoryRequest $request
     * @return void
    */
    public function update($childcategory, $request)
    {
        $input = $request->all();
        $childcategory->update($input);
    }

    /**
     * Delete childcategory.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($childcategory)
    {
        $childcategory->delete();
    }
}
