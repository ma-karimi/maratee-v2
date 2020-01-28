<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public const ROLES = ['Administrator', 'Management', 'Deputy', 'Director'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::ROLES as $role) {
            \App\Models\Role::create(['name' => $role]);
        }
    }
}
