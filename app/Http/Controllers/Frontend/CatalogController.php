<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\PriceHelper;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
    /**
     * Show listing of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        // attribute search
        $attr_item_ids = [];
        if ($request->attribute) {
            $attributes_get = Attribute::where('name', $request->attribute)->get();
            foreach ($attributes_get as $attr_item_id) {
                $attr_item_ids[] = $attr_item_id->item_id;
            }
        }

        $option_attr_ids = [];
        if ($request->option) {
            $options_get = AttributeOption::whereIn('name', explode(',', $request->option))->get();
            foreach ($options_get as $option_attr_id) {
                $option_attr_ids[] = $option_attr_id;
            }
        }

        $option_wise_item_ids = [];
        foreach (Attribute::whereIn('id', $option_attr_ids)->get() as $attr_item_id) {
            $option_wise_item_ids = $attr_item_id->item_id;
        }

        $sorting = $request->has('sorting') ? ( !empty($request->sorting) ? $request->sorting : null ) : null;
        $new = $request->has('new') ? ( !empty($request->new) ? 1 : null ) : null;
        $feature = $request->has('quick_filter') ? ( !empty($request->quick_filter == 'feature') ? 1 : null ) : null;
        $top = $request->has('quick_filter') ? ( !empty($request->quick_filter == 'top') ? 1 : null ) : null;
        $best = $request->has('quick_filter') ? ( !empty($request->quick_filter == 'best') ? 1 : null ) : null;
        $brand = $request->has('brand') ? ( !empty($request->brand) ? Brand::whereSlug($request->brand)->firstOrFail() : null ) : null;
        $search = $request->has('search') ? ( !empty($request->search) ? $request->search : null ) : null;

        $category = $request->has('category') ? ( !empty($request->category) ? Category::whereSlug($request->category)->firstOrFail() : null ) : null;

        $minPrice = $request->has('minPrice') ? ( !empty($request->minPrice) ? PriceHelper::convertPrice($request->minPrice) : null ) : null;
        $maxPrice = $request->has('maxPrice') ? ( !empty($request->maxPrice) ? PriceHelper::convertPrice($request->maxPrice) : null ) : null;

        $items = Item::with('category')
                 ->when($category, function($query, $category){
                    return $query->where('category_id', $category->id);
                 })
                 ->when($feature, function($query){
                    return $query->whereIsType('feature');
                 })
                 ->when($new, function($query){
                    return $query->orderBy('id', 'desc');
                 })
                 ->when($top, function($query){
                    return $query->whereIsType('top');
                 })
                 ->when($best, function($query){
                    return $query->whereIsType('best');
                 })
                 ->when($brand, function($query, $brand){
                    return $query->where('brand_id', $brand->id);
                 })
                 ->when($search, function($query, $search){
                    return $query->where('name', 'like', '%' . $search . '%')->orWhere('tags', 'like', '%' . $search . '%');
                 })
                 ->when($minPrice, function($query, $minPrice){
                    return $query->where('discount_price', '>=', $minPrice);
                 })
                 ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('discount_price', '<=', $maxPrice);
                 })
                 ->when($sorting, function($query, $sorting){
                    if ($sorting == 'low_to_high') {
                        return $query->orderBy('discount_price', 'asc');
                    } else {
                        return $query->orderBy('discount_price', 'desc');
                    }
                 })
                 ->when($attr_item_ids, function($query, $attr_item_ids){
                    return $query->whereIn('id', $attr_item_ids);
                 })
                 ->when($option_wise_item_ids, function($query, $option_wise_item_ids){
                    return $query->whereIn('id', $option_wise_item_ids);
                 })
                 ->where('status', 1)
                 ->orderBy('id', 'desc')->paginate(16);

        // attribute check
        $checkitem = Item::whereStatus(1)->get();

        $attr_array = [];
        $attr_name  = [];
        foreach ($checkitem as $product) {
            foreach ($product->attributes as $attr) {
                if (!in_array($attr->name, $attr_name)) {
                    $attr_array[] = $attr->id;
                    $attr_name[] = $attr->name;
                }
            }
        }

        $attributes = [];
        foreach ($attr_array as $id) {
            $attributes[] = Attribute::with('options')->findOrFail($id);
        }

        $blade = 'frontend.catalog.index';

        if ($request->view_check) {
            Session::put('view_catalog', $request->view_check);
        }

        if (Session::has('view_catalog')) {
            $checkType = Session::get('view_catalog');
            $name_string_count = 55;
        }else{
            Session::put('view_catalog', 'grid');
            $checkType = Session::get('view_catalog');
            $name_string_count = 38;
        }

        if($request->ajax()) $blade = 'frontend.catalog.catalog';

        return view($blade, [
            'all_products' => Item::whereStatus(1)->count(),
            'feature_products' => Item::whereIsType('feature')->whereStatus(1)->count(),
            'top_products' => Item::whereIsType('top')->whereStatus(1)->count(),
            'best_products' => Item::whereIsType('best')->whereStatus(1)->count(),
            'attributes' => $attributes,
            'brand' => $brand,
            'items' => $items,
            'name_string_count' => $name_string_count,
            'category' => $category,
            'checkType' => $checkType,
            'brands' => Brand::withCount('items')->whereStatus(1)->get(),
            'categories' => Category::whereStatus(1)->orderBy('serial', 'asc')->withCount(['items' => function($query) {
                $query->where('status', 1);
            }])->get()
        ]);
    }

    /**
     * Show listing of resources.
     *
     * @param  string $type
     * @return \Illuminate\Http\Response
    */
    public function viewType($type)
    {
        Session::put('view_catalog', $type);
        return response()->json($type);
    }
}
