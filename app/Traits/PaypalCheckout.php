<?php

namespace App\Traits;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use App\Models\Setting;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use App\Models\PromoCode;
use App\Models\TrackOrder;
use Illuminate\Support\Str;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\Helpers\EmailHelper;
use App\Helpers\PriceHelper;
use App\Models\Notification;
use PayPal\Api\RedirectUrls;
use App\Models\PaymentSetting;
use App\Models\ShippingService;
use PayPal\Api\PaymentExecution;
use App\Models\Item as ModelItem;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

trait PaypalCheckout
{
    private $_api_context;

    public function __construct()
    {
        $data = PaymentSetting::whereUniqueKeyword('paypal')->first();
        $payment_data = $data->convertJsonData();
        $paypal_config = Config::get('paypal');
        $paypal_config['client_id'] = $payment_data['client_id'];
        $paypal_config['secret'] = $payment_data['client_secret'];
        $paypal_config['settings']['mode'] = $payment_data['check_sandbox'] == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_config['client_id'],
            $paypal_config['secret']
        ));
        $this->_api_context->setConfig($paypal_config['settings']);
    }

    public function paypalSubmit($data)
    {
        $user = Auth::user();
        $setting = Setting::first();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach ($cart as $key => $item) {
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $item = ModelItem::findOrFail($key);
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
        $order_data['payment_method']     = 'Paypal';
        $order_data['user_id']            = $user->id;

        $paypal_item_name = 'Payment via paypal from ' . $setting->title;
        $paypal_item_amount = $total_amount;

        $payment_cancel_url = route('frontend.checkout.cancel');
        $payment_notify_url = route('frontend.checkout.redirect');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($paypal_item_name) /** Item Name **/
               ->setCurrency(PriceHelper::setCurrencyName())
               ->setQuantity(1)
               ->setPrice($paypal_item_amount); /** Unit Price **/

               // set ItemList data
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        // set amount data
        $amount = new Amount();
        $amount->setCurrency(PriceHelper::setCurrencyName())
               ->setTotal($paypal_item_amount);

        // set transaction data
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription($paypal_item_name);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($payment_notify_url) /** specify return url **/
                      ->setCancelUrl($payment_cancel_url);

        // set payment data
        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }

        $redirect_url = $payment->getApprovalLink();
        // foreach ($payment->getLinks() as $link) {
        //     if ($link->getRel() == 'approval_url') {
        //         $redirect_url = $link->getHref();
        //         break;
        //     }
        // }

        Session::put('order_data', $order_data);
        Session::put('order_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return [
                'status' => true,
                'link'   => $redirect_url
            ];
        }

        return [
            'status'  => false,
            'message' => __('Unknown error occurred.')
        ];
    }

    public function paypalNotify($responseData)
    {
        $order_data = Session::get('order_data');

        // get the payment id before session is cleared
        $payment_id = Session::get('order_payment_id');

        // clear the session payment ID
        if (empty($responseData['PayerID']) || empty($responseData['token'])) {
            return [
                'status'  => false,
                'message' => __('Unknown error occurred.')
            ];
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($responseData['PayerID']);
        // execute payment
        try {
            $result = $payment->execute($execution, $this->_api_context);
        } catch (\Throwable $th) {
            return [
                'status'  => false,
                'message' => __('Unknown error occurred.')
            ];
        }

        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);
            $cart = Session::get('cart');
            $user = Auth::user();
            $total_tax = 0;
            $cart_total = 0;
            $total = 0;
            $option_price = 0;
            foreach ($cart as $key => $item) {
                $total += $item['main_price'] * $item['qty'];
                $option_price += $item['attribute_price'];
                $cart_total = $total + $option_price;
                $item = ModelItem::findOrFail($key);
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
            $order_data['payment_method']     = 'Paypal';
            $order_data['user_id']            = $user->id;
            $order_data['txnid']              = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
            $order_data['transaction_number'] = Str::random(10);
            $order_data['currency_sign']      = PriceHelper::setCurrencySign();
            $order_data['currency_value']     = PriceHelper::setCurrencyValue();
            $order_data['payment_status']     = 'Paid';
            $order_data['order_status']       = 'Pending';
            $order = $user->orders()->create($order_data);

            PriceHelper::transaction($order->id, $order->transaction_number, $user->email, PriceHelper::orderTotal($order));
            PriceHelper::licenseQtyDecrease($cart);

            if (Session::has('copon')) {
                $code = PromoCode::find(Session::get('copon')['code']['id']);
                $code->no_of_times--;
                $code->update();
            }

            if ($discount) {
                $coupon_id = $discount['code']['id'];
                $get_coupon = PromoCode::findOrFail($coupon_id);
                $get_coupon->no_of_times -= 1;
                $get_coupon->update();
            }

            TrackOrder::create([
                'title'    => 'Pending',
                'order_id' => $order->id
            ]);

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

            Session::put('order_id', $order->id);
            Session::forget('cart');
            Session::forget('discount');
            Session::forget('discount');
            Session::forget('order_data');
            Session::forget('order_payment_id');
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Payment Failed.')
            ];
        }

    }
}
