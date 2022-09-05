<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\ExtraSetting;
use App\Models\Language;
use App\Models\Setting;
use App\Repositories\Backend\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @return void
    */
    public function __construct(SettingRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }

    /**
     * Show the form updating resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function system()
    {
        return view('backend.settings.system');
    }

    /**
     * Show the form for updating resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function menu()
    {
        return view('backend.settings.menu');
    }

    /**
     * Show the form for updating resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function language()
    {
        $data = Language::first();
        $data_results = file_get_contents(resource_path(). '/lang/' . $data->file );
        $lang = json_decode($data_results, true);
        return view('backend.settings.language', compact('data', 'lang'));
    }

    /**
     * Show the form for updating resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function social()
    {
        return view('backend.settings.social', [
            'google_url'   => url('/auth/google/callback'),
            'facebook_url' => preg_replace("/^http:/i", "https:", url('/auth/facebook/callback'))
        ]);
    }

    /**
     * Update the specified resource in stoage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function update(SettingRequest $request)
    {
        $this->repository->update($request);
        return redirect()->back()->withSuccess(__('Data Updated Successfully.'));
    }

    public function section()
    {
        return view('backend.settings.section');
    }

    public function visible(Request $request)
    {
        $fields = ['is_slider','is_three_c_b_first','is_popular_category','is_three_c_b_second','is_highlighted','is_two_column_category','is_popular_brand','is_featured_category','is_two_c_b','is_blogs','is_service','is_t2_slider','is_t2_service_section','is_t2_3_column_banner_first','is_t2_flashdeal','is_t2_new_product','is_t2_3_column_banner_second','is_t2_featured_product','is_t2_bestseller_product','is_t2_toprated_product','is_t2_2_column_banner','is_t2_blog_section','is_t2_brand_section','is_t3_slider','is_t3_service_section','is_t3_3_column_banner_first','is_t3_popular_category','is_t3_flashdeal','is_t3_3_column_banner_second','is_t3_pecialpick','is_t3_brand_section','is_t3_2_column_banner','is_t3_blog_section','is_t4_slider','is_t4_featured_banner','is_t4_specialpick','is_t4_3_column_banner_first','is_t4_flashdeal','is_t4_3_column_banner_second','is_t4_popular_category','is_t4_2_column_banner','is_t4_blog_section','is_t4_brand_section','is_t4_service_section'];

        $extrasetting = ExtraSetting::first();
        $setting = Setting::first();
        foreach ($fields as $field) {
            if($request->has($field)){
                $setting_input[$field] = 1;
                $input[$field] = 1;
            }else{
                if($this->checkVisibilityUrl(url()->previous())){
                 $input[$field] = 0;
                 $setting_input[$field] = 0;
                }
            }
        }

        $extrasetting->update($input);
        $setting->update($setting_input);

        return redirect()->back()->withSuccess(__('Data Updated Successfully.'));
    }

    public function checkVisibilityUrl($url)
    {
        $segment = explode('/', url()->previous());
        $value = end($segment);
        if ($value == 'section') {
            return true;
        } else {
            return false;
        }
    }

    public function announcement()
    {
        return view('backend.settings.announcement');
    }

    public function maintenance()
    {
        return view('backend.settings.maintenance');
    }
}
