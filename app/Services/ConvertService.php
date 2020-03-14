<?php


namespace App\Services;


use App\Models\{ActionHub,
    Actor,
    ActorHub,
    City,
    Convert\Treeleaf,
    General,
    Geographical,
    Herbarium,
    Location,
    Organization,
    Plant,
    PlantGeographical,
    Province,
    Taxonomy
};
use Illuminate\Support\Str;

class ConvertService
{

    private CONST ACTION = [
        'detect' => 1, 'collect' => 2
    ];
    private $treeLeaf;
    private $models = [];

    /**
     * ConvertService constructor.
     * @param $treeLeaf
     */
    public function __construct(Treeleaf $treeLeaf)
    {
        $this->treeLeaf = $treeLeaf;
    }

    public function handle()
    {


        if (!empty($this->treeLeaf->village) && !empty($this->treeLeaf->village->parent)) {
            // province
            $this->firstOrCreateProvince($this->treeLeaf->village, 'village');

            if (!empty(trim($this->treeLeaf->village->parent['name']))) {
                $this->firstOrCreateCity($this->treeLeaf->village, 'village');
            } else {
                $this->models['city'] = null;
            }
            if (!empty($village = trim($this->treeLeaf['village']['name']))) {
                // village
                $this->models['village'] = $village;
            } else {
                $this->models['village'] = null;
            }
            // location
            $this->createLocation();


        } elseif (!empty($this->treeLeaf->cityR) && !empty($this->treeLeaf->cityR->parent)) {

            $this->firstOrCreateProvince($this->treeLeaf->cityR, 'city');

            if (!empty(trim($this->treeLeaf->cityR['name']))) {

                $this->firstOrCreateCity($this->treeLeaf->cityR, 'city');

            } else {
                $this->models['city'] = null;
            }
            // location
            $this->createLocation();

        } elseif (!empty($this->treeLeaf->provinceR) && !empty($this->treeLeaf->provinceR['name'])) {
            $this->firstOrCreateProvince($this->treeLeaf->provinceR, 'province');


            // location
            $this->createLocation();


        } else {
//            Log::info("herb:" . $this->id);
            $this->models['location_id'] = null;
        }
        // family
        if (!empty($this->treeLeaf['fam']['name']))
            $this->models['general']['family_id'] = General::firstOrCreate($this->familyData())->id;

        // genus
        if (!empty($this->treeLeaf['gen']['name']))
            $this->models['general']['genus_id'] = General::firstOrCreate($this->genusData())->id;

        // species
        if (!empty($this->treeLeaf['spe']['name'])) {
            $this->firstOrCreateSpecies();
        }
        // subspecies
        if (!empty($this->treeLeaf['subspe']['name'])) {
            $this->firstOrCreateSubSpecies();
        }
        // variety
        if (!empty($this->treeLeaf['var']['name'])) {
            $this->firstOrCreateVariety();
        }
        // taxonomy
        $this->models['taxonomy_id'] = Taxonomy::firstOrCreate($this->taxonomyData())->id;

        $this->models['organization_id'] = Organization::firstOrCreate($this->organizationData())->id;

        // plant herbarium
        $this->models['plant_id'] = Plant::firstOrCreate($this->plantData())->id;
        if (!empty($this->models['geographical_id'])) {
            PlantGeographical::firstOrCreate(
                [
                    'plant_id' => $this->models['plant_id'],
                    'geographical_id' => $this->models['geographical_id'],
                ]
            );
        }
        $herbarium_id = Herbarium::create($this->herbariumData())->id;


        $detect_id = ActionHub::create($this->actionHubData(self::ACTION['detect'], $herbarium_id, $this->treeLeaf['identifydate']))->id;
        if (!empty($detect_name = $this->treeLeaf['detect']['name'])) {
            $detectors = explode('&', $detect_name);
            if (!empty($detectors) && count($detectors)) {
                foreach ($detectors as $detector) {
                    $detector_id = Actor::firstOrCreate($this->actorDetectData($detector))->id;
                    ActorHub::create($this->actorHubData($detect_id, $detector_id));
                }
            }
        }

        $collect_id = ActionHub::create($this->actionHubData(self::ACTION['collect'], $herbarium_id, $this->treeLeaf['gatheringdate']))->id;

        if (!empty($collect_name = $this->treeLeaf['collect']['name'])) {
            $collectors = explode('&', $collect_name);
            if (!empty($collectors) && count($collectors)) {
                foreach ($collectors as $collector) {
                    $collector_id = Actor::firstOrCreate($this->actorCollectData($collector))->id;
                    ActorHub::create($this->actorHubData($collect_id, $collector_id));
                }
            }
        }

//        if (App::environment() == 'local') {
            $this->log(" - Herbarium id : {$herbarium_id} - ");
//        }

    }

