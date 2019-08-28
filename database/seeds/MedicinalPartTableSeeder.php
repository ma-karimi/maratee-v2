<?php

use Illuminate\Database\Seeder;

class MedicinalPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
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
                    'type' => random_int(1,2),
                    'name' => make_json($item),
                ]);
            }

        }
    }
}
