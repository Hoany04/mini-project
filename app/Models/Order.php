<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coupon_id',
        'total_amount',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(orderItem::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function paymentTransactions(){
        return $this->hasMany(PaymentTransaction::class, 'order_id');
    }

    public function shipping() {
        return $this->hasOne(OrderShipping::class);
    }
}
