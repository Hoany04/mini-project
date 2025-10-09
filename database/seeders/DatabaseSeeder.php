<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            UserProfileSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
            PaymentMethodSeeder::class,
            ShippingMethodSeeder::class,
        ]);

        // Tạo thêm dữ liệu ngẫu nhiên
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\ProductReview::factory(50)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\OrderItem::factory(30)->create();
    }
}
