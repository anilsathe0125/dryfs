<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [ 'name', 'slug', 'photo', 'status', 'is_featured', 'meta_keywords', 'meta_descriptions', 'serial' ];

    /**
     * Products / Items
    */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
