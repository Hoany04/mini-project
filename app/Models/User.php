<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    const ROLE_ADMIN = 'Admin';

    const ROLE_USER = 'Customer';

    protected $fillable = [
        'username', 'email', 'password', 'role_id', 'status'
    ];

    protected $hidden = ['password', 'remeber_token'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
