<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleAdminTableSeeder::class,
            UserTableSeeder::class,
            ServicesTableSeeder::class,
            UserTableSeeder::class,
            AppointmentsTableSeeder::class,
        ]);
    }
}
