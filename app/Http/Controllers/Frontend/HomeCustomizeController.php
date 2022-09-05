<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCustomize;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeCustomizeController extends Controller
{
    public function getCategory($category_slug, $type, $check)
    {
        $category = Category::whereSlug($category_slug)->first();

        $homecustomize = HomeCustomize::first();

        $datas = json_decode($homecustomize[$type], true);

        $index = '';
        foreach ($datas as $key => $data) {
            if ($data == $category->id) {
                $index = $key;
            }
        }

        $category = $category->id;
        if ($type == 'feature_category') {
            $items = Item::with('category')
                ->when($category, function ($query, $category) {
                    return $query->where('category_id', $category);
                })
                ->whereStatus(1)->take(10)->orderBy('id', 'desc')->get();
        } else {
            $items = Item::with('category')
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->whereStatus(1)->get();
        }

        if ($check != 'normal') {
            return view('frontend._inc.slider_product', compact('items'));
        } else {
            return view('frontend._inc.normal_product', compact('items'));
        }

    }

    public function getProducts($type)
    {
        return view('frontend._inc.type_product', [
            'items' => Item::where('is_type', $type)->whereStatus(1)->orderBy('id', 'desc')->get()
        ]);
    }
}
