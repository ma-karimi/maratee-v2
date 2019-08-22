<?php

use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Countries;

class LifeFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Utility::truncateTables('life_forms');
        $data = [
            'wooden' => ['tree', 'shrubs'],
            'herbaceous' => ['standing', 'crawling','evergreen','deciduous','semi deciduous','herb','bulb','tuber','rhizome','water plant'],
            'leaf' => ['broad_leaf', 'needle_leaf'],
            'life_cycle' => ['annual', 'biennial', 'perennial'],
        ];
        foreach ($data as $index => $datum) {
            foreach ($datum as  $item) {
                \App\Models\LifeForm::create([
                    'type' => $index,
                    'name' => make_json($item),
                ]);
            }

        }
        //factory(\App\Models\LifeForm::class, 50)->create();
    }
}
