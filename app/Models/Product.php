<?php

namespace App\Models;
use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use HasFactory, LogsActivity;

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

    public function getAverageRatingAttribute()
    {
        if ($this->reviews()->count() == 0) {
            return 0;
        }

        return round($this->reviews()
            ->avg('rating'), 1);
    }

    public function getTotalApprovedReviewsAttribute()
    {
        return $this->reviews()->count();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
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
