<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCustomize extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_first',
        'banner_second',
        'banner_third',
        'popular_category',
        'two_column_category',
        'feature_category',
        'home_page4',
        'home_4_popular_category'
    ];
}
