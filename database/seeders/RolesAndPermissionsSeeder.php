<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view admin',
            'manage users',
            'manage pages',
            'manage posts',
            'manage events',
            'manage media',
            'manage downloads',
            'manage settings',
            'manage menus',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $contentAdmin = Role::firstOrCreate(['name' => 'Content Admin']);
        $editor = Role::firstOrCreate(['name' => 'Editor']);

        $superAdmin->givePermissionTo(Permission::all());

        $contentAdmin->givePermissionTo([
            'view admin',
            'manage pages',
            'manage posts',
            'manage events',
            'manage media',
            'manage downloads',
            'manage settings',
            'manage menus',
        ]);

        $editor->givePermissionTo([
            'view admin',
            'manage pages',
            'manage posts',
            'manage events',
        ]);
    }
}
