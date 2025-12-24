<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = Role::where('name', 'Staff')->first();

        $permissions = Permission::whereIn('name',
        [
            'view-dashboard',

            'view-product',
            'view-product-variant',

            'view-category',

            'view-cart',
            'show-cart-details',

            'view-order',
            'update-order-status',

            'view-coupon',

            'view-user',

            'view-shipping',

            'view-payment-transaction',
            'show-payment-transaction-details',

            'view-chat-support',
            'reply-chat-support',
        ]
        )->pluck('id');
        $staff->permissions()->sync($permissions);
    }
}
