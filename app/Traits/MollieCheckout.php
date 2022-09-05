<?php

namespace App\Traits;

use App\Models\Item;
use App\Models\Order;
use App\Models\Setting;
use App\Models\PromoCode;
use App\Models\TrackOrder;
use Illuminate\Support\Str;
use App\Helpers\EmailHelper;
use App\Helpers\PriceHelper;
use App\Models\Notification;
use App\Models\PaymentSetting;
use App\Models\ShippingService;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait MollieCheckout
{
    public function __construct()
    {

    }

    public function mollieSubmit()
    {
        $notify_url = route("frontend.checkout.mollie.redirect");
        $cart = Session::get('cart');
        $setting = Setting::first();
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
        $total_amount = PriceHelper::setConvertPrice($grand_total);

        // set api key for mollie
        $data = PaymentSetting::whereUniqueKeyword('mollie')->first();
        $payment_data = $data->convertJsonData();
        Mollie::api()->setApiKey($payment_data['key']);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => PriceHelper::setCurrencyName(),
                'value'    => sprintf('%0.2f', $total_amount), // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => $setting->title . ' - Order',
            'redirectUrl' => $notify_url
        ]);

        Session::put('payment_id', $payment->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        if ($payment->getCheckoutUrl()) {
            /** Redirect to Mollie **/
            return [
                'status' => true,
                'link'   => $payment->getCheckoutUrl()
            ];
        }

        return [
            'status' => false,
            'message' => __('Unknown error occurred.')
        ];
    }

    public function mollieNotify($responseData)
    {
        $user = Auth::user();
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
        $total_amount = PriceHelper::setConvertPrice($grand_total);

        $order_data['cart']               = json_encode($cart, true);
        $order_data['discount']           = json_encode($discount, true);
        $order_data['shipping']           = json_encode($shipping, true);
        $order_data['tax']                = $total_tax;
        $order_data['shipping_info']      = json_encode(Session::get('shipping_address'), true);
        $order_data['billing_info']       = json_encode(Session::get('billing_address'), true);
        $order_data['payment_method']     = 'Mollie';
        $order_data['user_id']            = $user->id;
        $order_data['transaction_number'] = Str::random(10);
        $order_data['txnid']              = $responseData['payment_id'];
        $order_data['currency_sign']      = PriceHelper::setCurrencySign();
        $order_data['currency_value']     = PriceHelper::setCurrencyValue();
        $order_data['payment_status']     = 'Paid';
        $order_data['order_status']       = 'Pending';
        $order                            = Order::create($order_data);

        TrackOrder::create([
            'title'    => 'Pending',
            'order_id' => $order->id
        ]);

        PriceHelper::transaction($order->id, $order->transaction_number, $user->email, PriceHelper::orderTotal($order));
        PriceHelper::licenseQtyDecrease($cart);

        Notification::create([
            'order_id' => $order->id
        ]);

        $email_data = [
            'to'                 => $user->email,
            'type'               => 'Order',
            'user_name'          => $user->displayName(),
            'order_cost'         => $total_amount,
            'transaction_number' => $order->transaction_number,
            'site_title'         => Setting::first()->title,
        ];

        $email = new EmailHelper();
        $email->sendTemplateMail($email_data);

        if ($discount) {
            $coupon_id = $discount['code']['id'];
            $get_coupon = PromoCode::findOrFail($coupon_id);
            $get_coupon->no_of_times -= 1;
            $get_coupon->update();
        }

        Session::put('order_id', $order->id);
        Session::forget('cart');
        Session::forget('discount');
        return [
            'status' => true
        ];
    }
}
