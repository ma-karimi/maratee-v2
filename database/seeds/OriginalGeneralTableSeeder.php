<?php

use App\Models\General;
use Illuminate\Database\Seeder;

class OriginalGeneralTableSeeder extends Seeder
{


    public $phytogeographies = [
        ['fa' => 'ایرانو توران', 'en' => 'Irano-Turanian'],
        ['fa' => 'هیرکانی', 'en' => 'Hyrcanian'],
        ['fa' => 'صحارا سندی', 'en' => 'Sahara-sandia'],
        ['fa' => 'مدیترانه ای', 'en' => 'Mediterranean'],

    ];
    public $habitats = [
        ['en' => 'Forest'],
        ['en' => 'Rangeland'],
        ['en' => 'Sandy hills'],
        ['en' => 'Desert'],
        ['en' => 'Coastal area'],
        ['en' => 'Field'],
        ['en' => 'Garden'],
        ['en' => 'Urban area'],
        ['en' => 'Industrial area'],
        ['en' => 'Protected or excluded areas'],

    ];
    public $growths = [
        ['en' => 'Tree'],
        ['en' => 'Shrub'],
        ['en' => 'Subshrub'],
        ['en' => 'Herbaceous']

    ];

    public $origins = [
        ['en' => 'Endemic'],
        ['en' => 'Native'],
        ['en' => 'Cultivated'],
        ['en' => 'Commercial imports']

    ];
    public $classes = [
        ['en' => 'Liliopsida'],
        ['en' => 'Magnoliopsida'],
    ];
    public $plant_types = [
        ['en' => 'Holotype'],
        ['en' => 'Lectotype'],
        ['en' => 'Neotype'],
        ['en' => 'Epitypes'],
        ['en' => 'Syntypes'],
        ['en' => 'Paratypes'],
        ['en' => 'Isotypes'],
        ['en' => 'Topotypes'],
    ];
    public $ecologies = [
        ['en' => 'Grassland'],
        ['en' => 'Forest'],
        ['en' => 'Desert'],
        ['en' => 'Productive'],
        ['en' => 'Population'],
        ['en' => 'Community'],
        ['en' => 'Ecosystem'],
        ['en' => 'Microbial'],
        ['en' => 'Radiation'],
        ['en' => 'Pollution'],
        ['en' => 'Space'],
    ];
    public $flowers = [
        ['en' => 'Tubular'],
        ['en' => 'Dense heads'],
        ['en' => 'Umbel'],
        ['en' => 'Regular'],
        ['en' => 'Irregular'],
        ['en' => 'Spike'],
        ['en' => 'Panicle'],
    ];
    public $cotyledons = [
        ['en' => 'Monocotyledonous'],
        ['en' => 'Dicotyledonous'],
    ];
    public $sperms = [
        ['en' => 'Diatom'],
        ['en' => 'Laminaria'],
        ['en' => 'Fucus'],
        ['en' => 'Liverwort'],
        ['en' => 'Moss'],
        ['en' => 'Lycopodium'],
        ['en' => 'Selaginella'],
        ['en' => 'Psilotum'],
        ['en' => 'Fern'],
        ['en' => 'Equisetum'],
    ];
    public $substrates = [

        ['name' => 'Tree', 'type' => 'lichen'],
        ['name' => 'Wood', 'type' => 'lichen'],
        ['name' => 'Stone', 'type' => 'lichen'],
        ['name' => 'Rock', 'type' => 'lichen'],
        ['name' => 'Soil', 'type' => 'lichen'],
        ['name' => 'Moss', 'type' => 'lichen'],
        ['name' => 'Building', 'type' => 'lichen'],
        ['name' => 'Tree', 'type' => 'moss'],
        ['name' => 'Soil', 'type' => 'moss'],
        ['name' => 'Sweet water', 'type' => 'diatom'],
        ['name' => 'Salty water', 'type' => 'diatom'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->getPhytogeographies() as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'phytogeography']
            );
        }
        foreach ($this->getOrigins() as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'origin']
            );
        }
        foreach ($this->getHabitats() as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'habitat']
            );
        }
        foreach ($this->classes as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'class']
            );
        }
        foreach ($this->plant_types as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'plant_type']
            );
        }
//        foreach ($this->phenologies as $type) {
//            General::create(
//                ['name' => $type['en'], 'type' => 'phenology']
//            );
//        }
        foreach ($this->cotyledons as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'cotyledon']
            );
        }
        foreach ($this->flowers as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'flowering']
            );
        }
        foreach ($this->sperms as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'sperm']
            );
        }
        foreach ($this->ecologies as $type) {
            General::create(
                ['name' => $type['en'], 'type' => 'ecology']
            );
        }
        foreach ($this->getSubstrates() as $type) {
            $general = General::create(
                ['name' => $type['name'], 'type' => $type['type']]
            );
        }

    }

    /**
     * @return array
     */
    public function getPhytogeographies(): array
    {
        return $this->phytogeographies;
    }

    /**
     * @return array
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /**
     * @return array
     */
    public function getHabitats(): array
    {
        return $this->habitats;
    }

    /**
     * @return array
     */
    public function getSubstrates(): array
    {
        return $this->substrates;
    }
}
