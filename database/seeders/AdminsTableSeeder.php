<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'mobile'          => '99999999',
                'password'       => '$2y$10$Y.jEitizf.DW3V7gxCnMr.SdWN2i1w4gobo28vTLGaFajqcjUl8Oy',
                'remember_token' => null,
                'created_at'     => '2021-04-10 12:08:28',
                'updated_at'     => '2021-04-10 12:08:28',
            ],
        ];

        \App\Models\Admin::insert($admins);
    }
}
