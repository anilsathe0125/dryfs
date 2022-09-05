<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [ 'category_id', 'brand_id', 'name', 'slug' ,'sku', 'tags', 'video', 'short_details', 'specification_name', 'specification_description', 'is_specification', 'details', 'photo', 'thumbnail', 'discount_price', 'previous_price', 'stock', 'meta_keywords', 'meta_description', 'status', 'is_type', 'tax_id', 'date', 'item_type', 'file', 'link', 'file_type', 'license_name', 'license_key' ];

    /**
     * Category
    */
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    /**
     * Brand
    */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Campaigns
    */
    public function campaigns()
    {
        return $this->hasMany(CampaignItem::class);
    }

    /**
     * Tax
    */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * Attributes
    */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    /**
     * Galleries
    */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Reviews
    */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Tax Calculation
    */
    public function taxCalculate($item)
    {
        if ($item->tax) {
            $price = $item->discount_price;
            $percentage = $item->tax->value;
            $tax = ( $price * $percentage ) / 100;
            return $tax;
        } else {
            return 0;
        }
    }

    /**
     * User / Vendor
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id')->withDefault();
    }

    /**
     * Stock Status
    */
    public function is_stock()
    {
        $item = $this;

        // license product stock check------------

        if ($item->item_type == 'license') {
            if ($item->license_key) {
                $license_key = json_decode($item->license_key, true);
                if (count($license_key) > 0) {
                    return true;
                } else {
                    return false;
                }

            } else {
                return false;
            }
        }

        // digital product stock check-------------

        if ($item->item_type == 'digital') {
            return true;
        }

        // physical product stock check----------

        if ($item->item_type == 'normal') {
            if ($item->stock) {
                if ($item->stock != 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }
    }

    /**
     * return wishlist id
     *
     * @return \Illuminate\Http\Response
    */
    public function getWishlistItemId()
    {
        return Wishlist::whereItemId($this->id)->first()->id;
    }
}
