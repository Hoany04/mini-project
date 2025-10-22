<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_name',
        'variant_value',
        'extra_price',
        'stock'
    ];

    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::saved(function ($variant) {
            $variant->updateProductStock();
        });

        static::deleted(function ($variant) {
            $variant->updateProductStock();
        });
    }

    public function updateProductStock()
    {
        $totalStock = $this->product->variants()->sum('stock');
        $this->product->update(['stock' => $totalStock]);
    }
}
