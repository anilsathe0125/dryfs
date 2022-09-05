<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'item_id', 'review', 'rating', 'status', 'subject' ];

    /**
     * User
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Item/Product
    */
    public function item()
    {
        return $this->belongsTo(Item::class)->withDefault();
    }

    /**
     * Ratings
    */
    public function ratings($item_id)
    {
        $stars = Review::whereStatus(1)->whereItemId($item_id)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '') * 20;
        return $ratings;
    }
}
