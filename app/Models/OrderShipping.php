<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shipping_method_id',
        'shipping_address_id',
        'tracking_number',
        'delivery_note',
        'status',
        'shipped_at',
        'delivered_at'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function method() {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function address() {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id');
    }
}
