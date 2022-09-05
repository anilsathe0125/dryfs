<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fcategory extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'slug', 'text', 'status', 'meta_keywords', 'meta_descriptions' ];

    /**
     * FAQ's
    */
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id', 'id');
    }
}
