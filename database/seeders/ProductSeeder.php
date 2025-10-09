<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Mũ Lưỡi Trai Adidas',
                'category_id' => 3,
                'user_id' => 2,
                'price' => 350000,
                'stock' => 20,
                'sold' => 5,
                'description' => 'Mũ lưỡi trai Adidas chính hãng, chất liệu cotton thoáng mát.',
                'status' => 'active',
                'average_rating' => 4.5,
                'total_review' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mũ Bucket Nữ',
                'category_id' => 2,
                'user_id' => 2,
                'price' => 290000,
                'stock' => 15,
                'sold' => 3,
                'description' => 'Mũ bucket nữ phong cách Hàn Quốc.',
                'status' => 'active',
                'average_rating' => 4.8,
                'total_review' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
