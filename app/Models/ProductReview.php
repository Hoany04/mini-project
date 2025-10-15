<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'created_at'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    // Cập nhật lại điểm trung bình và tổng review của sản phẩm
    protected static function booted()
    {
        static::saved(function ($review) {
            $review->updateProductRating();
        });

        static::deleted(function ($review) {
            $review->updateProductRating();
        });
    }

    public function updateProductRating()
    {
        $product = $this->product;
        $average = $product->reviews()->avg('rating') ?? 0;
        $count = $product->reviews()->count();

        $product->update([
            'average_rating' => round($average, 2),
            'total_review' => $count,
        ]);
    }
}
