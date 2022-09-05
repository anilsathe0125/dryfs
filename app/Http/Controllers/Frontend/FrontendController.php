<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\Post;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Bcategory;
use App\Models\Fcategory;
use App\Models\Subscriber;
use App\Helpers\EmailHelper;
use App\Models\CampaignItem;
use Illuminate\Http\Request;
use App\Models\HomeCustomize;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\SubscribeRequest;
use App\Models\TrackOrder;
use Illuminate\Support\Facades\Session;
use App\Repositories\Frontend\FrontRepository;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Frontend\FrontRepository $repository
     * @return void
    */
    public function __construct(FrontRepository $repository) {
        $this->repository = $repository;
        $setting = Setting::first();
        if ($setting->recaptcha == 1) {
            Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
            Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
        }
    }

    // ------------ Home ------------------
    public function index()
    {
        $setting = Setting::first();

        // feature category
        $home_customize = HomeCustomize::first();


        // popular category
        $popular_category_ids = json_decode($home_customize->popular_category, true);
        $popular_category_title = $popular_category_ids['popular_title'];
        $popular_category = [];
        for ($i=1; $i <= 4 ; $i++) {
            if (!in_array($popular_category_ids['category_id' . $i], $popular_category)) {
                if ($popular_category_ids['category_id' . $i]) {
                    $popular_category[] = $popular_category_ids['category_id' . $i];
                }
            }
        }

        foreach ($popular_category as $key => $cat) {
            $popular_categories[] = Category::findOrFail($cat);
        }

        $index = '';
        foreach ($popular_categories as $key => $data) {
            if ($data->id == $popular_category_ids['category_id1']) {
                $index = $key;
            }
        }

        $category = $popular_categories[$index]->id;

        $popular_category_items = Item::when($category, function($query, $category) {
            return $query->where('category_id', $category);
        })
        ->whereStatus(1)->take(10)->orderBy('id', 'desc')->get();
        // popular category end
            $sliders = Slider::where('home_page', 'theme1')->get();

        return view('frontend.index', [
            'banner_first'           => json_decode($home_customize->banner_first, true),
            'sliders'                => $sliders,
            // popular category
            'popular_category_items' => $popular_category_items,
            'popular_categories'     => $popular_categories,
            'popular_category_title' => $popular_category_title,
        ]);

    }
    // ------------ Home End --------------

    // ------------ Extra Index ------------------
    public function extraIndex()
    {
        // feature category
        $home_customize = HomeCustomize::first();
        $feature_category_ids = json_decode($home_customize->feature_category, true);
        $feature_category_title = $feature_category_ids['feature_title'];
        $feature_category = [];
        for ($i=1; $i <= 4 ; $i++) {
            if (!in_array($feature_category_ids['category_id' . $i], $feature_category)) {
                if ($feature_category_ids['category_id' . $i]) {
                    $feature_category[] = $feature_category_ids['category_id' . $i];
                }
            }
        }

        foreach ($feature_category as $key => $cat) {
            $feature_categories[] = Category::findOrFail($cat);
        }

        $index = '';
        foreach ($feature_categories as $key => $data) {
            if ($data->id == $feature_category_ids['category_id1']) {
                $index = $key;
            }
        }

        $category = $feature_categories[$index]->id;

        $feature_category_items = Item::when($category, function($query, $category) {
            return $query->where('category_id', $category);
        })
        ->whereStatus(1)->take(10)->orderBy('id', 'desc')->get();
        // feature category end

        // popular category
        $popular_category_ids = json_decode($home_customize->popular_category, true);
        $popular_category_title = $popular_category_ids['popular_title'];
        $popular_category = [];
        for ($i=1; $i <= 4 ; $i++) {
            if (!in_array($popular_category_ids['category_id' . $i], $popular_category)) {
                if ($popular_category_ids['category_id' . $i]) {
                    $popular_category[] = $popular_category_ids['category_id' . $i];
                }
            }
        }

        foreach ($popular_category as $key => $cat) {
            $popular_categories[] = Category::findOrFail($cat);
        }

        $index = '';
        foreach ($popular_categories as $key => $data) {
            if ($data->id == $popular_category_ids['category_id1']) {
                $index = $key;
            }
        }

        $category = $popular_categories[$index]->id;

        $popular_category_items = Item::when($category, function($query, $category) {
            return $query->where('category_id', $category);
        })
        ->whereStatus(1)->orderBy('id', 'desc')->get();
        // popular category end

        // two column category
        $two_column_category_ids = json_decode($home_customize->two_column_category, true);

        $two_column_category = [];
        for ($i=1; $i <= 2 ; $i++) {
            if (!in_array($two_column_category_ids['category_id' . $i], $two_column_category)) {
                if ($two_column_category_ids['category_id' . $i]) {
                    $two_column_category[] = $two_column_category_ids['category_id' . $i];
                }
            }
        }

        $two_column_categories = Category::whereStatus(1)->whereIn('id', $two_column_category)->orderBy('id', 'desc')->get();

        $two_column_category_items1 = [];
        if ($two_column_category_ids['category_id1']) {
            $two_column_category_items1 = Item::where('category_id', $two_column_category_ids['category_id1'])->orderBy('id', 'desc')->whereStatus(1)->take(10)->get();
        }
        $two_column_category_items2 = [];
        if ($two_column_category_ids['category_id2']) {
            $two_column_category_items2 = Item::where('category_id', $two_column_category_ids['category_id2'])->orderBy('id', 'desc')->whereStatus(1)->take(10)->get();
        }
        // two column category end

        $two_column_categoriess = [];
        foreach ($two_column_categories as $key => $two_category) {
            if ($key == 0) {
                $two_column_categoriess[$key]['name'] = $two_category;
                $two_column_categoriess[$key]['items'] = $two_column_category_items1;
            } else {
                $two_column_categoriess[$key]['name'] = $two_category;
                $two_column_categoriess[$key]['items'] = $two_column_category_items2;
            }
        }

        return view('frontend.extraindex', [
            'campaign_items'         => CampaignItem::with('item')->whereStatus(1)->whereIsFeature(1)->orderBy('id', 'desc')->get(),
            'services'               => Service::orderBy('id', 'desc')->get(),
            'posts'                  => Post::with('category')->orderBy('id', 'desc')->take(8)->get(),
            'brands'                 => Brand::whereStatus(1)->get(),
            'banner_second'          => json_decode($home_customize->banner_secend, true),
            'banner_third'           => json_decode($home_customize->banner_third, true),
            'brands'                 => Brand::whereStatus(1)->whereIsPopular(1)->get(),
            'products'               => Item::with('category')->whereStatus(1),

            // feature category
            'feature_category_items' => $feature_category_items,
            'feature_categories'     => $feature_categories,
            'feature_category_title' => $feature_category_title,

            // popular category
            'popular_category_items' => $popular_category_items,
            'popular_categories'     => $popular_categories,
            'popular_category_title' => $popular_category_title,

            // two column cateogry
            'two_column_categoriess' => $two_column_categoriess
        ]);

    }
    // ------------ Extra Index End --------------


    public function slider_overlay()
    {
        return view('backend.overlay.index');
    }

    public function slider_o_update(Request $request)
    {
        $setting = Setting::first();
        $setting->overlay = $request->slider_overlay;
        $setting->save();
        return redirect()->back();
    }

    // ------------ Extra Index ------------------
    public function product($slug)
    {
        $item = Item::with('category')->whereStatus(1)->whereSlug($slug)->firstOrFail();
        $video = explode('=', $item->video);
        return view('frontend.catalog.product', [
            'item'          => $item,
            'reviews'       => $item->reviews()->where('status', 1)->paginate(3),
            'galleries'     => $item->galleries,
            'video'         => $item->video ? end($video) : '',
            'sec_name'      => json_decode($item->specification_name, true),
            'sec_details'   => json_decode($item->specification_description, true),
            'attributes'    => $item->attributes,
            'related_items' => $item->category->items()->whereStatus(1)->where('id', '!=', $item->id)->take(8)->get()
        ]);
    }
    // ------------ Extra Index End --------------

    // ------------ Brand ------------------
    public function brands()
    {
        if (Setting::first()->is_brands == 0) {
            return back();
        }
        return view('frontend.brand', [
            'brands' => Brand::whereStatus(1)->get()
        ]);
    }
    // ------------ Brand End ------------------

    // ------------ FAQ ------------------
    public function faq()
    {
        if (Setting::first()->is_faq == 0) {
            return back();
        }
        $fcategories = Fcategory::whereStatus(1)->withCount('faqs')->latest('id')->get();
        return view('frontend.faq.index', [
            'fcategories' => $fcategories
        ]);
    }

    public function faqDetails($slug)
    {
        if (Setting::first()->is_faq == 0) {
            return back();
        }
        $category = Fcategory::whereSlug($slug)->first();
        return view('frontend.faq.show', [
            'category' => $category
        ]);
    }

    // ------------ FAQ End ------------------

    // ------------ Page ------------------
    public function page($slug)
    {
        return view('frontend.page', [
            'page' => $this->repository->displayPage($slug)
        ]);
    }
    // ------------ Page End --------------

    // ------------ Contact --------------
    public function contact()
    {
        if (Setting::first()->is_contact == 0) {
            return back();
        }
        return view('frontend.contact');
    }

    public function contactEmail(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name'  => 'required|max:50',
            'email'      => 'required|max:50',
            'phone'      => 'required|max:50',
            'message'    => 'required|max:250'
        ]);
        $input = $request->all();

        $setting = Setting::first();
        $name = $input['first_name'] . ' ' . $input['last_name'];
        $subject = "Email From " . $name;
        $to = $setting->contact_email;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: " . $name . "<br/>Email: " . $from . "<br/>Phone: " . $phone . "<br/>Message: " . $request->message;

        $emailData = [
            'to'      => $to,
            'subject' => $subject,
            'body'    => $msg
        ];

        $email = new EmailHelper();
        $email->sendCustomMail($emailData);
        return redirect()->back()->with('success', __('Thank you for contacting with us, we will get back to you shortly.'));
    }
    // ------------ Contact End ----------

    // ------------ Track Order ----------
    public function trackOrder()
    {
        return view('frontend.track_order');
    }

    public function track(Request $request)
    {
        $order = Order::where('transaction_number', $request->order_number)->first();
        if ($order) {
            return view('user.order.track', [
                'numbers' => 3,
                'track_orders' => TrackOrder::whereOrderId($order->id)->get()->toArray()
            ]);
        } else {
            return view('user.order.track', [
                'numbers' => 3,
                'error'   => 1
            ]);
        }

    }
    // ------------ Track Order End ------

    /**
     * Redirect to Maintainance Page.
    */
    public function maintenance()
    {
        $setting = Setting::first();
        if($setting->is_maintainance == 0) return redirect()->route('frontend.index');
        return view('frontend.maintenance');
    }
}
