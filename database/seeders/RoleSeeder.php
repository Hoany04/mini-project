<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'Quản trị hệ thống', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staff', 'description' => 'Nhân viên', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Customer', 'description' => 'Khách hàng', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
