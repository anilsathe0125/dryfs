<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tax;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Repositories\Backend\ItemRepository;
use phpDocumentor\Reflection\Types\This;

use function PHPUnit\Framework\directoryExists;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\ItemRepository $repository
     * @return void
    */
    public function __construct(ItemRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function add()
    {
        return view('backend.item.create', [
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $item_type = $request->has('item_type') ? ( $request->item_type ? $request->item_type : '' ) : '';
        $is_type = $request->has('is_type') ? ( $request->is_type ? $request->is_type : '' ) : '';
        $category_id = $request->has('category_id') ? ( $request->category_id ? $request->category_id : '' ) : '';
        $orderBy = $request->has('orderby') ? ( $request->orderby ? $request->orderby : 'desc' ) : 'desc';

        $datas = Item::
                    when($item_type, function($query, $item_type){
                        return $query->where('item_type', $item_type);
                    })
                    ->when($is_type, function($query, $is_type){
                        return $query->where('is_type', $is_type);
                    })
                    ->when($category_id, function($query, $category_id){
                        return $query->where('category_id', $category_id);
                    })
                    ->when($orderBy, function($query, $orderBy){
                        return $query->orderBy('id', $orderBy);
                    })
                    ->get();
        return view('backend.item.index', [
            'datas' => $datas,
            'categories' => Category::whereStatus(1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.item.create', [
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'brands' => Brand::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(ItemRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.item.index')->withSuccess(__('New Product Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Item $item)
    {
        return view('backend.item.edit', [
            'item' => $item,
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'brands' => Brand::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
            'social_icons' => json_decode($item->social_icons, true),
            'social_links' => json_decode($item->social_links, true),
            'specification_name' => json_decode($item->specification_name, true),
            'specification_description' => json_decode($item->specification_description, true),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(ItemRequest $request, Item $item)
    {
        $this->repository->update($item, $request);
        return redirect()->route('backend.item.index')->withSuccess(__('Product Updated Successfully.'));
    }

    /**
     * Change the status of the specified resource.
     *
     * @param  int  $id
     * @param int $status
     * @return \Illuminate\Http\Response
    */
    public function status($id, $status)
    {
        Item::where('id', $id)->update([ 'status' => $status ]);
        return redirect()->route('backend.item.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $this->repository->delete($item);
        return redirect()->route('backend.item.index')->withSuccess(__('Product Deleted Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function galleries(Item $item)
    {
        return view('backend.item.galleries', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GalleryRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function galleriesUpdate(GalleryRequest $request)
    {
        $this->repository->galleriesUpdate($request);
        return redirect()->back()->withSuccess(__('Gallery Information Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function galleryDelete($gallery_id)
    {
        $gallery = Gallery::findOrFail($gallery_id);
        $this->repository->galleryDelete($gallery);
        return redirect()->back()->withSuccess(__('Successfully Deleted From Gallery.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function highlight(Item $item)
    {
        return view('backend.item.highlight', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function highlightUpdate(Item $item, Request $request)
    {
        $this->repository->highlight($item, $request);
        return redirect()->route('backend.item.index')->withSuccess(__('Product Updated Successfully.'));
    }


    // ---------------- DIGITAL PRODUCT START ---------------//

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function digitalItemCreate()
    {
        return view('backend.item.digital.create', [
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'brands' => Brand::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function digitalItemStore(Request $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.item.index')->withSuccess(__('New Product Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function digitalItemEdit($id)
    {
        $item = Item::findOrFail($id);

        return view('backend.item.digital.edit', [
            'item' => $item,
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'brands' => Brand::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
            'social_icons' => json_decode($item->social_icons, true),
            'social_links' => json_decode($item->social_links, true),
            'specification_name' => json_decode($item->specification_name, true),
            'specification_description' => json_decode($item->specification_description, true),
        ]);
    }

    // ---------------- LICENSE PRODUCT START ---------------//

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function licenseItemCreate()
    {
        return view('backend.item.license.create', [
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'brands' => Brand::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function licenseItemStore(ItemRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('backend.item.index')->withSuccess(__('New Product Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function licenseItemEdit($id)
    {
        $item = Item::findOrFail($id);

        return view('backend.item.license.edit', [
            'item' => $item,
            'curr' => Currency::where('is_default', 1)->first(),
            'categories' => Category::whereStatus(1)->get(),
            'brands' => Brand::whereStatus(1)->get(),
            'taxes' => Tax::whereStatus(1)->get(),
            'social_icons' => json_decode($item->social_icons, true),
            'social_links' => json_decode($item->social_links, true),
            'specification_name' => json_decode($item->specification_name, true),
            'specification_description' => json_decode($item->specification_description, true),
            'license_name' => json_decode($item->license_name, true),
            'license_key' => json_decode($item->license_key, true)
        ]);
    }

}
