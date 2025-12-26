<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            if ($user->role_id) {
                $role = Role::find($user->role_id);
                if ($role) {
                    $user->assignRole($role);
                }
            }
        });
    }
}

