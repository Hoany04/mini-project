<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingMethodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shipping_methods')->insert([
            ['name' => 'Giao hàng tiết kiệm', 'description' => 'Thời gian giao từ 2-4 ngày', 'fee' => 25000, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Giao hàng nhanh', 'description' => 'Thời gian giao trong 24h', 'fee' => 45000, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
