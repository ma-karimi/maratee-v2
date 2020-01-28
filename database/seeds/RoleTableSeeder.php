<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public $rules = ['Super Administrator', 'Administrator', 'Botanical Assistance', 'Medicinal Assistance', 'BioTech Assistance', 'Seed Project Boss', 'Botanical Flora Expert', 'Botanical NonFlower Expert', 'Botanical Herbarium Expert', 'Botanical Paleobotany Expert', 'Botanical Garden Expert', 'Botanical Gene Bank', 'Medicinal Expert', 'BioTech Expert'];
    public $permissions = [
        'botanical' => ['flora', 'nonflower', 'paleobotany', 'garden', 'herbarium', 'gene', 'type'],
        'medicinal' => ['type', 'product', 'pharmaceutical', 'location'],
        'biotech' => ['chromosome', 'cryobank']

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \Illuminate\Support\Facades\DB::table('roles')->truncate();
//        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        foreach ($this->rules as $rule) {
            Role::create(['name' => $rule, 'guard_name' => 'api']);
        }
        foreach ($this->permissions as $key => $values) {
            foreach ($values as $value) {
                \App\Models\Permission::create(['name' => "${key}:${value}", 'guard_name' => 'api']);
            }
        }


    }
}
