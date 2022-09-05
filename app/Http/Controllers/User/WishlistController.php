<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store']]);
    }

    /**
     * Show listing of wishlist items.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $wishlists = Wishlist::whereUserId(Auth::user()->id)->pluck('item_id')->toArray();
        $wishlist_items = Item::where('status', '=', 1)->whereIn('id', $wishlists)->latest('id')->get();
        return view('user.wishlist.index', compact('wishlist_items'));
    }

    /**
     * Store item in wishlist.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function store($id)
    {
        $user = Auth::user();
        if ($user) {
            if (Wishlist::where('user_id', '=', $user->id)->where('item_id', '=', $id)->exists()) {
                return response()->json([
                    'status' => 2,
                    'message' => __('Product Already Added To Wishlist')
                ]);
            }
                $user->wishlists()->create([
                    'item_id' => $id
                ]);
        } else {
            return response()->json([
                'status' => 0,
                'link' => route('user.login')
            ]);
        }
        return response()->json([
            'count' => Wishlist::where('user_id', '=', $user->id)->count(),
            'status' => 1,
            'message' => __('Product Successfully Added To Wishlist.')
        ]);
    }

    /**
     * Delete item from wishlist.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where(['id' => $id, 'user_id' => $user->id])->firstOrFail();
        $wishlist->delete();
        return redirect()->back()->withSuccess(__('Product Successfully Removed From Wishlist.'));
    }

    /**
     * Delete all items from wishlist.
     *
     * @return \Illuminate\Http\Response
    */
    public function deleteAll()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->delete();
        return redirect()->back()->withSuccess(__('Products Successfully Removed From Wishlist.'));
    }
}
