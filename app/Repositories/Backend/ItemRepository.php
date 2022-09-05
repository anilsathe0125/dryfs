<?php

namespace App\Repositories\Backend;

use App\Models\Item;
use App\Models\Currency;
use App\Helpers\ImageHelper;
use App\Http\Requests\ItemRequest;
use App\Models\Gallery;

class ItemRepository {


    /**
     * Store Item.
     *
     * @param \App\Http\Request\ItemRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();

        if ($file = $request->file('photo')) {
            $images_name = ImageHelper::itemHandleUploadedimage($request->file('photo'), 'uploads/items');

            $input['photo'] = $images_name[0];
            $input['thumbnail'] = $images_name[1];
        }

        $curr = Currency::where('is_default', 1)->first();
        $input['discount_price'] = $request->discount_price / $curr->value;
        $input['previous_price'] = $request->previous_price / $curr->value;

        if ($request->has('meta_keywords')) {
            $input['meta_keywords'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->meta_keywords);
        }

        if ($request->has('is_social')) {
            $input['social_icons'] = json_encode($input['social_icons']);
            $input['social_links'] = json_encode($input['social_links']);
        } else {
            $input['is_social'] = 0;
            $input['social_icons'] = null;
            $input['social_links'] = null;
        }

        if ($request->has('tags')) {
            $input['tags'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->tags);
        }

        if ($request->has('is_specification')) {
            $input['specification_name'] = json_encode($input['specification_name']);
            $input['specification_description'] = json_encode($input['specification_description']);
        } else {
            $input['is_specification'] = 0;
            $input['specification_name'] = null;
            $input['specification_description'] = null;
        }

        if ($request->has('license_name') && $request->has('license_key')) {
            $input['license_name'] = json_encode($input['license_name']);
            $input['license_key'] = json_encode($input['license_key']);
        } else {
            $input['license_name'] = null;
            $input['license_key'] = null;
        }

        // Digital product file upload
        if ($request->item_type == 'digital') {
            if ($request->hasFile('file')) {
                $file = $request->file;
                $name = microtime() . str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/items/digital_items'), $name);
                $input['file'] = 'uploads/items/digital_items/' . $name;
            }
        }

        // License product file upload
        if ($request->item_type == 'license') {
            if ($request->hasFile('file')) {
                $file = $request->file;
                $name = microtime() . str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/items/license_items', $name));
                $input['file'] = 'uploads/items/license_items/' . $name;
            }
        }

        Item::create($input);

    }

    /**
     * Update Item.
     *
     * @param \Illuminate\Http\Request\ItemRequest $request
     * @return void
    */
    public function update($item, $request)
    {
        $input = $request->all();

        if ($request->has('photo')) {
            $images_name = ImageHelper::itemHandleUpdatedUploadedImage($request->photo, 'uploads/items', $item, 'photo');
            $input['photo'] = $images_name[0];
            $input['thumbnail'] = $images_name[1];
        }

        $curr = Currency::where('is_default', 1)->first();
        $input['discount_price'] = $request->discount_price / $curr->value;
        $input['previous_price'] = $request->previous_price / $curr->value;

        if ($request->has('meta_keywords')) {
            $input['meta_keywords'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->meta_keywords);
        }

        if ($request->has('is_social')) {
            $input['social_icons'] = json_encode($input['social_icons']);
            $input['social_links'] = json_encode($input['social_links']);
        } else {
            $input['is_social'] = 0;
            $input['social_icons'] = null;
            $input['social_links'] = null;
        }

        if ($request->has('tags')) {
            $input['tags'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->tags);
        }

        if ($request->has('is_specification')) {
            $input['specification_name'] = json_encode($input['specification_name']);
            $input['specification_description'] = json_encode($input['specification_description']);
        } else {
            $input['is_specification'] = 0;
            $input['specification_name'] = null;
            $input['specification_description'] = null;
        }

        if ($request->has('license_name') && $request->has('license_key')) {
            $input['license_name'] = json_encode($input['license_name']);
            $input['license_key'] = json_encode($input['license_key']);
        } else {
            $input['license_name'] = null;
            $input['license_key'] = null;
        }

        // Digital product file upload
        if ($request->item_type == 'digital') {
            if (!$request->hasFile('file')) {
                if ($item->link) {
                    if (file_exists($item->file)) {
                        unlink($item->file);
                    }
                    $input['file'] = null;
                }
            }
        }

        if ($request->item_type == 'digital') {
            if ($request->hasFile('file')) {
                if ($item->file) {
                    if (file_exists($item->file)) {
                        unlink($item->file);
                    }
                    $input['file'] = null;
                }
                $file = $request->file;
                $name = microtime() . str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/items/digital_items'), $name);
                $input['file'] = 'uploads/items/digital_items/' . $name;
                $input['link'] = null;
            }
        }

        $item->update($input);
    }

    /**
     * Highlight Item.
     *
     * @param \Illuminate\Http\Request\ItemRequest $request
     * @return void
    */
    public function highlight($item, $request)
    {
        $input = $request->all();

        if ($request->is_type != 'flash_deal') {
            $input['date'] = null;
        }

        $item->update($input);
    }

    /**
     * Delete Item.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($item)
    {
        if ($item->galleries()->count() > 0) {
            foreach ($item->galleries as $gallery) {
                $this->galleryDelete($gallery);
            }
        }

        if ($item->campaigns->count() > 0) {
            $item->campaigns()->delete();
        }

        if ($item->attributes()->count() > 0) {
            foreach ($item->attributes as $attribute) {
                $attribute->options()->delete();
            }
            $item->attributes()->delete();
        }

        if ($item->item_type == 'digital' && $item->file_type == 'file') {
            if (file_exists($item->file)) {
                unlink($item->file);
            }
        }

        ImageHelper::handleDeletedImage($item, 'photo');
        ImageHelper::handleDeletedImage($item, 'thumbnail');
        $item->delete();
    }

    /**
     * Update Gallery
     *
     * @param \App\Http\Requests\GalleryRequest $request
     * @return void
    */
    public function galleriesUpdate($request) {
        Gallery::insert($this->storeImageData($request));
    }

    /**
     * Delete gallery.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function galleryDelete($gallery)
    {
        ImageHelper::handleDeletedImage($gallery, 'photo');
        $gallery->delete();
    }

    /**
     * Custom Function for storing Image Data
     *
     * @return void
    */
    public function storeImageData($request)
    {
        $storeData = [];
        if ($galleries = $request->file('galleries')) {
            foreach ($galleries as $key => $gallery) {
                $storeData[$key] = [
                    'photo'   => ImageHelper::handleUploadedImage($gallery, 'uploads/items/gallery'),
                    'item_id' => $request['item_id']
                ];
            }
        }
        return $storeData;
    }
}
