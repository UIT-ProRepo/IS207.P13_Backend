<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'comment', 'rating', 'is_approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->rating < 1 || $model->rating > 5) {
                throw new \InvalidArgumentException("Rating must be between 1 and 5.");
            }
        });
    }
}
