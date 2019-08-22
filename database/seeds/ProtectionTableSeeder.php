<?php

use Illuminate\Database\Seeder;

class ProtectionTableSeeder extends Seeder
{
    public $protections = [
        ['name' => ['fa' => 'در بحران انقراض', 'en' => 'CR']],
        ['name' => ['fa' => 'آسیب پذیر', 'en' => 'VU']],
        ['name' => ['fa' => 'در معرض خطر', 'en' => 'EN']],
        ['name' => ['fa' => 'نزدیک به تهدید', 'en' => 'NT']],
        ['name' => ['fa' => 'ارزیابی نشده', 'en' => 'NE']],
        ['name' => ['fa' => 'با نگرانی کم', 'en' => 'LC']],
        ['name' => ['fa' => 'فاقد اطلاعات', 'en' => 'DD']],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->protections as $protect) {
            \App\Models\Protection::create($protect);
        }
    }
}
