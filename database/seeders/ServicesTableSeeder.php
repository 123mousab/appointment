<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::query()->create([
            'name' => 'إصدار وتجديد جواز السفر الفلسطيني.'
        ]);
        Service::query()->create([
            'name' => 'إضافة أو تعديل بيانات على جواز السفر الفلسطيني.'
        ]);
        Service::query()->create([
            'name' => 'التصديق على المستندات والشهادات والوثائق الرسمية حسب الأصول المتبعة.'
        ]);
        Service::query()->create([
            'name' => 'إصدار الوكالات بكافة أشكالها وأنواعها.'
        ]);
        Service::query()->create([
            'name' => 'إصدار خطابات لحملة وثائق السفر المصرية.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات إثبات الجنسية لحملة الجوازات غير الفلسطينية.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات بعدم حمل الهوية الفلسطينية وجواز السفر الفلسطيني.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات بتغير إسم أو تعديله.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات بعدم الزواج بشهود.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات الموافقة على الزواج من غير الجنسية الفلسطينية.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات إثبات الحالة الإجتماعية.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات الإعالة.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات قيد الحياة.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات عدم الممانعة في الحصول على جنسية أخرى.'
        ]);
        Service::query()->create([
            'name' => 'إصدار إفادات المطابقة مرفقة بصورة صاحب العلاقة.'
        ]);
        Service::query()->create([
            'name' => 'إصدار خطابات فحص ما قبل الزواج ( للمستشفيات الحكومية والخاصة)'
        ]);
        Service::query()->create([
            'name' => 'إصدار خطابات للمباحث الجنائية لتسهيل الحصول على شهادة حسن السيرة والسلوك.'
        ]);
        Service::query()->create([
            'name' => 'إصدار خطابات لتسهيل مهام المواطنين الذين انتهت صلاحية جوازات سفرهم.'
        ]);
        Service::query()->create([
            'name' => 'إصدار خطابات تسهيل الحصول على تأشيرة من السفارات العربية أو الأجنبية.'
        ]);
        Service::query()->create([
            'name' => 'إصدار خطابات حسب الحالة التي يطرحها المواطن بعد دراستها بما لا يتعارض مع القوانين المعمول بها بالمملكة أو في دولة فلسطين.'
        ]);
//        Service::factory()->count(10)->create();
    }
}
