<?php

use Illuminate\Database\Seeder;

class TaxonomyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\Taxonomy::class, 50)->create();
        foreach (\App\Models\Plant::all() as $index => $item) {
            $plant_family_generals = \App\Models\General::where('type', 'family')->pluck('id');
            $plant_genus_generals = \App\Models\General::where('type', 'genus')->pluck('id');
            $plant_specie_generals = \App\Models\General::where('type', 'species')->pluck('id');
            $plant_sub_specie_generals = \App\Models\General::where('type', 'sub_species')->pluck('id');
            $plant_type_generals = \App\Models\General::where('type', 'plant_type')->pluck('id');
            $plant_variety_generals = \App\Models\General::where('type', 'variety')->pluck('id');
            $plants = \App\Models\Plant::pluck('id')->toArray();
            $data = [
                'genus_id' => $plant_genus_generals->random(),
                'species_id' => $plant_specie_generals->random(),
                'variety_id' => ($plant_variety_generals->random() % 3) ? $plant_variety_generals->random() : null,
                'family_id' => $plant_family_generals->random(),
                'plant_id' => $item->id,
                'tip_type_id' => $plant_type_generals->random(),
                'subspecies_id' => $plant_sub_specie_generals->random(),
                'type_description' => make_json(rand(2, 5)),
            ];
            \App\Models\Taxonomy::create($data);
        }
    }
}
