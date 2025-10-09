<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'user_id',
        'price',
        'stock',
        'sold',
        'description',
        'status',
        'average_rating',
        'total_review'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class);
    }

    public function orderItems() {
        return $this->hasMany(orderItem::class);
    }
}
