<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Currency;
use App\Helpers\SmsHelper;
use App\Helpers\PriceHelper;
use App\Traits\BankCheckout;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Traits\MollieCheckout;
use App\Traits\PaypalCheckout;
use App\Traits\StripeCheckout;
use App\Models\ShippingService;
use App\Traits\PaystackCheckout;
use Mollie\Laravel\Facades\Mollie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use App\Traits\CashOnDeliveryCheckout;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    use StripeCheckout {
        StripeCheckout::__construct  as private __stripeConstruct;
    }

    use PaypalCheckout {
        PaypalCheckout::__construct  as private __paypalConstruct;
    }

    use MollieCheckout {
        MollieCheckout::__construct  as private __mollieConstruct;
    }

    use BankCheckout;
    use PaystackCheckout;
    use CashOnDeliveryCheckout;

    public function __construct()
    {
        $this->middleware('auth');
        $this->__stripeConstruct();
        $this->__paypalConstruct();
        $this->__mollieConstruct();
    }

    /**
     * Show page to colelct addresseses.
     *
     * @return \Illuminate\Http\Response
    */
    public function shippingAddress()
    {
        if (!Session::has('cart')) {
            return redirect()->route('frontend.cart');
        }

        $data['user'] = Auth::user();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach ($cart as $key => $item) {
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $item = Item::findOrFail($key);
            if ($item->tax) {
                $total_tax += $item->taxCalculate($item);
            }
        }

        $shipping = [];
        if (ShippingService::whereStatus(1)->exists()) {
            $shipping = ShippingService::whereStatus(1)->first();
        }

        $discount = [];
        if (Session::has('coupon')) {
            $discount = Session::get('coupon');
        }
        $grand_total = ($cart_total + ($shipping ? $shipping->price : 0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $total_amount = $grand_total;

        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        return view('frontend.checkout.billing', $data);
    }

    /**
     * Store billing information into session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function billingStore(Request $request)
    {
        if ($request->same_ship_address) {
            Session::put('billing_address', $request->all());

            if (PriceHelper::checkDigital()) {
                $shipping = [
                    'ship_first_name' => $request->bill_first_name,
                    'ship_last_name'  => $request->bill_last_name,
                    'ship_email'      => $request->bill_email,
                    'ship_phone'      => $request->bill_phone,
                    'ship_company'    => $request->bill_company,
                    'ship_address1'   => $request->bill_address1,
                    'ship_address2'   => $request->bill_address2,
                    'ship_zip'        => $request->bill_zip,
                    'ship_city'       => $request->bill_city,
                    'ship_county'     => $request->bill_country
                ];
            } else {
                $shipping = [
                    'ship_first_name' => $request->bill_first_name,
                    'ship_last_name'  => $request->bill_last_name,
                    'ship_email'      => $request->bill_email,
                    'ship_phone'      => $request->bill_phone
                ];
            }
            Session::put('shipping_address', $shipping);
        } else {
            Session::put('billing_address', $request->all());
            Session::forget('shipping_address');
        }

        if (Session::has('shipping_address')) {
            return redirect()->route('frontend.checkout.payment');
        } else {
            return redirect()->route('frontend.checkout.shipping');
        }
    }

    /**
     * Show page to collect shipping iformation.
     *
     * @return \Illuminate\Http\Response
    */
    public function shipping()
    {
        if (Session::has('shipping_address')) {
            return redirect()->route('frontend.checkout.payment');
        }

        if (!Session::has('cart')) {
            return redirect()->route('frontend.cart');
        }

        $data['user'] = Auth::user();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach ($cart as $key => $item) {
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $item = Item::findOrFail($key);
            if ($item->tax) {
                $total_tax += $item->taxCalculate($item);
            }
        }

        $shipping = [];
        if (ShippingService::whereStatus(1)->exists()) {
            $shipping = ShippingService::whereStatus(1)->first();
        }

        $discount = [];
        if (Session::has('coupon')) {
            $discount = Session::get('coupon');
        }
        $grand_total = ($cart_total + ($shipping ? $shipping->price : 0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $total_amount = $grand_total;

        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        return view('frontend.checkout.shipping', $data);
    }

    /**
     * Store shipping information into session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function shippingStore(Request $request)
    {
        Session::put('shipping_address', $request->all());
        return redirect()->route('frontend.checkout.payment');
    }

    /**
     * Show page to collect payment iformation.
     *
     * @return \Illuminate\Http\Response
    */
    public function payment()
    {
        if (!Session::has('billing_address')) {
            return redirect()->route('frontend.checkout.billing');
        }

        if (!Session::has('shipping_address')) {
            return redirect()->route('frontend.checkout.shipping');
        }

        if (!Session::has('cart')) {
            return redirect()->route('frontend.cart');
        }

        $data['user'] = Auth::user();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach ($cart as $key => $item) {
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $item = Item::findOrFail($key);
            if ($item->tax) {
                $total_tax += $item->taxCalculate($item);
            }
        }

        $shipping = [];
        if (ShippingService::whereStatus(1)->exists()) {
            $shipping = ShippingService::whereStatus(1)->first();
        }

        $discount = [];
        if (Session::has('coupon')) {
            $discount = Session::get('coupon');
        }
        $grand_total = ($cart_total + ($shipping ? $shipping->price : 0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $total_amount = $grand_total;

        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        return view('frontend.checkout.payment', $data);
    }

    /**
     * Checkout
     *
     * @param \App\Http\Requests\PaymentRequest $request
     * @return \Illuminate\Http\Response
    */
    public function checkout(PaymentRequest $request)
    {
        $input = $request->all();

        $checkout         = false;
        $payment_redirect = false;
        $payment          = null;

        if (Session::has('currency')) {
            $currency = Currency::findOrFail(Session::get('currency'));
        } else {
            $currency = Currency::where('is_default', 1)->first();
        }

        // Use currency check
        $usd_supported = [ 'USD', 'EUR' ];
        $paystack_supported = [ 'NGN' ];
        switch ($input['payment_method']) {
            case 'Stripe':
                if (!in_array($currency->name, $usd_supported)) {
                    return redirect()->back()->withError(__('Currency Not Supported.'));
                }
                $checkout = true;
                $payment = $this->stripeSubmit($input);
                break;

            case 'Paypal':
                if (!in_array($currency->name, $usd_supported)) {
                    return redirect()->back()->withError(__('Currency Not Supported.'));
                }
                $checkout = true;
                $payment_redirect = true;
                $payment = $this->paypalSubmit($input);
                break;

            case 'Mollie':
                if (!in_array($currency->name, $usd_supported)) {
                    return redirect()->back()->withError(__('Currency Not Supported.'));
                }
                $checkout = true;
                $payment_redirect = true;
                $payment = $this->mollieSubmit($input);
                break;

            case 'Paystack':
                if (!in_array($currency->name, $paystack_supported)) {
                    return redirect()->back()->withError(__('Currency Not Supported.'));
                }
                $checkout = true;
                $payment = $this->paystackSubmit($input);
                break;

            case 'Bank':
                $checkout = true;
                $payment = $this->bankSubmit($input);
                break;

            case 'Cash On Delivery':
                $checkout = true;
                $payment = $this->cashOnDeliverySubmit($input);
                break;
        }

        if ($checkout) {
            if ($payment_redirect) {
                if ($payment['status']) {
                    return redirect()->away($payment['link']);
                } else {
                    Session::put('message', $payment['message']);
                    return redirect()->route('frontend.checkout.cancel');
                }
            } else {
                if($payment['status']){
                    return redirect()->route('frontend.checkout.success');
                }else{
                    Session::put('message',$payment['message']);
                    return redirect()->route('frontend.checkout.cancel');
                }
            }
        } else {
            return redirect()->route('frontend.checkout.cancel');
        }
    }

    /**
     * Payemtn redirect
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function paymentRedirect(Request $request)
    {
        $responseData = $request->all();
        if (Session::has('order_payment_id')) {
            $payment = $this->paypalNotify($responseData);
            if($payment['status']){
                return redirect()->route('frontend.checkout.success');
            }else{
                Session::put('message',$payment['message']);
                return redirect()->route('frontend.checkout.cancel');
            }
        } else {
            return redirect()->route('frontend.checkout.cancel');
        }
    }

    /**
     * Mollie redirect
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function mollieRedirect(Request $request)
    {
        $responseData = $request->all();
        // set api key for mollie
        $data = PaymentSetting::whereUniqueKeyword('mollie')->first();
        $payment_data = $data->convertJsonData();
        Mollie::api()->setApiKey($payment_data['key']);
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
        $responseData['payment_id'] = $payment->id;
        if ($payment->status == 'paid') {
            $payment = $this->mollieNotify($responseData);
            if($payment['status']){
                return redirect()->route('frontend.checkout.success');
            }else{
                Session::put('message',$payment['message']);
                return redirect()->route('frontend.checkout.cancel');
            }
        } else {
            return redirect()->route('frontend.checkout.cancel');
        }
    }

    /**
     * Show a page showing payment success
     *
     * @return \Illuminate\Http\Response
    */
    public function paymentSuccess()
    {
        if (Session::has('order_id')) {
            $order_id = Session::get('order_id');
            $order = Order::findOrFail($order_id);
            $cart = json_decode($order->cart, true);
            $setting = Setting::first();

            if ($setting->is_twilio == 1) {
                // Send message
                $sms = new SmsHelper();
                $user_number = $order->user->phone;
                if ($user_number) {
                    $sms->sendSms($user_number, "'purchase'");
                }
            }
            return view('frontend.checkout.success', compact('order', 'cart'));
        }
        return redirect()->route('frontend.index');
    }

    /**
     * Payment cancellation
     *
     * @return \Illuminate\Http\Response
    */
    public function paymentCancel()
    {
        $message = '';
        if (Session::has('message')) {
            $message = Session::get('message');
            Session::forget('message');
        } else {
            $message = __('Payment Failed!');
        }
        return redirect()->route('frontend.checkout.billing')->withError($message);
    }
}
