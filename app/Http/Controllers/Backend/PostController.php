<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Bcategory;
use App\Models\Post;
use App\Repositories\Backend\PostRepository;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @param \App\Repositories\Backend\PostRepository $repository
     * @return void
    */
    public function __construct(PostRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.post.index', [
            'datas' => Post::with('category')->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post.create', [
            'categories' => Bcategory::whereStatus(1)->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $this->repository->store($request);
        return redirect()->route('backend.post.index')->withSuccess(__('New Post Added Successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit', [
            'categories' => Bcategory::whereStatus(1)->orderBy('id', 'desc')->get(),
            'post'       => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->repository->update($post, $request);
        return redirect()->route('backend.post.index')->withSuccess(__('Post Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->repository->delete($post);
        return redirect()->route('backend.post.index')->withSuccess(__('Post Deleted Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $key
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePhoto($key, $id)
    {
        $this->repository->photoDelete($key, $id);
        return redirect()->back()->withSuccess(__('Photo Deleted Successfully'));
    }
}
