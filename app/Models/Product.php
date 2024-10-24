<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Product extends Model
{
    protected $fillable = [
        'shop_id', 'category_id', 'name', 'unit_price',
        'is_deleted', 'description', 'image_url', 'quantity'
    ];

     // Phương thức để định dạng giá
    public function getFormattedPriceAttribute()
    {
        $formatter = new NumberFormatter('vi_VN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->unit_price, 'VND');
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
}
