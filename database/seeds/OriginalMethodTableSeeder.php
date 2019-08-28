<?php

use App\Models\Method;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OriginalMethodTableSeeder extends Seeder
{

    public $distillations = ['macceration', 'soxchelet', ' sonication', 'supereitica fluid'];

    public $extractions = ['hydro distillation', 'water & steam distillation', 'direct steam distillation'];
    public $analyses = ['Gc', 'GCIMS', 'HPLC', 'NMR', 'ICP', 'Atomic absorption'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->distillations as $distillation) {
            Method::create([
                'name' => [
                    'en' => Str::ucfirst($distillation)
                ],
                'type_id' => 1
            ]);
        }
        foreach ($this->extractions as $extraction) {
            Method::create([
                'name' => [
                    'en' => Str::ucfirst($extraction)
                ],
                'type_id' => 2
            ]);
        }
        foreach ($this->analyses as $analysis) {
            Method::create([
                'name' => [
                    'en' => Str::ucfirst($analysis)
                ],
                'type_id' => 3
            ]);
        }
    }
}
