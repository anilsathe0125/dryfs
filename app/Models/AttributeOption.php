<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    protected $fillable = [ 'attribute_id', 'name', 'keyword', 'price' ];

    /**
     * Attribute
    */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class)->withDefault();
    }
}
