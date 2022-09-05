<?php

namespace App\Repositories\Frontend;

use App\Helpers\PriceHelper;
use App\Models\Page;
use App\Models\Post;
use App\Models\Order;
use App\Models\Bcategory;
use Illuminate\Support\Facades\Auth;


class FrontRepository{

    public function displayPosts($request)
    {
        if ($request->has('category')) {
            return Post::with('category')->whereCategoryId(Bcategory::where('slug', $request->category)->firstOrFail()->id)->orderBy('id', 'desc')->paginate(6);
        }
        elseif ($request->has('search')) {
            return Post::with('category')->where('title', 'like', '%' . $request->search . '%')->orWhere('details', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(6);
        }
        elseif ($request->has('tag')) {
            return Post::with('category')->where('tags', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(6);
        }
        else {
            return Post::with('category')->orderBy('id', 'desc')->paginate(6);
        }
    }

    public function displayPost($slug)
    {
        $tagz = '';
        $tags = null;
        $names = Post::pluck('tags')->toArray();
        foreach ($names as $name) {
            $tagz .= $name . ',';
        }

        $tags = array_unique(explode(',', $tagz));
        return [
            'posts'      => Post::orderBy('id', 'desc')->take(4)->get(),
            'post'       => Post::whereSlug($slug)->firstOrFail(),
            'categories' => Bcategory::withCount('posts')->whereStatus(1)->get(),
            'tags'       => array_filter($tags)
        ];
    }

    public function displayPage($slug)
    {
        return Page::whereSlug($slug)->firstOrFail();
    }

    public function reviewSubmit($request)
    {
        $user = Auth::user();
        if (count($user->reviews->where('item_id', $request->item_id)) > 0) {
            $data['item_id'] = $request->item_id;
            $data['subject'] = $request->subject;
            $data['rating'] = $request->rating;
            $data['review'] = $request->review;
            $user->reviews()->update($data);
            return __('Your Review Updated Successfully.');
        }

        $orders = Order::where('user_id', $user->id)->get();
        $ck = 0;
        foreach ($orders as $order) {
            $cart = json_decode($order->cart, true);
            foreach ($cart as $key => $product) {
                if ($request->item_id == PriceHelper::getItemId($key)) {
                    $ck = 1;
                    break;
                }
            }
        }

        if ($ck == 0) {
            return [
                'errors' => [
                    0 => __('Buy This Product First')
                ]
            ];
        }

        $user->reviews()->create($request->all());
        return __('Your Review Has Been Submitted Successfully.');
    }
}
