<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['province', 'district', 'ward', 'detail'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_addresses');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
