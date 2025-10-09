<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'province',
        'district',
        'ward',
        'address_detail',
        'is_default'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderShipping() {
        return $this->hasMany(OrderShipping::class);
    }
}
