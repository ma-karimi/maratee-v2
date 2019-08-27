<?php

use Illuminate\Database\Seeder;

class MedicinalPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Utility::truncateTables('medicinal_parts');
        $data = [
            'aerial' => ['fruit', 'stem','leaves','flowers',' seed','bark'],
            'ground' => ['root', 'rhizome','bulb','corm','node'],
        ];
        foreach ($data as $index => $datum) {
            foreach ($datum as  $item) {
                \App\Models\MedicinalPart::create([
                    'type' => $index,
                    'name' => make_json($item),
                ]);
            }

        }
    }
}
