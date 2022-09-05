<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [ 'subject', 'user_id', 'file', 'message', 'status' ];

    /**
     * Messages
    */
    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    /**
     * Last Message
    */
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    /**
     * User
    */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }
}
