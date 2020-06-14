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
//        $this->setTaxonomyAuthors();
        Excel::import(new NonFlowerDiatomImport(), public_path('/excels/diatom.xlsx'));
    }


    private function log(string $message)
    {
        echo "$message\n";
    }

    public function setTaxonomyAuthors(): void
    {
        NonflowerTaxonomy::all()->each(function ($query) {

            $query->species_id = NonflowerGeneral::where(['name' => $query['species']['name'], 'type' => 'species'])->first()->id;

            NonflowerGeneral::where(['name' => $query['species']['name'], 'type' => 'species'])->where('id', '!=', $query->species_id)->delete();
            $query->species_authors = $query['speAuthors'] ?? null;

            if (!empty($query->subspecies_id)) {
                $query->subspecies_id = NonflowerGeneral::where(['name' => $query['subspecies']['name'], 'type' => 'sub_species'])->first()->id;

                NonflowerGeneral::where(['name' => $query['subspecies']['name'], 'type' => 'sub_species'])->where('id', '!=', $query->subspecies_id)->delete();
                $query->species_authors = $query['subSpeAuthors'] ?? null;
            }
            if (!empty($query->variety_id)) {
                $query->variety_id = NonflowerGeneral::where(['name' => $query['variety']['name'], 'type' => 'variety'])->first()->id;

                NonflowerGeneral::where(['name' => $query['variety']['name'], 'type' => 'variety'])->where('id', '!=', $query->variety_id)->delete();
                $query->variety_authors = $query['varAuthors'] ?? null;
            }
            $query->save();
            $this->log('Taxonomy:' . $query->id);

        });
    }
}
