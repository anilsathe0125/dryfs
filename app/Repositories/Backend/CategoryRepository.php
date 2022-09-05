<?php

namespace App\Repositories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Category;
use App\Models\HomeCustomize;

class CategoryRepository{

    /**
     * Store Category.
     *
     * @param \App\Http\Requests\CategoryRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'), 'uploads/categories');
        Category::create($input);
    }

    /**
     * Update Category.
     *
     * @param \App\Http\Requests\CategoryRequest $request
     * @return void
    */
    public function update($category, $request)
    {
        $input = $request->all();
        if($file = $request->file('photo')){
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/categories', $category, 'photo');
        }
        $category->update($input);
    }

    /**
     * Delete Category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($category)
    {
        $home = HomeCustomize::first();
        $popular_category = json_decode($home['popular_category'], true);
        $feature_category = json_decode($home['feature_category'], true);
        $two_column_category = json_decode($home['two_column_category'], true);
        $home_4_popular_category = json_decode($home['home_4_popular_category'], true);
        $check = false;

        for ($i = 1; $i < 5 ; $i++) {
            if($popular_category['category_id'.$i] == $category->id){
                $check = true;
            }
        }

        for ($i = 1; $i < 5 ; $i++) {
            if($feature_category['category_id'.$i] == $category->id){
                $check = true;
            }
        }

        for ($i = 1; $i < 3 ; $i++) {
            if($two_column_category['category_id'.$i] == $category->id){
                $check = true;
            }
        }

        if(in_array($category->id, $home_4_popular_category)){
            $check = true;
        }

        if ($check) {
            return [
                'message' => __('This Category allready used Home page section . Please change this category then delete this category'),
                'status'  => 0
            ];
        } else {
            ImageHelper::handleDeletedImage($category, 'photo');
            $category->delete();
            return [
                'message' => __('Category Deleted Successfully.'),
                'status'  => 1
            ];
        }


    }
}
