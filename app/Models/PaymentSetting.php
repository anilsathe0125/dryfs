<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'type', 'information', 'unique_kekyword', 'status', 'photo', 'text' ];

    public function convertJsonData()
    {
        return json_decode($this->information, true);
    }
}
