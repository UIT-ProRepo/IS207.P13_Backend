<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',  'shipping_provider_id',
        'address_id', 'order_date', 'total_price',
        'note', 'payment_method', 'delivery_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingProvider()
    {
        return $this->belongsTo(ShippingProvider::class, 'shipping_provider_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Kiểm tra nếu trạng thái đơn hàng là 'Pending'.
     */
    public function isPending()
    {
        return $this->delivery_status === 'Pending';
    }

    /**
     * Cập nhật trạng thái đơn hàng thành 'Fail'.
     */
    public function markAsFailed()
    {
        if ($this->isPending()) {
            $this->update(['delivery_status' => 'Fail']);
            return true;
        }
        return false;
    }
}
