<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view-dashboard',

            'create-product',
            'view-product',
            'update-product',
            'delete-product',

            'delete-product-image',

            'view-product-variant',
            'delete-product-variant',

            'view-category',
            'create-category',
            'update-category',
            'delete-category',

            'view-cart',
            'show-cart-details',
            'delete-cart',

            'view-order',
            'update-order-status',
            'delete-order',

            'view-coupon',
            'create-coupon',
            'update-coupon',
            'delete-coupon',

            'view-user',
            'create-user',
            'update-user',
            'delete-user',

            'view-role',
            'create-role',
            'update-role',
            'delete-role',

            'view-shipping',
            'create-shipping',
            'update-shipping',
            'delete-shipping',

            'view-payment-transaction',
            'show-payment-transaction-details',

            'view-payment-method',
            'create-payment-method',
            'update-payment-method',
            'delete-payment-method',
        ];

        foreach ($permissions as $permission) {
            $parts = explode('-', $permission);
            $module = $parts[1] ?? $parts[0];

            Permission::firstOrCreate([
                'name' => $permission,
                'module' => $module,
            ]);
        }
    }
}
