<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'min_order_value',
        'max_discount',
        'start_date',
        'end_date',
        'usage_limit',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function order(){
        return $this->hasMany(Order::class, 'coupon_id');
    }

    public function isValid()
    {
        $now = Carbon::now();

        return $this->status === 'active'
            && $this->start_date <= $now
            && $this->end_date >= $now
            && ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function calculateDiscount($total)
    {
        $discount = 0;

        if ($this->discount_type === 'percent') {
            $discount = $total * ($this->discount_value / 100);
        } elseif ($this->discount_type === 'fixed') {
            $discount = $this->discount_value;
        }

        if ($this->max_discount) {
            $discount = min($discount, $this->max_discount);
        }

        return $discount;
    }
}
