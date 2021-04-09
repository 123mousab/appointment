<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'         => '1',
                'name'      => 'user_management_access',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '2',
                'name'      => 'permission_create',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '3',
                'name'      => 'permission_edit',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '4',
                'name'      => 'permission_show',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '5',
                'name'      => 'permission_delete',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '6',
                'name'      => 'permission_access',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '7',
                'name'      => 'role_create',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '8',
                'name'      => 'role_edit',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '9',
                'name'      => 'role_show',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '10',
                'name'      => 'role_delete',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '11',
                'name'      => 'role_access',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '12',
                'name'      => 'admin_create',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '13',
                'name'      => 'admin_edit',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '14',
                'name'      => 'admin_show',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '15',
                'name'      => 'admin_delete',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '16',
                'name'      => 'admin_access',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '17',
                'name'      => 'service_create',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '18',
                'name'      => 'service_edit',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '19',
                'name'      => 'service_show',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '20',
                'name'      => 'service_delete',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '21',
                'name'      => 'service_access',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '22',
                'name'      => 'user_create',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '23',
                'name'      => 'user_edit',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '24',
                'name'      => 'user_show',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '25',
                'name'      => 'user_delete',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '26',
                'name'      => 'user_access',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '27',
                'name'      => 'appointment_create',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '28',
                'name'      => 'appointment_edit',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '29',
                'name'      => 'appointment_show',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '30',
                'name'      => 'appointment_delete',
                'guard_name'      => 'admin',
            ],
            [
                'id'         => '31',
                'name'      => 'appointment_access',
                'guard_name'      => 'admin',
            ],
        ];

        Permission::insert($permissions);
    }
}
