<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Permission::class, 50)->create();

        \App\Models\Permission::insert([
            ['name' => 'botanical', 'guard_name' => 'web'],
            ['name' => 'bio_tech', 'guard_name' => 'web'],
            ['name' => 'gene', 'guard_name' => 'web'],
            ['name' => 'medicinal_plant', 'guard_name' => 'web']
        ]);

    }
}
