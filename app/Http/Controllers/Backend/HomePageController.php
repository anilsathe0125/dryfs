<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCustomize;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $data = HomeCustomize::first();
        return view('backend.homepage.index', [
            'first_banner' => json_decode($data->banner_first, true),
        ]);
    }


    public function firstBannerUpdate(Request $request)
    {
        $request->validate([
            'img1'      => 'image',
            'img2'      => 'image',
            'img3'      => 'image',
            'firsturl1' => 'required|max:200',
            'firsturl2' => 'required|max:200',
            'firsturl3' => 'required|max:200',
        ]);

        $all_images_names = [ 'img1', 'img2', 'img3' ];
        $input = $request->all();
        foreach ($all_images_names as $single_image) {
            if ($request->hasFile($single_image)) {
                $data = HomeCustomize::first();
                $check = json_decode($data->banner_first, true);
                $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image, 'uploads/banners', $check[$single_image]);
            }
        }

        unset($input['_token']);
        $data = HomeCustomize::first();

        foreach (json_decode($data->banner_first, true) as $key => $value) {
            if (isset($input[$key])) {
                $input[$key] = $input[$key];
            } else {
                $input[$key] = $value;
            }
        }

        $data->banner_first = json_encode($input, true);
        $data->update();
        return redirect()->back()->withSuccess(__('Banner Update Successfully.'));
    }
}
