<?php

use App\Models\MedicinalPlantType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OriginalMedicinalPlantTypeTableSeeder extends Seeder
{

    public $foods = ['Edible', 'Flavoring', 'Preservatives', 'Food colors', 'Drinking', 'Additives', 'Oils'];

    public $others = ['Herbaceous distillates', 'Extracts and essential oils', 'Fresheners', 'Color', 'Oil', 'Tobacco', 'Paper', 'Glue', 'Toxins and herbal pesticides', 'Other items'];
    public $potentials = ['Flourishes', 'Extracts and essential oils', 'Fresheners', 'Color', 'Oil', 'Tobacco', 'Paper', 'Glue', 'Toxins and herbal pesticides', 'Other items'];
    public $metabolites = ['Carbohydrates', 'Lipids', 'Amino acids & derivatives', 'Phenolic compounds', 'Essential oils and terpenoids', 'Steroids', 'Alkaloids', 'Lactones', 'Lignans', 'Tannins'];
    public $materials = ['Alkaloids', 'Tannin', 'Flavonoids'];
    public $pharmaceuticals = ['Tablet', 'Syrup', 'Ointment', 'drop', 'ampule'];
    public $treatments = ['stage of flowering', 'cutting plant'];
    public $phenologies = [
        'Vegetative stage',
        'Early flowering',
        'Full flowering',
        'immature seed',
        'ripe seed',

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->foods as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),
                'type_id' => 1
            ]);
        }
        foreach ($this->others as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),
                'type_id' => 4
            ]);
        }
        foreach ($this->potentials as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),
                'type_id' => 3
            ]);
        }
        foreach ($this->metabolites as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),
                'type_id' => 5
            ]);
        }
        foreach ($this->materials as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),
                'type_id' => 6
            ]);
        }
        foreach ($this->pharmaceuticals as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),

                'type_id' => 7
            ]);
        }
        foreach ($this->phenologies as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),

                'type_id' => 8
            ]);
        }
        foreach ($this->treatments as $item) {
            MedicinalPlantType::create([
                'name' => Str::ucfirst($item),

                'type_id' => 9
            ]);
        }
    }
}
