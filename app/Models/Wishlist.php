<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'item_id' ];

    /**
     * User/Customer
    */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Item/Product
    */
    public function item()
    {
        return $this->belongsTo(Item::class)->withDefault();
    }

    /**
     * Return wishlist ID
     *
     * @param int $item_id
     * @return \Illuminate\Http\Response
    */
    public function getWishlistItemId($item_id)
    {
        return Wishlist::whereItemId($item_id)->first()->id;
    }
}
