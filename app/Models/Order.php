<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'shop_id', 'shipping_provider_id',
        'address_id', 'order_date', 'total_price',
        'note', 'payment_method', 'delivery_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingProvider()
    {
        return $this->belongsTo(ShippingProvider::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
