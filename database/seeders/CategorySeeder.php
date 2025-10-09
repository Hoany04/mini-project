<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Mũ nam', 'description' => 'Các loại mũ thời trang cho nam', 'parent_id' => null, 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mũ nữ', 'description' => 'Các loại mũ thời trang cho nữ', 'parent_id' => null, 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mũ lưỡi trai', 'description' => 'Mũ thể thao phong cách', 'parent_id' => 1, 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
