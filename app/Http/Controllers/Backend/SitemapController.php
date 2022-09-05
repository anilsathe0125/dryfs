<?php

namespace App\Http\Controllers\Backend;

use App\Models\Sitemap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * Setting Authentication
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.settings.sitemap.index', [
            'datas' => Sitemap::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.settings.sitemap.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sitemap = new Sitemap();
        $input = $request->all();

        if (!file_exists('uploads/sitemaps')) {
            mkdir(public_path('uploads/sitemaps'), 0777, true);
        }
        $filename = 'sitemap' . uniqid() . 'xml';
        SitemapGenerator::create($request->sitemap_url)->writeToFile('uploads/sitemaps/' . $filename);
        $input['filename'] = $filename;
        $input['sitemap_url'] = $request->sitemap_url;
        $sitemap->fill($input)->save();
        return redirect()->route('backend.sitemap.index')->withSuccess(__('Sitemap Generate Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sitemap = Sitemap::findOrFail($id);
        unlink('uploads/sitemaps/' . $sitemap->filename);
        $sitemap->delete();
        return redirect()->back()->withSuccess(__('Sitemap file deleted successfully!'));
    }

    /**
     * Download the specified Sitemap.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function download(Request $request)
    {
        return response()->download('uploads/sitemaps/' . $request->filename);
    }
}
