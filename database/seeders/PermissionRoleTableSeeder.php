<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::query()->pluck('id');
        $role = Role::findOrFail(1);
        $role->syncPermissions($admin_permissions);

        $user_permissions = Permission::query()->find([22,23,24,25,26,27,28,29,30,31])->pluck('id');
        $user_role = Role::findOrFail(2);
        $user_role->syncPermissions($user_permissions);
    }
}
