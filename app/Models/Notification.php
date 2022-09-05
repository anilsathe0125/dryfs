<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [ 'order_id', 'user_id' ];

    /**
     * Order
    */
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    /**
     * User
    */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Count Registration
    */
    public function countRegistration()
    {
        return Notification::where('user_id', '!=', null)->where('is_read', '=', 0)->count();
    }

    /**
     * Count Order
    */
    public function countOrder()
    {
        return Notification::where('order_id', '!=', null)->where('is_read', '=', 0)->count();
    }
}
