<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug','details', 'photo', 'category_id','tags','meta_keywords','meta_descriptions'];

    /**
     * Category
    */
    public function category()
    {
        return $this->belongsTo(Bcategory::class, 'category_id', 'id')->withDefault();
    }
}
