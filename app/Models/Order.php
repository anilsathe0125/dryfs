<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_info',
        'cart',
        'shipping',
        'discount',
        'payment_method',
        'txnid',
        'charge_id',
        'transaction_number',
        'order_status',
        'payment_status',
        'shipping_info',
        'billing_info',
        'currency_sign',
        'currency_value',
        'tax'
    ];

    /**
     * User
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tracks
    */
    public function tracks()
    {
        return $this->belongsTo(TrackOrder::class, 'order_id')->withDefault();
    }

    /**
     * Transaction
    */
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'order_id')->withDefault();
    }

    /**
     * Tracks Data
    */
    public function tracks_data()
    {
        return $this->hasMany(TrackOrder::class, 'order_id');
    }

    /**
     * Notification
    */
    public function notification()
    {
        return $this->hasMany(Notification::class, 'order_id');
    }
}
