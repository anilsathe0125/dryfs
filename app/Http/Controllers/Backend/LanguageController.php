<?php

namespace App\Http\Controllers\Backend;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
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
        return view('backend.language.index', [
            'datas' => Language::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $data = Language::first();
        $data_results = file_get_contents(resource_path() . '/lang/' . $data->file);
        $lang = json_decode($data_results, true);
        return view('backend.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|unique:languages,language'
        ]);
        $new = null;
        $input = $request->all();
        $data = new Language();
        $nam = time() . Str::random(8);
        $data->name = time() . Str::random(8);
        $data->language = $request->language;
        $data->file = $nam . '.json';
        $data->save();

        $language = Language::findOrFail(1)->file;
        $string = file_get_contents(resource_path() . '/lang/' . $language);
        $languages = json_decode($string, true);
        foreach ($languages as $key => $value) {
            $n = str_replace("_", " ", $key);
            $new[$n] = $value;
        }
        $mydata = json_encode($new);
        file_put_contents(resource_path() . '/lang/' . $data->file, $mydata);
        return redirect()->route('backend.language.index')->withSuccess(__('Language Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $data = Language::findOrFail($id);
        $data_results = file_get_contents(resource_path() . '/lang/' . $data->file);
        $lang = json_decode($data_results, true);
        return view('backend.language.edit', compact('data', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'language' => 'required|unique:languages,language,' . $id
        ]);
        $new = null;
        $input = $request->all();
        $data = Language::findOrFail($id);
        if (file_exists(resource_path() . '/lang/' . $data->file)) {
            unlink(resource_path() . '/lang/' . $data->file);
        }
        $nam = time() . Str::random(8);
        $data->name = time() . Str::random(8);
        $data->language = $request->language;
        $data->file = $nam . '.json';
        $data->update();

        $keys = $request->keys;
        $values = $request->values;
        foreach (array_combine($keys, $values) as $key => $value) {
            $n = str_replace("_", " ", $key);
            $new[$n] = $value;
        }
        $mydata = json_encode($new);
        file_put_contents(resource_path() . '/lang/' . $data->file, $mydata);
        return redirect()->route('backend.language.index')->withSuccess(__('Language Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $data = Language::findOrFail($id);
        if (file_exists(resource_path() . '/lang/' . $data->file)) {
            unlink(resource_path() . '/lang/' . $data->file);
        }
        $data->delete();
        return redirect()->back()->withSuccess(__('Language Delete Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
    */
    public function status($id, $status)
    {
        $data = Language::findOrFail($id);
        $get = Language::get();

        if ($status == 1) {
            foreach ($get as $lang) {
                $lang->is_default = 0;
                $lang->update();
            }
        }

        if ($status == 0) {
            foreach ($get as $lang) {
                $lang->is_default = 1;
                $lang->update();
            }
        }

        $data = Language::findOrFail($id);
        $data->is_default = $status;
        $data->update();
        return redirect()->route('backend.language.index')->withSuccess(__('Language Updated Successfully.'));
    }
}
