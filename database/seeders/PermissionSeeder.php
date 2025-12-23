<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'employee.view', 'module' => 'employee'],
            ['name' => 'employee.create', 'module' => 'employee'],
            ['name' => 'employee.update', 'module' => 'employee'],
            ['name' => 'employee.delete', 'module' => 'employee'],
        ]);
    }
}
