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

    public function getStatusLabelAttribute()
    {
        return $this->status === 'active' ? 'Kích hoạt' : 'Tạm ngừng';
    }
    
    public function orderShipping() {
        return $this->hasMany(OrderShipping::class);
    }
}
