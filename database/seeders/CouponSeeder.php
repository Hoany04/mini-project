<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'code' => 'SALE10',
                'description' => 'Giảm 10% cho đơn hàng từ 200k',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'min_order_value' => 200000,
                'max_discount' => 50000,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'usage_limit' => 100,
                'used_count' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
