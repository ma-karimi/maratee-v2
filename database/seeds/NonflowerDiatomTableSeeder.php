<?php

use App\Imports\NonFlowerDiatomImport;
use App\Models\NonflowerGeneral;
use App\Models\NonflowerTaxonomy;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class NonflowerDiatomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setTaxonomyAuthors();
        Excel::import(new NonFlowerDiatomImport(), public_path('/excels/diatom.xlsx'));
    }

    public function setTaxonomyAuthors(): void
    {
        NonflowerTaxonomy::all()->each(function ($query) {

            if (!empty($query->species_id)) {
                $query->species_id = NonflowerGeneral::where(['name' => $query['species']['name'], 'type' => 'species'])->first()->id;
                $query->species_authors = $query['speAuthors'] ?? null;

                $species = \App\Models\NonflowerGeneral::where(['name' => $query['species']['name'], 'type' => 'species'])->where('id', '!=', $query->species_id)->get();
                \App\Models\NonflowerTaxonomy::whereIn('species_id', $species->pluck('id')->toArray())->update(['species_id' => $query->species_id]);
                foreach ($species as $index => $item) {
//                    $query->authors()->delete();
                    $item->forceDelete();
                }
            }
            if (!empty($query->subspecies_id)) {
                $query->subspecies_id = NonflowerGeneral::where(['name' => $query['subspecies']['name'], 'type' => 'sub_species'])->first()->id;


                $query->species_authors = $query['subSpeAuthors'] ?? null;
                $subspecies = \App\Models\NonflowerGeneral::where(['name' => $query['subspecies']['name'], 'type' => 'sub_species'])->where('id', '!=', $query->subspecies_id)
                    ->get();
                \App\Models\NonflowerTaxonomy::whereIn('subspecies_id', $species->pluck('id')->toArray())->update(['subspecies_id' => $query->subspecies_id]);
                foreach ($subspecies as $index => $item) {
//                    $query->authors()->delete();
                    $item->forceDelete();
                }
            }
            if (!empty($query->variety_id)) {
                $query->variety_id = NonflowerGeneral::where(['name' => $query['variety']['name'], 'type' => 'variety'])->first()->id;

                $query->variety_authors = $query['varAuthors'] ?? null;
                $varieties = \App\Models\NonflowerGeneral::where(['name' => $query['variety']['name'], 'type' => 'variety'])->where('id', '!=', $query->variety_id)
                    ->get();

                \App\Models\NonflowerTaxonomy::whereIn('variety_id', $species->pluck('id')->toArray())->update(['variety_id' => $query->variety_id]);
                foreach ($varieties as $index => $item) {
//                    $query->authors()->delete();
                    $item->forceDelete();
                }
            }
            $query->save();
            $this->log('Taxonomy:' . $query->id);

        });
    }

    private function log(string $message)
    {
        echo "$message\n";
    }
}
