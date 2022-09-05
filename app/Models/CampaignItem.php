<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignItem extends Model
{
    use HasFactory;

    protected $fillable = [ 'item_id', 'status', 'is_feature' ];

    /**
     * Product/Item
    */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
