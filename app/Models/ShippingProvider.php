<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingProvider extends Model
{
    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
