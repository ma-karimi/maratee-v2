<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public $rules = ['Super Administrator', 'Administrator', 'Assistantَ'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 50)->create();
    }
}
