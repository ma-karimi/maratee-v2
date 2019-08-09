<?php

use App\Models\General;
use Illuminate\Database\Seeder;

class GeneralTableSeeder extends Seeder
{
    public $types = ['phytogeography', 'phenology', 'plant_type', 'species', 'sub_species', 'variety', 'family', 'genus', 'class', 'group', 'order', 'flowering', 'sperm', 'cotyledon', 'growth', 'usage', 'part', 'industry', 'application', 'habitat', 'ecology', 'origin'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->types as $type) {
            General::create(
                ['name' => make_json('www'), 'description' => make_json('qqqq'), 'type' => $type]
            );
        }
    }
}
