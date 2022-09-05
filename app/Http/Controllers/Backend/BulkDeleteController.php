<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Post;
use App\Models\Transaction;
use App\Repositories\Backend\ItemRepository;
use Illuminate\Http\Request;

class BulkDeleteController extends Controller
{
    /**
     * Create a new controller instance.
     * Setting Authentication
     * @return void
    */
    public function bulkDelete(Request $request)
    {
        $ids = array_filter($request->ids);

        if (!$ids || !$request->table) {
           return redirect()->back()->withError(__('Selected is empty.'));
        }

        $ids = explode(',', $ids[0]);

        // Bulk Delete Items
        if ($request->table == 'items') {
            $itemRepository = new ItemRepository();
            foreach ($ids as $id) {
                $id = (int)$id;
                $item = Item::findOrFail($id);
                $itemRepository->delete($item);
            }
        }

        // Bulk Delete Transactions
        if ($request->table == 'transactions') {
            foreach ($ids as $id) {
                $id = (int)$id;
                Transaction::findOrFail($id)->delete();
            }
        }

        // Bulk Delete Posts
        if ($request->table == 'posts') {
            foreach ($ids as $id) {
                $id = (int)$id;
                $post = Post::findOrFail($id);
                $images = json_decode($post->photo, true);
                foreach ($images as $image) {
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $post->delete();
            }
        }

        // Bulk Delete Orders
        if ($request->table == 'orders') {
            foreach ($ids as $id) {
                $id = (int)$id;
                $order = Order::findOrFail($id);
                $order->transaction->delete();
                if (Notification::where('order_id', $id)->exists()) {
                    Notification::where('order_id', $id)->delete();
                }
                if (count($order->tracks_data) > 0) {
                    foreach ($order->tracks_data as $track) {
                        $track->delete();
                    }
                }
                $order->delete();
            }
        }

        return redirect()->back()->withSuccess(__('Data Deleted Successfully.'));
    }
}
