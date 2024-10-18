<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email', 'hashed_password', 'phone',
        'full_name', 'date_of_birth', 'gender', 'role'
    ];

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'user_addresses');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function cartProducts()
    {
        return $this->belongsToMany(Product::class, 'user_cart_products')
                    ->withPivot('quantity');
    }
}
