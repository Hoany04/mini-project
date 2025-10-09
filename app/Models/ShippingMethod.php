<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fee',
        'status'
    ];

    public function orderShipping() {
        return $this->hasMany(OrderShipping::class);
    }
}
