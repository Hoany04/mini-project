<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Dashboard & Logs
            'view.dashboard',
            'view.logs',

            // Products
            'create.product',
            'view.product',
            'update.product',
            'delete.product',
            'trashed.product',
            'restore.product',
            'force.delete.product',
            'delete.product-image',
            'view.product-reviews',
            'delete.product-review',

            // Product Variants
            'view.product-variant',
            'create.product-variant',
            'update.product-variant',
            'delete.product-variant',

            // Categories
            'view.category',
            'create.category',
            'update.category',
            'delete.category',

            // Carts
            'view.cart',
            'show.cart-details',
            'delete.cart',

            // Orders
            'view.order',
            'update.order-status',
            'update.order-shipping',
            'delete.order',

            // Coupons
            'view.coupon',
            'create.coupon',
            'update.coupon',
            'delete.coupon',

            // Users
            'view.user',
            'create.user',
            'update.user',
            'delete.user',
            'import.user',
            'export.user',

            // Roles
            'view.role',
            'create.role',
            'update.role',
            'delete.role',

            // Shipping Methods
            'view.shipping',
            'create.shipping',
            'update.shipping',
            'delete.shipping',

            // Payment Transactions
            'view.payment-transaction',
            'show.payment-transaction-details',

            // Payment Methods
            'view.payment-method',
            'create.payment-method',
            'update.payment-method',
            'delete.payment-method',
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::where('name', 'Admin')->first();

        $admin->syncPermissions([
            'view.dashboard',
            'view.logs',
            'view.product',
            'view.category',
            'view.cart',
            'show.cart-details',
            'view.order',
            'view.coupon',
            'view.user',
            'view.role',
            'view.shipping',
            'view.payment-transaction',
            'show.payment-transaction-details',
            'view.payment-method',

            'create.product',
            'create.product-variant',
            'create.user',
            'create.shipping',
            'create.payment-method',

            'update.product',
            'update.product-variant',
            'update.category',
            'update.order-status',
            'update.order-shipping',
            'update.coupon',
            'update.user',
            'update.shipping',
            'update.payment-method',

            'delete.product',
            'delete.product-image',
            'delete.product-review',
            'delete.product-variant',
            'delete.category',
            'delete.cart',
            'delete.order',
            'delete.coupon',
            'delete.shipping',
            'delete.payment-method',

            'trashed.product',
            'restore.product',
            'force.delete.product',
            'import.user',
            'export.user',
            'show.payment-transaction-details',
        ]);

        $staff = Role::where('name', 'Staff')->first();

        $staff->syncPermissions([
            'view.dashboard',
            'view.product',
            'view.category',
            'view.cart',
            'show.cart-details',
            'view.order',
            'view.coupon',
            'view.user',
            'view.shipping',
            'view.payment-transaction',
            'show.payment-transaction-details',
            'view.payment-method',

            'create.product-variant',
            'update.product-variant',

            'update.order-status',
            'update.order-shipping',

            'delete.product-image',
            'delete.product-review',
        ]);
    }
}
