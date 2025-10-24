<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['name' => 'COD (Thanh toán khi nhận hàng)', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chuyển khoản ngân hàng', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'stripe', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ví Momo', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
