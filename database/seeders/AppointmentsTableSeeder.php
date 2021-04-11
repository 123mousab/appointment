<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Appointment::factory()->count(10)->create();

        $appointment = Appointment::find(1);

        $appointment->services()->sync([1,2,3]);

        $appointment2 = Appointment::find(2);

        $appointment2->services()->sync([4,5]);
    }
}
