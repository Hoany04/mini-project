<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_price', 'coupon_id', 'discount',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items(){
        return $this->hasMany(CartItem::class);
    }
    public function total()
    {
        return $this->items->sum(fn($item) => $item->price * $item->quantity);
    }
}