    private function firstOrCreateProvince($model, $type): void
    {
        $province = $this->provinceData($model, $type);
        $this->models['province'] = Province::firstOrCreate($this->provinceData($model, $type));
        $this->models['geographical_id'] = Geographical::firstOrCreate(['name' => $province['name_en'], 'type_id' => 2])->id;
    }

    private function provinceData($model, $type): array
    {
        if ($type == 'village') {
            $name = $model->parent->parent->name;
            $other_name = $model->parent->parent->othername;
        } elseif ($type == 'city') {
            $name = $model->parent->name;
            $other_name = $model->parent->othername;

        } else {
            $name = $model->name;
            $other_name = $model->othername;

        }
        $array = [
            'name_en' => trim($name),
            'country_id' => 109
        ];

        if (!empty($other_name)) {
            $array['name_fa'] = trim($other_name);
        }

        return $array;
    }

    private function firstOrCreateCity($model, $type): void
    {

        $this->models['city'] = City::firstOrCreate($this->cityData($model, $type));
    }

    private function cityData($model, $type): array
    {
        if ($type == 'village') {
            $name = $model->parent->name;
            $other_name = $model->parent->othername;
        } else {
            $name = $model->name;
            $other_name = $model->othername;

        }

        $array = [
            'name_en' => trim($name),
            'province_id' => $this->models['province']['id']
        ];
        if (!empty($other_name)) {
            $array['name_fa'] = trim($other_name);
        }

        return $array;
    }

    private function createLocation(): void
    {
        $this->models['location_id'] = Location::create($this->locationData())->id;
    }

    private function locationData(): array
    {
        $data = [
            'city_id' => $this->models['city']['id'] ?? null,
            'province_id' => $this->models['province']['id'],
            'address_en' => trim($this->treeLeaf->addresse),
            'address_fa' => trim($this->treeLeaf->addressf),
            'village' => !empty($this->models['village']) ? $this->models['village'] : null,
            'min_altitude' => $this->treeLeaf->minaltitude,
            'max_altitude' => $this->treeLeaf->maxaltitude,
        ];
        if ($this->hasPoint())
            $data['point'] = $this->getPoint();
        return $data;
    }

    private function hasPoint()
    {
        return strlen($this->treeLeaf->latitude) && strlen($this->treeLeaf->longitude);
    }

    private function getPoint(): array
    {
        return [
            $this->treeLeaf->latitude, $this->treeLeaf->longitude
        ];
    }

    private function familyData(): array
    {
        return [
            'type' => 'family',
            'name' => $this->treeLeaf->fam->name ?? ''
        ];
    }

    private function genusData(): array
    {
        return [
            'type' => 'genus',
            'name' => $this->treeLeaf->gen->name ?? '',
        ];
    }

