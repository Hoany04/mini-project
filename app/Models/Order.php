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

    public function shippingMethod()
    {
        return $this->hasOneThrough(
            ShippingMethod::class,
            OrderShipping::class,
            'order_id',
            'id',
            'id',
            'shipping_method_id'
        );
    }

    public function getShippingTimeline()
    {
        $timeline = [
            'pending'   => 1, // Đã đặt
            'shipped'  => 2, // Đang giao
            'completed' => 3, // Đã giao
            'cancelled' => 0,
        ];

        return $timeline[$this->status] ?? 0;
    }

}
