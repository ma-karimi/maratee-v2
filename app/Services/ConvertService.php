<?php


namespace App\Services;


use App\Models\{ActionActor,
    ActionHub,
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

    private const ACTION = [
        'detect' => 1, 'collect' => 2
    ];
    private $treeLeaf;
    private $models = [];

    /**
     * ConvertService constructor.
     * @param Treeleaf $treeLeaf
     */
    public function __construct(Treeleaf $treeLeaf)
    {
        $this->treeLeaf = $treeLeaf;
    }

    public function handle()
    {

        $this->setTreeLeafLocation();
        $this->setTreeLeafTaxonomy();

        $this->models['organization_id'] = Organization::firstOrCreate($this->organizationData())->id;

        // plant herbarium
        $this->setTreeLeafPlant();
        $herbarium_id = Herbarium::create($this->herbariumData())->id;
        $this->setTreeLeafCollectors($herbarium_id);
        $this->setTreeLeafDeterminers($herbarium_id);
//        if (App::environment() == 'local') {
        $this->log(" - Herbarium id : {$herbarium_id} - ");
        //        }

    }


    private function setTreeLeafLocation(): void
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
            'country_id' => 109,
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

    private function setTreeLeafTaxonomy(): void
    {
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
        $data = $this->speciesData();
        $species = General::firstOrCreate($data['species_data']);
        $this->models['general']['species_id'] = $species->id;
        $this->models['general']['species_authors'] = $data['species_authors'];

        return $this->models['general'];
    }

    private function speciesData()
    {
        $array = $this->trimPropAuthor($this->treeLeaf->spe->name, 'species');
        $array['species_data'] = [
            'type' => 'species',
            'name' => Str::lower($array['species']) ?? '',
        ];
        return $array;
    }

    /**
     * @param $property
     * @param $model
     * @return array
     */
    private function trimPropAuthor($property, $model)
    {
        $array = [];
        if ($p = strpos($property, ' ')) {
            $array[$model] = trim(substr($property, 0, $p));
            $authors = trim(substr($property, $p, strlen($property)));
            $authors = str_replace(', ', ' & ', $authors);
            $authors = str_replace('-', ' & ', $authors);
            $authors = str_replace(' -', ' & ', $authors);
            $authors = str_replace('- ', ' & ', $authors);
            $array[$model . '_authors'] = $authors;
        } else {
            $array[$model] = trim($property);
            $array[$model . '_authors'] = null;
        }

        return $array;


    }

    private function firstOrCreateSubSpecies()
    {
        $data = $this->subspeciesData();
        $subspecies = General::firstOrCreate($data['subspecies_data']);
        $this->models['general']['subspecies_id'] = $subspecies->id;
        $this->models['general']['subspecies_authors'] = $data['sub_species_authors'];

        return $this->models['general'];
    }

    private function subspeciesData()
    {
        $data = $this->trimPropAuthor($this->treeLeaf->subspe->name, 'sub_species');
        $data['subspecies_data'] = [
            'type' => 'sub_species',
            'name' => trim($data['sub_species']) ?? '',
        ];

        return $data;
    }

    private function firstOrCreateVariety()
    {
        $data = $this->varietyData();
        $variety = General::firstOrCreate($data['variety_data']);
        $this->models['general']['variety_id'] = $variety->id;
        $this->models['general']['variety_authors'] = $data['variety_authors'];

        return $this->models['general'];
    }

    private function varietyData()
    {
        $data = $this->trimPropAuthor($this->treeLeaf->var->name, 'variety');
        $data['variety_data'] = [
            'type' => 'variety',
            'name' => trim($data['variety']) ?? '',
        ];

        return $data;
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
            'species_authors' => $this->models['general']['species_authors'] ?? null,
            'subspecies_authors' => $this->models['general']['subspecies_authors'] ?? null,
            'variety_authors' => $this->models['general']['variety_authors'] ?? null,
        ];
    }

    private function organizationData(): array
    {
        return [
            'name_en' => trim($this->treeLeaf->organization),
        ];
    }

    private function setTreeLeafPlant(): void
    {
        $this->models['plant_id'] = Plant::firstOrCreate($this->plantData())->id;
        if (!empty($this->models['geographical_id'])) {
            PlantGeographical::firstOrCreate(
                [
                    'plant_id' => $this->models['plant_id'],
                    'geographical_id' => $this->models['geographical_id'],
                ]
            );
        }
    }

    private function plantData(): array
    {
        return [
            'taxonomy_id' => $this->models['taxonomy_id'],
        ];
    }

    private function herbariumData(): array
    {
        return [
            'herbarium_number' => $this->treeLeaf->herbariumnumber,
            'location_id' => $this->models['location_id'],
            'organization_id' => $this->models['organization_id'],
            'taxonomy_id' => $this->models['taxonomy_id'],
            'collection_date' => !empty($this->treeLeaf['gatheringdate']) ? $this->treeLeaf['gatheringdate'] : null,
            'determine_date' => !empty($this->treeLeaf['identifydate']) ? $this->treeLeaf['identifydate'] : null,
//            'collection_authors' => !empty($this->treeLeaf['collect']['name']) ? $this->treeLeaf['collect']['name'] : null,
//            'determine_authors' => !empty($this->treeLeaf['detect']['name']) ? $this->treeLeaf['detect']['name'] : null,
            'description' => !empty($this->treeLeaf->note1) ? $this->treeLeaf->note1 : null,
            'created_at' => !empty($this->treeLeaf->insertdate) ? $this->treeLeaf->insertdate : null,
            'updated_at' => !empty($this->treeLeaf->updatedate) ? $this->treeLeaf->updatedate : null,
        ];
    }

    /**
     * @param $herbarium_id
     */
    private function setTreeLeafCollectors($herbarium_id): void
    {
        $collect_name = $this->treeLeaf['collect']['name'] ?? null;
        if (!empty($collect_name)) {
            $collectors = explode('&', $collect_name);
            if (!empty($collectors) && count($collectors)) {
                foreach ($collectors as $collector) {
                    $collector_id = Actor::firstOrCreate($this->actorCollectData($collector))->id;
                    ActionActor::create([
                        'actorable_type' => Herbarium::class,
                        'actorable_id' => $herbarium_id,
                        'actor_id' => $collector_id,
                        'type_id' => 2
                    ]);
                }
            }
        }
    }

    private function actorCollectData($collector): array
    {
        return [
            'name' => trim($collector)
        ];
    }

    /**
     * @param $herbarium_id
     */
    private function setTreeLeafDeterminers($herbarium_id): void
    {
        $detect_name = $this->treeLeaf['detect']['name'] ?? null;
        if (!empty($detect_name)) {
            $detectors = explode('&', $detect_name);
            if (!empty($detectors) && count($detectors)) {
                foreach ($detectors as $detector) {
                    $detector_id = Actor::firstOrCreate($this->actorCollectData($detector))->id;
                    ActionActor::create([
                        'actorable_type' => Herbarium::class,
                        'actorable_id' => $herbarium_id,
                        'actor_id' => $detector_id,
                        'type_id' => 2
                    ]);
                }
            }
        }
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    /**
     * @param $herbarium_id
     * @deprecated
     */
    private function setTreeLeafDetectors($herbarium_id): void
    {
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
    }

    /**
     * @param $action_id
     * @param $herbarium_id
     * @param $date
     * @return array
     * @deprecated
     */
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
