<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method_id',
        'amount',
        'transaction_code',
        'status'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function method() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
