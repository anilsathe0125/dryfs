<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bcategory extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'slug', 'status' ];

    /**
     * Posts
    */
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
