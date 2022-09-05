<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.review.index', [
            'datas' => Review::latest('id')->get()
        ]);
    }

    /**
     * Dispaly the specified Source
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function show(Review $review)
    {
        return view('backend.review.show', compact('review'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param int $id
     * @param int $status
     * @return \Illuminate\Http\Response
    */
    public function status($id, $status)
    {
        Review::findOrFail($id)->update([ 'status' => $status ]);
        return redirect()->route('backend.review.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('backend.review.index')->withSuccess(__('Review Deleted Successfully.'));
    }
}
