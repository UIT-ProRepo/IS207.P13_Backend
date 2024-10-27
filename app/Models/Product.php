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
        'quantity'
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

    public function getDiscountedPriceAttribute()
    {
        // Lấy mã giảm giá hiện tại, giả sử chỉ lấy mã giảm giá có hiệu lực hiện tại
        $discount = $this->discounts()
            ->where('from_date', '<=', now())
            ->where('to_date', '>=', now())
            ->first();

        // Nếu không có mã giảm giá thì trả về giá gốc
        if (!$discount) {
            return $this->unit_price;
        }

        // Tính giá sau khi áp dụng giảm giá
        if ($discount->is_percent) {
            return $this->unit_price * (1 - $discount->amount / 100);
        } else {
            return max(0, $this->unit_price - $discount->amount);
        }
    }
}
