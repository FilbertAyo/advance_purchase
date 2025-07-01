<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions
        $permissions = [
            // Common management
            'view users',
            'manage users',
            'verify customers',
            'manage settings',
            'update bank account',
            'view reports',
            'view dashboard',
            'view customers',
            'view applications',
            'manage applications',
            'refund management approval',

            // Items
            'add items',
            'edit items',
            'delete items',
            'view items',

            // Payments
            'update payments',
            'view payments',

            // Orders / Delivery
            'confirm delivery',
            'upload serial numbers',
            'upload product model',

            // Customer

            'update profile',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superUser = Role::firstOrCreate(['name' => 'superuser']);
        $superUser->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);

        $admin->givePermissionTo([
            'view users',
            'manage users',
            'verify customers',
            'add items',
            'edit items',
            'delete items',
            'view items',
            'manage settings',
            'view reports',
            'view dashboard',
            'view customers',
            'view applications',
            'manage applications',

        ]);

        $cashier = Role::firstOrCreate(['name' => 'cashier']);
        $cashier->givePermissionTo([
            'update payments',
            'view payments',
            'verify customers',
            'view items',
            'manage settings',
            'update bank account',
            'view reports',
            'view dashboard',
            'view customers',
            'view applications',
            'refund management approval',
        ]);

        $delivery = Role::firstOrCreate(['name' => 'delivery']);
        $delivery->givePermissionTo([
            'confirm delivery',
            'upload serial numbers',
            'upload product model',
            'manage settings',
            'view items',
            'view reports',
            'view dashboard',
            'view customers',
            'view applications',
        ]);

        $customer = Role::firstOrCreate(['name' => 'customer']);
        $customer->givePermissionTo([
            'view applications',
            'manage applications',
            'update profile',
        ]);
    }
}
