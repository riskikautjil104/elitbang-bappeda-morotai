<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermission extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'create',
            'read',
            'update',
            'delete',
        ];

       
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Role Superadmin (semua permission)
        $admin = Role::firstOrCreate([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);
        $admin->syncPermissions($permissions);

        // Role OPD (permission terbatas)
        $opd = Role::firstOrCreate([
            'name' => 'opd',
            'guard_name' => 'web'
        ]);
        $opd->syncPermissions(['create', 'read', 'update']);
    }
}
