<?php

namespace App\Models;

use App\Enums\PaymentMethodStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => PaymentMethodStatus::class,
    ];

    public function transactions() {
        return $this->hasMany(PaymentTransaction::class);
    }
}
