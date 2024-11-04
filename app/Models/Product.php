<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Product extends Model
{

    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'unit_price',
        'is_deleted',
        'description',
        'image_url',
        'quantity',
    ];

    public function getFormattedPriceAttribute()
    {
        $formatter = new NumberFormatter('vi_VN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->unit_price, 'VND');
    }
    
    public function getFormattedDiscountedPriceAttribute()
    {
        $formatter = new NumberFormatter('vi_VN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->discounted_price, 'VND');
    }


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function getDiscountedPriceAttribute()
    {

        $discount = $this->discounts()
            ->where('from_date', '<=', now())
            ->where('to_date', '>=', now())
            ->first();

        if (!$discount) {
            return $this->unit_price;
        }

        if ($discount->is_percent) {
            return $this->unit_price * (1 - $discount->amount / 100);
        } else {
            return max(0, $this->unit_price - $discount->amount);
        }
    }

    public function scopeOrderByPrice($query, $direction = 'asc')
    {
        return $query->orderBy('unit_price', $direction);
    }
   
    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeOrderByCreatedAt($query, $direction = 'asc')
    {
        return $query->orderBy('created_at', $direction);
    }
}
