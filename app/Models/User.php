<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'photo',
        'email_token',
        'ship_address1',
        'ship_address2',
        'ship_zip',
        'ship_city',
        'ship_country',
        'ship_company',
        'bill_address1',
        'bill_address2',
        'bill_zip',
        'bill_city',
        'bill_country',
        'bill_company',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Products (If user is vendor)
    */
    public function products()
    {
        return $this->hasMany(Item::class, 'vendor_id')->orderBy('id', 'desc');
    }

    /**
     * Orders (Places by user/customer)
    */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Wishlist (of user/customer)
    */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Reviews (submitted by user/customer)
    */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Notifications
    */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Social Providers
    */
    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    /**
     * Withdraws (made by vendor)
    */
    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'vendor_id')->orderBy('id', 'desc');
    }

    /**
     * Display Name
    */
    public function displayName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Wishlist Count
    */
    public function wishlistCount()
    {
        return $this->wishlists()->whereHas('item', function($query) {
                    $query->where('status', '=', 1);
                })->count();
    }
}
