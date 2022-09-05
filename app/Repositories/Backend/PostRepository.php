<?php

namespace App\Repositories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository{

    /**
     * Store Post.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        if ($request->has('tags')) {
            $input['tags'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->tags);
        }
        if ($request->photo) {
            $input['photo'] = json_encode($this->storeImageData($request), true);
        }
        Post::create($input);
    }

    /**
     * Update Post.
     *
     * @param \App\Models\Post $post
     * @param \Illuminate\Http\Request $request
     * @return void
    */
    public function update($post, $request)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        if ($request->has('tags')) {
            $input['tags'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->tags);
        }
        if ($request->photo) {
            $images = json_decode($post->photo, true);
            foreach ($images as $image) {
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            $input['photo'] = json_encode($this->storeImageData($request), true);
        }

        $post->update($input);
    }

    /**
     * Delete Post.
     *
     * @param \App\Models\Post $post
     * @return void
    */
    public function delete($post)
    {
        $images = json_decode($post->photo, true);
        foreach ($images as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }
        $post->delete();
    }

    /**
     * Delete Photo.
     *
     * @param int $id
     * @param int $key
     * @return void
    */
    public function photoDelete($key, $id)
    {
        $post = Post::findOrFail($id);
        $photos = json_decode($post->photo, true);
        $delete_photo = $photos[$key];
        if (file_exists($delete_photo)) {
            unlink($delete_photo);
        }
        unset($photos[$key]);
        $new_photos = json_encode($photos, true);
        $post->update(['photo' => $new_photos]);
    }


    public function storeImageData($request)
    {
        $storeData = [];
        if($photos = $request->file('photo')){
            foreach ($photos as $key => $photo) {
                $storeData[$key] = ImageHelper::handleUploadedImage($photo, 'uploads/posts');
            }
        }
        return $storeData;
    }

    public function updateImageData($post, $request)
    {
        $storeData = json_decode($post->photo, true);
        if($photos = $request->file('photo')){
            foreach ($photos as $key => $photo) {
                array_push($storeData, ImageHelper::handleUploadedImage($photo, 'uploads/posts'));
            }
        }
        return $storeData;
    }
}
