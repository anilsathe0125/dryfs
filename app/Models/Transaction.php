<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [ 'order_id', 'amount', 'emial', 'txn_id', 'currency_sign', 'currency_value' ];

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
        return $this->belongsTo(User::class, 'email', 'user_email')->withDefault();
    }
}
