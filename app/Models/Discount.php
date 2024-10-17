<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'product_id', 'is_percent', 'amount', 'from_date', 'to_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
