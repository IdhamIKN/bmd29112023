<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $superadminPermissions = [
            'permission-index',
            'permission-show',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'role-index',
            'role-show',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ($superadminPermissions as $permissionName) {
            Permission::create([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }

        $adminPermissions = [
            'dashboard-index',
            'dashboard-show',
            'dashboard-create',
            'dashboard-edit',
            'dashboard-delete',
            'karyawan-index',
            'karyawan-show',
            'karyawan-create',
            'karyawan-edit',
            'karyawan-delete',
        ];

        foreach ($adminPermissions as $permissionName) {
            Permission::create([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }

        $userPermissions = [
            'karyawan-index',
            'karyawan-show',
            'karyawan-create',
            'karyawan-edit',
            'karyawan-delete',
        ];

        foreach ($userPermissions as $permissionName) {
            Permission::create([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }

        // Izin untuk role superadmin
        $superadminRole = Role::where('name', 'superadmin')->first();
        $superadminRole->givePermissionTo(array_merge($superadminPermissions, $adminPermissions, $userPermissions));

        // Izin untuk role admin
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo(array_merge( $adminPermissions, $userPermissions));

        // Izin untuk role user
        $userRole = Role::where('name', 'user')->first();
        $userRole->givePermissionTo(array_merge( $userPermissions));
    }
}

