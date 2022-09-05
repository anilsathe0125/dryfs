<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeOptionRequest;
use App\Models\AttributeOption;
use App\Models\Attribute;

class AttributeOptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Item $item)
    {
        return view('backend.item.attribute_option.index', [
            'item'  => $item,
            'curr'  => Currency::where('is_default', 1)->first(),
            'datas' => $item->join('attributes', 'attributes.item_id', '=', 'items.id')
                            ->join('attribute_options', 'attribute_options.attribute_id', '=', 'attributes.id')
                            ->select('attribute_options.id', 'attribute_options.attribute_id', 'attribute_options.name', 'attribute_options.keyword', 'attribute_options.price', DB::raw('attributes.name as attribute'))
                            ->where('items.id', '=', $item->id)
                            ->latest('id')
                            ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create(Item $item)
    {
        return view('backend.item.attribute_option.create', [
            'item' => $item,
            'curr'  => Currency::where('is_default', 1)->first(),
            'attributes' => Attribute::whereItemId($item->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources
    */
    public function store(AttributeOptionRequest $request, Item $item)
    {
        $attributeOptionValidation = AttributeOption::where('attribute_id', $request->attribute_id)->where('name' , $request->name)->first();
        if (!is_null($attributeOptionValidation)) {
            return redirect()->back()->withErrors(__('This name has already been taken.'))->withInput($request->all());
        }
        $input = $request->all();
        $curr = Currency::where('is_default', 1)->first();
        $input['price'] = $request->price / $curr->value;
        AttributeOption::create($input);

        return redirect()->route('backend.option.index', $item->id)->withSuccess(__('New Attribute Option Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function edit(Item $item, AttributeOption $option)
    {
        return view('backend.item.attribute_option.edit', [
            'item' => $item,
            'option' => $option,
            'curr'  => Currency::where('is_default', 1)->first(),
            'attributes' => Attribute::whereItemId($item->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update(AttributeOptionRequest $request, Item $item, AttributeOption $option)
    {
        $attributeOptionValidation = AttributeOption::where('attribute_id', $request->attribute_id)->where('name' , $request->name)->where('id', '!=', $option->id)->first();
        if (!is_null($attributeOptionValidation)) {
            return redirect()->back()->withErrors(__('The name: '. $request->name .' has already been taken.'))->withInput($request->all());
        }
        $input = $request->all();
        $curr = Currency::where('is_default', 1)->first();
        $input['price'] = $request->price / $curr->value;
        $option->update($input);

        return redirect()->route('backend.option.index', $item->id)->withSuccess(__('Attribute Option Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy(Item $item, $id)
    {
        $option = AttributeOption::findOrFail($id);
        $option->delete();
        return redirect()->route('backend.option.index', $item->id)->withSuccess(__('Attribute Option Deleted Successfully.'));
    }
}
