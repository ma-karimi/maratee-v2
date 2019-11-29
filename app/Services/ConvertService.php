<?php


namespace App\Services;


use App\Models\{ActionHub,
    Actor,
    ActorHub,
    City,
    Convert\Treeleaf,
    General,
    Herbarium,
    Location,
    LocationHub,
    Organization,
    Plant,
    Province,
    Taxonomy};
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

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

    public function __get($name)
    {
        return $this->treeLeaf[$name] ?? null;
    }
//
//    public function treeLeaf(Treeleaf $treeLeaf): self
//    {
//        $this->treeLeaf = $treeLeaf;
//        return $this;
//    }

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
            Log::info("herb:" . $this->id);
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
            $this->models['general']['species_id'] = $specie_id = General::firstOrCreate($this->speciesData())->id;
            if (count($this->models['species_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $this->models['species_authors']);
            }
        }
        // subspecies
        if (!empty($this->treeLeaf['subspe']['name'])) {
            $this->models['general']['subspecies_id'] = $sub_specie_id = General::firstOrCreate($this->subspeciesData())->id;
            if (count($this->models['sub_species_authors'])) {
                $this->firstOrCreateActorAndActorHub($sub_specie_id, $this->models['sub_species_authors']);
            }
        }
        // variety
        if (!empty($this->treeLeaf['var']['name'])) {
            $this->models['general']['variety_id'] = $variety_id = General::firstOrCreate($this->varietyData())->id;
            if (count($this->models['variety_authors'])) {
                $this->firstOrCreateActorAndActorHub($variety_id, $this->models['variety_authors']);
            }
        }
        // taxonomy
        $this->models['taxonomy_id'] = Taxonomy::firstOrCreate($this->taxonomyData())->id;

        $this->models['organization_id'] = Organization::firstOrCreate($this->organizationData())->id;

        // plant herbarium
        $this->models['plant_id'] = Plant::firstOrCreate($this->plantData())->id;
        if (!empty($this->models['location_id'])) {
            LocationHub::firstOrCreate(
                [
                    'locationable_type' => Plant::class,
                    'locationable_id' => $this->models['plant_id'],
                    'location_id' => $this->models['location_id']
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
                    $collector_id = Actor::firstOrCreate($this->ActorCollectData($collector))->id;
                    ActorHub::create($this->actorHubData($collect_id, $collector_id));
                }
            }
        }

        if (App::environment() == 'local') {
            $this->log(" - TreeLeaf id : {$this->id} - ");
        }

    }

    private function firstOrCreateProvince($model, $type): void
    {

        $this->models['province'] = Province::firstOrCreate($this->provinceData($model, $type));
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

    private function speciesData(): array
    {
        $specie = $this->trimPropAuthor($this->treeLeaf->spe->name, 'species');
        return [
            'type' => 'species',
            'name' => $specie ?? '',
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
            $this->models[$model . '_authors'] = array_unique(explode(' & ', $authors));
        } else {
            $prop = trim($property);
            $this->models[$model . '_authors'] = [];
        }

        return $prop;
    }

    /**
     * @param $general
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

    private function subspeciesData(): array
    {
        $subSpecie = $this->trimPropAuthor($this->treeLeaf->subspe->name, 'sub_species');
        return [
            'type' => 'sub_species',
            'name' => $subSpecie ?? '',
        ];
    }

    private function varietyData(): array
    {
        $variety = $this->trimPropAuthor($this->treeLeaf->var->name, 'variety');
        return [
            'type' => 'variety',
            'name' => $variety ?? '',
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
        $array = [
            'is_flowering' => 1,
            'taxonomy_id' => $this->models['taxonomy_id'],
        ];

        return $array;
    }

    private function herbariumData(): array
    {
        $array = [
            'herbarium_number' => $this->treeLeaf->herbariumnumber,
            'location_id' => $this->models['location_id'],
            'organization_id' => $this->models['organization_id'],
            'taxonomy_id' => $this->models['taxonomy_id'],
            'plant_id' => $this->models['plant_id']['id']
        ];

        if (!empty($this->treeLeaf->cf)) {
            $array['cf'] = $this->treeLeaf->cf;
        }
        if (!empty($this->treeLeaf->herbariumindex)) {
            $array['herbarium_index'] = $this->treeLeaf->herbariumindex;
        }
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

    private function ActorCollectData($collector): array
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
