<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CampaignItem;
use App\Models\Item;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
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
    public function index()
    {
        $datas = Item::whereStatus(1)->select('name', 'id')->orderBy('id', 'desc')->get();
        return view('backend.item.campaign', [
            'datas' => $datas,
            'items' => CampaignItem::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required'
        ]);

        if (CampaignItem::whereItemId($request->item_id)->exists()) {
            return redirect()->route('backend.campaign.index')->withError(__('Product Already Dxists In Campaign.'));
        }

        $data = new CampaignItem();
        $data->create($request->all());
        return redirect()->route('backend.campaign.index')->withSuccess(__('Product Added To Campaign Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $data = CampaignItem::findOrFail($id);
        $data->delete();
        return redirect()->route('backend.campaign.index')->withSuccess(__('Product Removed From Campaign Successfully.'));
    }

    /**
     * Change the status for editing specified resource.
     *
     * @param int $id
     * @param int $status
     * @param string $type
     * @return \Illuminate\Http\Response
    */
    public function status($id, $status, $type)
    {
        if ($type == 'is_feature' && $status == 1) {
            if (CampaignItem::whereIsFeature(1)->count() == 10) {
                return redirect()->route('backend.campaign.index')->withError(__('10 Products Are Already Added To Feature.'));
            }
        }

        $data = CampaignItem::findOrFail($id);
        $data->update([ $type => $status ]);
        return redirect()->route('backend.campaign.index')->withSuccess(__('Status Updated Successfully.'));
    }
}
