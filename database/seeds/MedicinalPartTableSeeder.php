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
            1 => ['fruit', 'stem','leaves','flowers',' seed','bark', 'flowering shoot'],
            2 => ['root', 'rhizome','bulb','corm','node'],
        ];
        foreach ($data as $index => $datum) {
            foreach ($datum as  $item) {
                \App\Models\MedicinalPart::create([
                    'type_id' => $index,
                    'name' => $item,
                ]);
            }

        }
    }
}
