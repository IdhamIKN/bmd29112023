<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
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
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                ]);
            }
        }

        $adminPermissions = [

            'dashboard-create',
            'dashboard-edit',
            'dashboard-delete',

            'karyawan-show',
            'karyawan-create',
            'karyawan-edit',
            'karyawan-delete',

            'reward-create',
            'reward-edit',
            'reward-delete',

            'punishment-create',
            'punishment-edit',
            'punishment-delete',
        ];

        foreach ($adminPermissions as $permissionName) {
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                ]);
            }
        }

        $userPermissions = [

            'user-index',
            'user-show',
            'user-create',
            'user-edit',
            'user-delete',

            'password-index',
            'password-show',
            'password-create',
            'password-edit',
            'password-delete',

            'dashboard-index',
            'dashboard-show',

            'reward-index',
            'reward-show',

            'punishment-index',
            'punishment-show',

            'karyawan-index',

            'personal-index',
            'personal-show',
            'personal-create',
            'personal-edit',
            'personal-delete',

            'alamat-index',
            'alamat-show',
            'alamat-create',
            'alamat-edit',
            'alamat-delete',

            'pendidikan-index',
            'pendidikan-show',
            'pendidikan-create',
            'pendidikan-edit',
            'pendidikan-delete',

            'pendidikanfrm-index',
            'pendidikanfrm-show',
            'pendidikanfrm-create',
            'pendidikanfrm-edit',
            'pendidikanfrm-delete',

            'keluarga-index',
            'keluarga-show',
            'keluarga-create',
            'keluarga-edit',
            'keluarga-delete',

            'bahasa-index',
            'bahasa-show',
            'bahasa-create',
            'bahasa-edit',
            'bahasa-delete',

            'organisasi-index',
            'organisasi-show',
            'organisasi-create',
            'organisasi-edit',
            'organisasi-delete',

            'kontak-index',
            'kontak-show',
            'kontak-create',
            'kontak-edit',
            'kontak-delete',

        ];

        foreach ($userPermissions as $permissionName) {
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                ]);
            }
        }

        // Izin untuk role superadmin
        $superadminRole = Role::where('name', 'superadmin')->first();
        $superadminRole->givePermissionTo(array_merge($superadminPermissions, $adminPermissions, $userPermissions));

        // Izin untuk role admin
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo(array_merge($adminPermissions, $userPermissions));

        // Izin untuk role user
        $userRole = Role::where('name', 'user')->first();
        $userRole->givePermissionTo(array_merge($userPermissions));
    }
}
