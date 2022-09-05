<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function compare($id)
    {
        if (Session::has('compare')) {
            if (count(Session::get('compare')) < 2) {
                $compares = Session::get('compare');
                if (in_array($id, $compares)) {
                    $status = 0;
                    $msg = __('This product is already added in compare products list.');
                    return response()->json(['message' => $msg, $status]);
                }
                array_push($compares, $id);
                Session::put('compare', $compares);
                $status = 1;
                $msg = __('Product added in compare list successfully.');
            } else {
                $compares = Session::get('compare');
                $status = 0;
                $msg = __('2 Products already added in compare list.');
            }
        } else {
            $compares = array($id);
            Session::put('compare', $compares);
            $status = 1;
            $msg = __('Product added in compare list successfully.');
        }
        return response()->json(['message' => $msg, 'status' => $status, 'compare_count' => count($compares)]);
    }

    public function compareProducts()
    {
        if (Session::has('compare')) {
            $sname = [];
            $sdesc = [];
            $ids = Session::get('compare');
            foreach ($ids as $key => $id) {
                $item = Item::findOrFail($id);
                $items[] = $item;
                if (!empty($item->specification_name)) {
                    $sname = array_merge($sname, json_decode($item->specification_name, true));
                    $sdesc = array_merge($sdesc, json_decode($item->specification_description, true));
                } else {
                    $sname = [];
                    $sdesc = [];
                }
            }
        } else {
            $items = [];
            $sname = [];
            $sdesc = [];
        }

        return view('frontend.compare', [
            'items' => $items,
            'sname' => $sname,
            'sdesc' => $sdesc
        ]);
    }

    public function compareRemove($itemId)
    {
        $ids = Session::get('compare');
        $newIds = [];
        foreach ($ids as $id) {
            if ($itemId != $id) {
                $newIds[] = $id;
            }
        }

        if (!count($newIds) == 0) {
            Session::put('compare', $newIds);
            return true;
        } else {
            Session::forget('compare');
            return true;
        }

    }
}
