<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public $rules = ['Super Administrator', 'Administrator', 'Botanical Assistance', 'Medicinal Assistance', 'BioTech Assistance', 'Seed Project Boss', 'Botanical Flora Expert', 'Botanical NonFlower Expert', 'Botanical Herbarium Expert', 'Botanical Paleobotany Expert', 'Botanical Garden Expert', 'Botanical Gene '];

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
