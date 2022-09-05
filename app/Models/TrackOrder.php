<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order_id'
    ];

    /**
     * Order
    */
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }
}
