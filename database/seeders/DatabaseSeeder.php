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
            PermissionSeeder::class,
        ]);

        // Tạo thêm dữ liệu ngẫu nhiên
        User::factory(10)->create();
        Category::factory(5)->create();
        Product::factory(10)->create();
        ProductReview::factory(50)->create();
        Order::factory(10)->create();
        OrderItem::factory(10)->create();
    }
}
