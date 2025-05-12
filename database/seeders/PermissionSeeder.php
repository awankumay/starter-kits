<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar permissions
        $permissions = [
            // User management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Role management
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // Permission management
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.delete',

            // Finance
            'finance.view',
            'finance.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role: Administrator (Super Admin) - akses penuh
        $administrator = Role::firstOrCreate(['name' => 'administrator']);
        $administrator->syncPermissions(Permission::all());

        // Role: Supervisor - akses terbatas ke user & role
        $supervisor = Role::firstOrCreate(['name' => 'supervisor']);
        $supervisor->syncPermissions([
            'user.view', 'user.create', 'user.edit',
            'role.view',
        ]);

        // Role: Finance - akses ke finance dan view user
        $finance = Role::firstOrCreate(['name' => 'finance']);
        $finance->syncPermissions([
            'finance.view', 'finance.manage',
            'user.view',
        ]);

        // Role: Admin (User Admin Non Admin System) - akses user & role terbatas
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'user.view',
        ]);

        // Role: User (User Reguler) - hanya view user
        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions([
            'user.view',
        ]);
    }
}
