<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CsvProductController extends Controller
{

    /**
     * Show the form for bulk creating new resources
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.item.bulk-upload');
    }

    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=product_csv_export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $lists = Item::all()->toArray();
        $new_list = [];
        foreach ($lists as $list) {
            $list['photo'] = asset($list['photo']);
            $list['slug'] = Str::random(3) . $list['slug'] . Str::random(2);
            $list['category'] = Category::findOrFail($list['category_id'])->name;
            $list['brand'] = $list['brand_id'] ? Brand::findOrFail($list['brand_id'])->name : '';
            unset($list['category_id']);
            unset($list['brand_id']);
            $new_list[] = $list;
        }

        # add headers for each column in the CSV download
        array_unshift($new_list, array_keys($new_list[0]));

        $callback = function() use ($new_list) {
            $FH = fopen('php://output', 'w');
            foreach ($new_list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function transactionExport()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=transactions_csv_export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $lists = Transaction::all()->toArray();
        $new_list = [];
        foreach ($lists as $list) {
            $new_list[] = $list;
        }

        # add headers for each column in the CSV download
        $callback = function() use ($new_list) {
            $FH = fopen('php://output', 'w');
            foreach ($new_list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function orderExport()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=orders_csv_export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $lists = Order::all()->toArray();
        $new_list = [];
        foreach ($lists as $list) {
            $new_list[] = $list;
        }

        # add headers for each column in the CSV download
        $callback = function() use ($new_list) {
            $FH = fopen('php://output', 'w');
            foreach ($new_list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Import bulk items and store into storage.
     *
     * @param \Illuminate\Http\Request $request
    */
    public function import(Request $request)
    {
        try {
            $filename = '';
            if ($file = $request->file('csv')) {
                $filename = time() . '-' . $file->getClientOriginalExtension();
                $file->move('uploads/temp_files',$filename);
            }
            $file = fopen(public_path('uploads/temp_files/' . $filename), "r");
            $i= 1;
            while (($line = fgetcsv($file)) !== FALSE) {
                if ($i != 1) {
                    $category_id = $line[30] ? (Category::whereName($line[31])->exists() ? Category::whereName($line[31])->first()->id : 0) : 0;
                    $brand_id = $line[33] ? (Brand::whereName($line[33])->exists() ? Brand::whereName($line[33])->first()->id : 0) : 0;

                    $input['category_id'] = $category_id;
                   $input['brand_id'] = $brand_id;
                   $input['tax_id'] = $line[1];
                   $input['name'] = $line[2];
                   $input['slug'] = $line[3];
                   $input['sku'] = $line[4];
                   $input['tags'] = $line[5];
                   $input['video'] = $line[6];
                   $input['sort_details'] = $line[7];
                   $input['specification_name'] = $line[8];
                   $input['specification_description'] = $line[9];
                   $input['is_specification'] = $line[10];
                   $input['details'] = $line[11];
                   $input['discount_price'] = $line[13];
                   $input['previous_price'] = $line[14];
                   $input['stock'] = $line[15];
                   $input['meta_keywords'] = $line[16];
                   $input['meta_description'] = $line[17];
                   $input['status'] = $line[18];
                   $input['is_type'] = $line[19];
                   $input['date'] = $line[20];
                   $input['file'] = $line[21];
                   $input['link'] = $line[22];
                   $input['file_type'] = $line[23] ? $line[23] : null;
                   $input['license_name'] = $line[26];
                   $input['license_key'] = $line[27];
                   $input['item_type'] = $line[28];
                   $input['thumbnail'] = $line[29];

                   $image_url = $line[12];
                   $ch = curl_init();
                   curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                   curl_setopt ($ch, CURLOPT_URL, $image_url);
                   curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
                   curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                   curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
                   curl_setopt($ch, CURLOPT_HEADER, true);
                   curl_setopt($ch, CURLOPT_NOBODY, true);
                   $content = curl_exec ($ch);
                   $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
                   if (!file_exists('uploads/items')) {
                    mkdir(public_path('uploads/items'), 0777, true);
                   }
                   $fimg = Image::make($line[16])->resize(800,800);
                   $fphoto = microtime().Str::random(8).'.jpg';
                   $fimg->save(public_path().'/assets/images/'.$fphoto);
                   $input['photo']  = $fphoto;

                   $data = new Item();
                   $data->fill($input)->save();

                }
                $i++;
            }
            fclose($file);

            $removefiles = glob(public_path().'/uploads/temp_files/*');

            foreach ($removefiles as $file) {
                if(is_file($file))
                unlink($file);
            }

            return redirect()->back()->withSuccess(__('Bulk Product File Imported Successfully.'));

        } catch (\Throwable $th) {
            return redirect()->back()->withError(__('Something is wrong!'));
        }
    }
}
