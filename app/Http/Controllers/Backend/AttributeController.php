<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     * @return void
    */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources
    */
    public function index(Item $item)
    {
        return view('backend.item.attribute.index', [
            'item' => $item,
            'datas' => $item->attributes()->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Resources
    */
    public function create(Item $item)
    {
        return view('backend.item.attribute.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $requst
     * @return \Illuminate\Http\Resources
    */
    public function store(AttributeRequest $request, Item $item)
    {
        $attributeValidation = Attribute::where('item_id', $item->id)->where('name' , $request->name)->first();
        if (!is_null($attributeValidation)) {
            return redirect()->back()->withErrors(__('This name has already been taken.'))->withInput($request->all());
        }
        Attribute::create($request->all());
        return redirect()->route('backend.attribute.index', $item->id)->withSuccess(__('New Attribute Added Successfully.'));
    }

    /**
     * Show the form editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources
    */
    public function edit(Item $item, Attribute $attribute)
    {
        return view('backend.item.attribute.edit', compact('item', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(AttributeRequest $request, Item $item, Attribute $attribute)
    {
        $attributeValidation = Attribute::where('item_id', $item->id)->where('name' , $request->name)->where('id', '!=', $attribute->id)->first();
        if (!is_null($attributeValidation)) {
            return redirect()->back()->withErrors(__('The name: '. $request->name .' has already been taken.'))->withInput($request->all());
        }
        $attribute->update($request->all());
        return redirect()->route('backend.attribute.index', $item->id)->withSuccess(__('Attribute Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy(Item $item, $id)
    {
        $attribute = Attribute::where([ 'item_id' => $item->id, 'id' => $id ])->firstOrFail();
        $attribute->delete();
        return redirect()->route('backend.attribute.index', $item->id)->withSuccess(__('Attribute Deleted Successfully.'));
    }
}