    private function firstOrCreateSpecies()
    {
        $speciesData = $this->speciesData();
        $species = General::where($speciesData)->get();
        if (count($species) == 0) {
            $this->models['general']['species_id'] = $specie_id = General::create($this->speciesData())->id;
            if (count($this->models['species_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $this->models['species_authors']);
            }
        } else {
            foreach ($species as $item) {
                $species_authors = collect($item->authors)->pluck('name')->all();
                $diff = collect($this->models['species_authors'])->diff($species_authors)->all();
                if (count($diff) <= 0) {
                    return $this->models['general']['species_id'] = $item->id;
                }
            }
            $this->models['general']['species_id'] = $specie_id = General::create($this->speciesData())->id;
            if (count($this->models['species_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $this->models['species_authors']);
            }

        }
    }

    private function speciesData(): array
    {
        $specie = $this->trimPropAuthor($this->treeLeaf->spe->name, 'species');
        return [
            'type' => 'species',
            'name' => Str::lower($specie) ?? '',
        ];
    }

    /**
     * @param $property
     * @param $model
     * @return string
     */
    private function trimPropAuthor($property, $model): string
    {

        if ($p = strpos($property, ' ')) {
            $prop = trim(substr($property, 0, $p));
            $authors = trim(substr($property, $p, strlen($property)));
            $authors = str_replace(', ', ' & ', $authors);
            $authors = str_replace('-', ' & ', $authors);
            $authors = str_replace(' -', ' & ', $authors);
            $authors = str_replace('- ', ' & ', $authors);
            $this->models[$model . '_authors'] = collect(array_unique(explode(' & ', $authors)))->filter()->all();
        } else {
            $prop = trim($property);
            $this->models[$model . '_authors'] = [];
        }

        return $prop;
    }

    /**
     * @param $general_id
     * @param $authors
     * @return void
     */
    private function firstOrCreateActorAndActorHub($general_id, $authors)
    {
        if (count($authors)) {
            foreach ($authors as $author) {
                $author = Actor::firstOrCreate(['name' => $author]);
                $this->setActorHub($author, $general_id);
            }
        }
    }

    /**
     * @param $author
     * @param $general
     */
    private function setActorHub($author, $general_id): void
    {
        ActorHub::firstOrCreate([
            'actor_id' => $author->id,
            'actorable_id' => $general_id,
            'actorable_type' => General::class,
        ]);
    }

    private function firstOrCreateSubSpecies()
    {
        $subspeciesData = $this->subspeciesData();
        $subspecies = General::where($subspeciesData)->get();
        if (count($subspecies) == 0) {
            $this->models['general']['subspecies_id'] = $sub_specie_id = General::create($this->subspeciesData())->id;
            if (count($this->models['sub_species_authors'])) {
                $this->firstOrCreateActorAndActorHub($sub_specie_id, $this->models['sub_species_authors']);
            }
        } else {
            foreach ($subspecies as $item) {
                $subspecies_authors = collect($item->authors)->pluck('name')->all();
                $diff = collect($this->models['sub_species_authors'])->diff($subspecies_authors)->all();

                if (count($diff) <= 0) {
                    return $this->models['general']['subspecies_id'] = $item->id;
                }
            }
            $this->models['general']['subspecies_id'] = $sub_specie_id = General::create($this->subspeciesData())->id;
            if (count($this->models['sub_species_authors'])) {
                $this->firstOrCreateActorAndActorHub($sub_specie_id, $this->models['sub_species_authors']);
            }
        }
    }

    private function subspeciesData(): array
    {
        $subSpecie = $this->trimPropAuthor($this->treeLeaf->subspe->name, 'sub_species');
        return [
            'type' => 'sub_species',
            'name' => Str::lower($subSpecie) ?? '',
        ];
    }

    private function firstOrCreateVariety()
    {
        $varietyData = $this->varietyData();
        $variety = General::where($varietyData)->get();
        if (count($variety) == 0) {

            $this->models['general']['variety_id'] = $specie_id = General::create($this->varietyData())->id;
            if (count($this->models['variety_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $this->models['variety_authors']);
            }
        } else {
            foreach ($variety as $item) {
                $variety_authors = collect($item->authors)->pluck('name')->all();
                $diff = collect($this->models['variety_authors'])->diff($variety_authors)->all();

                if (count($diff) <= 0) {
                    return $this->models['general']['variety_id'] = $item->id;
                }
            }
            $this->models['general']['variety_id'] = $specie_id = General::create($this->varietyData())->id;
            if (count($this->models['variety_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $this->models['variety_authors']);
            }
        }
    }

    private function varietyData(): array
    {
        $variety = $this->trimPropAuthor($this->treeLeaf->var->name, 'variety');
        return [
            'type' => 'variety',
            'name' => Str::lower($variety) ?? '',
        ];
    }

    private function taxonomyData(): array
    {
        return [
            'name' => $this->treeLeaf->name ?? null,
            'family_id' => $this->models['general']['family_id'] ?? null,
            'genus_id' => $this->models['general']['genus_id'] ?? null,
            'species_id' => $this->models['general']['species_id'] ?? null,
            'subspecies_id' => $this->models['general']['subspecies_id'] ?? null,
            'variety_id' => $this->models['general']['variety_id'] ?? null,
        ];
    }

    private function organizationData(): array
    {
        return [
            'name_en' => trim($this->treeLeaf->organization),
        ];
    }

    private function plantData(): array
    {
        return [
            'taxonomy_id' => $this->models['taxonomy_id'],
        ];
    }

    private function herbariumData(): array
    {
        $array = [
            'herbarium_number' => $this->treeLeaf->herbariumnumber,
            'location_id' => $this->models['location_id'],
            'organization_id' => $this->models['organization_id'],
            'taxonomy_id' => $this->models['taxonomy_id'],
        ];

        if (!empty($this->treeLeaf->note1)) {
            $array['description'] = $this->treeLeaf->note1;
        }

        return $array;
    }

    private function actionHubData($action_id, $herbarium_id, $date): array
    {
        return [
            'action_id' => $action_id,
            'actionable_type' => Herbarium::class,
            'actionable_id' => $herbarium_id,
            'date' => $date
        ];
    }

    private function actorDetectData($detector): array
    {
        return [
            'name' => trim($detector)
        ];
    }

    private function actorHubData($action_id, $actor_id): array
    {
        return [
            'actorable_type' => ActionHub::class,
            'actorable_id' => $action_id,
            'actor_id' => $actor_id,
        ];
    }

    private function actorCollectData($collector): array
    {
        return [
            'name' => trim($collector)
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    private function actionHubDetectData(): array
    {
        return [
            'action_id' => self::ACTION['detect'],
            'actionable_type' => Herbarium::class,
            'actionable_id' => $this->models['herbarium_id'],
            'date' => $this->treeLeaf->identifydate
        ];
    }

}
