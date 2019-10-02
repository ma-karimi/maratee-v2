<?php

use App\Models\MedicinalPlantType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OriginalMedicinalPlantTypeTableSeeder extends Seeder
{

    public $foods = ['Edible', 'Flavoring', 'Preservatives', 'Food colors', 'Drinking', 'Additives', 'Oils'];

    public $others = ['Flourishes', 'Extracts and essential oils', 'Fresheners', 'Color', 'Oil', 'Tobacco', 'Paper', 'Glue', 'Toxins and herbal pesticides'];
    public $metabolites = ['Essential oil', 'Alkaloids', 'Flavonoids', 'Tannin'];
    public $materials = ['Alkaloids', 'Tannin', 'Flavonoids'];
    public $pharmaceuticals = ['Tablet', 'Syrup', 'Ointment', 'drop', 'ampule'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->foods as $food) {
            MedicinalPlantType::create([
                'name' => [
                    'en' => Str::ucfirst($food)
                ],
                'type_id' => 1
            ]);
        }
        foreach ($this->others as $others) {
            MedicinalPlantType::create([
                'name' => [
                    'en' => Str::ucfirst($others)
                ],
                'type_id' => 2
            ]);
        }
        foreach ($this->metabolites as $metabolite) {
            MedicinalPlantType::create([
                'name' => [
                    'en' => Str::ucfirst($metabolite)
                ],
                'type_id' => 3
            ]);
        }
        foreach ($this->materials as $material) {
            MedicinalPlantType::create([
                'name' => [
                    'en' => Str::ucfirst($material)
                ],
                'type_id' => 4
            ]);
        }
        foreach ($this->pharmaceuticals as $pharmaceutical) {
            MedicinalPlantType::create([
                'name' => [
                    'en' => Str::ucfirst($pharmaceutical)
                ],
                'type_id' => 5
            ]);
        }
    }
}
