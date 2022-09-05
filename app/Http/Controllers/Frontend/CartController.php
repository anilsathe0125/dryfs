<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\PriceHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Repositories\Frontend\CartRepository;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Frontend\CartRepository $repository
     * @return void
     *
    */
    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }
        return view('frontend.catalog.cart', [
            'cart' => $cart
        ]);
    }

    /**
     * Add product to cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function addToCart(Request $request)
    {
        $msg = $this->repository->store($request);
        if ($request->ajax()) {
            return response()->json([
                'message' => $msg,
                'qty' => count(Session::get('cart'))
            ]);
        }
    }

    /**
     * Store in cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $msg = $this->repository->store($request);
        if ($request->addtocart) {
            return back()->with('success_message', __('Cart Added Successfully.'));
        }
        return redirect()->route('frontend.cart')->withSuccess($msg);
    }

    /**
     * Destory cart.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $cart = Session::get('cart');
        unset($cart[$id]);
        if (count($cart) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return back()->with('success', __('Cart item removed successfully.'));
    }

    /**
     * Promo store.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function promoStore(Request $request)
    {
        return response()->json($this->repository->promoStore($request));
    }

    /**
     * Shipping Store.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function shippingStore(Request $request)
    {
        return redirect()->route('frontend.checkout');
    }

    /**
     * Update cart.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function update($id)
    {
        return view('frontend.catalog.cart_form', [
            'item'       => Item::findOrFail($id),
            'attributes' => Item::findOrFail($id)->attributes,
            'cart_item'  => Session::get('cart')[$id]
        ]);
    }

    /**
     * Shipping Charge.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function shippingCharge(Request $request)
    {
        $charges = [];
        $items   = [];
        foreach ($request->user_id as $data) {
            $check = explode('|', $data);
            $charges[] = $check[0];
            $items[]   = $check[1];
        }
        $cart = Session::get('cart');
        $delivery_amount = 0;
        foreach ($charges as $index => $charge) {
            if ($charge != 0) {
                $vendor_charge = Item::findOrFail($items[$items])->user->shipping->price;
                $delivery_amount += $vendor_charge;
                $cart[$items[$index]]['delivery_charge'] = $vendor_charge;
            } else {
                $cart[$items[$index]]['delivery_charge'] = 0;
            }
        }
        Session::put('cart', $cart);
        return response()->json([
            'delivery' => PriceHelper::setPrice($delivery_amount),
            'main' => $delivery_amount
        ]);
    }

    /**
     * Header cart resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function headerCartLoad()
    {
        return view('frontend._inc.header_cart');
    }

    /**
     * Cart resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function cartLoad()
    {
        return view('frontend._inc.cart');
    }

    /**
     * Clear Cart.
     *
     * @return \Illuminate\Http\Response
    */
    public function cartClear()
    {
        Session::forget('cart');
        return back()->with('success', __('Cart cleared successfully.'));
    }
}
