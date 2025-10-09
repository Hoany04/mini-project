<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_profiles')->insert([
            [
                'user_id' => 1,
                'phone' => '0905123456',
                'address' => '123 Đường Trần Hưng Đạo, Quận 1',
                'city' => 'Hồ Chí Minh',
                'country' => 'Việt Nam',
                'avatar' => './assets/img/avatars/3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'phone' => '0987123456',
                'address' => '456 Phan Chu Trinh, Quận Hải Châu',
                'city' => 'Đà Nẵng',
                'country' => 'Việt Nam',
                'avatar' => './assets/img/avatars/2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'phone' => '0912345678',
                'address' => '789 Nguyễn Văn Linh, Quận Thanh Xuân',
                'city' => 'Hà Nội',
                'country' => 'Việt Nam',
                'avatar' => './assets/img/avatars/1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
