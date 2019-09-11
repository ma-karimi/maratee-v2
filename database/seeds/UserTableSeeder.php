<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 50)->create();

        User::create([
            'email' => 'admin@gmail.com',
            'password' => 123456,
            'title' => ['en' => 'mrs.'],
            'education' => ['en' => 'wewewe'],
            'degree' => ['en' => 'ssss'],
            'national_id' => 61,
            'birthday' => '1993-01-20',
            'nationality' => ['en' => 'Colombia'],
            'first_name' => ['en' => 'Camille'],
            'last_name' => ['en' => 'Swift'],
            'nickname' => ['en' => 'laborum'],
            'mobile' => '9145508431',
            'phone' => '9145508431',
        ]);
    }
}
