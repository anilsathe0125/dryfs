<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'provider_id', 'provider' ];

    /**
     * User
    */
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
