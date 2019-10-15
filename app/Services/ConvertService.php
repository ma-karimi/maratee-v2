<?php


namespace App\Services;


use App\Models\ActionHub;
use App\Models\Actor;
use App\Models\ActorHub;
use App\Models\City;
use App\Models\Convert\Treeleaf;
use App\Models\General;
use App\Models\Location;
use App\Models\Organization;
use App\Models\PlantHerbarium;
use App\Models\Province;
use App\Models\Taxonomy;
use App\Models\Village;
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

//
//        if($this->treeLeaf->id==2) {
//        dd($this->treeLeaf->cityR, !empty($this->treeLeaf->village), !empty(trim($this->treeLeaf->village['name'])), !empty($this->treeLeaf->cityR), !empty($this->treeLeaf->cityR['name']), !empty($this->treeLeaf->provinceR), !empty($this->treeLeaf->provinceR['name']));
//        }
        if (!empty($this->treeLeaf->village) && !empty($this->treeLeaf->village->parent)) {
            // province
            $this->firstOrCreateProvince($this->treeLeaf->village, 'village');

            if (!empty(trim($this->treeLeaf->village->parent['name']))) {
                $this->firstOrCreateCity($this->treeLeaf->village, 'village');
            } else {
                $this->models['city'] = null;
            }
            if (!empty(trim($this->treeLeaf->village['name']))) {
                // village
                $this->firstOrCreateVillage();
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
            $this->models['location'] = null;
        }
        // family
        if ($this->treeLeaf->has('fam') && !empty($this->treeLeaf->fam->name))
            $this->models['general']['family'] = General::firstOrCreate($this->familyData());

        // genus
        if ($this->treeLeaf->has('gen') && !empty($this->treeLeaf->gen->name))
            $this->models['general']['genus'] = General::firstOrCreate($this->genusData());

        // species
        if ($this->treeLeaf->has('spe') && !empty($this->treeLeaf->spe->name))
            $this->models['general']['species'] = General::firstOrCreate($this->speciesData());

        // subspecies
        if ($this->treeLeaf->has('subspe') && !empty($this->treeLeaf->subspe->name))
            $this->models['general']['subspecies'] = General::firstOrCreate($this->subspeciesData());

        // variety
        if ($this->treeLeaf->has('var') && !empty($this->treeLeaf->var->name))
            $this->models['general']['variety'] = General::firstOrCreate($this->varietyData());

        // taxonomy
        $this->models['taxonomy'] = Taxonomy::firstOrCreate($this->taxonomyData());

        // organization
        $this->models['organization'] = Organization::where($this->organizationConditions())->first();
        if (!$this->models['organization'])
            $this->models['organization'] = Organization::create($this->organizationData());

        // plant herbarium
        $this->models['plantHerbarium'] = PlantHerbarium::create($this->plantHerbariumData());


        // action hub detect
        if ($this->treeLeaf->detect) {
            $detectors = explode('&', $this->treeLeaf->detect->name);

            $this->models['actionHub']['detect'] = ActionHub::create($this->actionHubDetectData());

            foreach ($detectors as $detector) {

                $this->models['actor']['detect'] = Actor::firstOrCreate($this->actorDetectData($detector));
                // detect hub
                $this->models['actorHub']['detect'] = ActorHub::create($this->actorHubDetectData());

            }
        }

        if ($this->treeLeaf->collect) {
            $collectors = explode('&', $this->treeLeaf->collect->name);
            // action hub collect
            $this->models['actionHub']['collect'] = ActionHub::create($this->actionHubCollectData());

            foreach ($collectors as $collector) {

                // collector
                $this->models['actor']['collect'] = Actor::firstOrCreate($this->ActorCollectData($collector));

                // actor hub collect
                $this->models['actorHub']['collect'] = ActorHub::create($this->actorHubCollectData());

            }
        }


        $this->log(" - - - - end convert TreeLeaf id : {$this->id} - - - - ");

    }

    private function firstOrCreateProvince($model, $type): void
    {
        $this->models['province'] = Province::where($this->provinceConditions($model, $type))->first();
        if (!$this->models['province'])
            $this->models['province'] = Province::create($this->provinceData($model, $type));
    }

    private function provinceConditions($model, $type): array
    {
        if ($type == 'village') {
            $name = $model->parent->parent->name;
        } elseif ($type == 'city') {
            $name = $model->parent->name;
        } else {
            $name = $model->parent->name;
        }
        return [
            ['name->en', trim($name)],
        ];
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
            'name' => [
                'en' => trim($name),
            ],
            'country_id' => 1
        ];

        if (!empty($other_name)) {
            $array['name']['fa'] = trim($other_name);
        }

        return $array;
    }

    private function firstOrCreateCity($model, $type): void
    {
        $this->models['city'] = City::where($this->cityConditions($model, $type))->first();
        if (!$this->models['city'])
            $this->models['city'] = City::create($this->cityData($model, $type));
    }

    private function cityConditions($model, $type): array
    {
        if ($type == 'village') {
            $name = $model->parent->name;
        } else {
            $name = $model->name;
        }
        return [
            ['name->en', trim($name)],
        ];
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
            'name' => [
                'en' => trim($name),
            ],
            'province_id' => $this->models['province']['id']
        ];
        if (!empty($other_name)) {
            $array['name']['fa'] = trim($other_name);
        }

        return $array;
    }

    private function firstOrCreateVillage(): void
    {
        $this->models['village'] = Village::where($this->villageConditions())->first();
        if (!$this->models['village'])
            $this->models['village'] = Village::create($this->villageData());
    }

    private function villageConditions(): array
    {
        return [
            ['name->en', trim($this->treeLeaf->village->name)],
        ];
    }

    private function villageData(): array
    {
        $array = [
            'name' => [
                'en' => trim($this->treeLeaf->village->name),
            ],
        ];

        if (!empty($this->treeLeaf->village->othername)) {
            $array['name']['fa'] = trim($this->treeLeaf->village->othername);
        }
        return $array;
    }

    private function createLocation(): void
    {
//        $this->models['location'] = Location::where($this->locationConditions())->first();
//        if (!$this->models['location'])
            $this->models['location'] = Location::create($this->locationData());
    }

    private function locationConditions(): array
    {
        return [
            ['province_id', $this->models['province']['id']],
            ['city_id', $this->models['city']['id'] ?? null],
            ['address->en', trim($this->treeLeaf->addresse)],
            ['address->fa', trim($this->treeLeaf->addressf)],
        ];
    }

    private function locationData(): array
    {
        $data = [
            'city_id' => $this->models['city']['id'] ?? null,
            'province_id' => $this->models['province']['id'],
            'address' => [
                'en' => trim($this->treeLeaf->addresse),
                'fa' => trim($this->treeLeaf->addressf)
            ],
            'village_id' => $this->models['village']['id'] ?? null,
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
        return [
            'type' => 'species',
            'name' => $this->treeLeaf->spe->name ?? '',
        ];
    }

    private function subspeciesData(): array
    {
        return [
            'type' => 'sub_species',
            'name' => $this->treeLeaf->subspe->name ?? '',
        ];
    }

    private function varietyData(): array
    {
        return [
            'type' => 'variety',
            'name' => $this->treeLeaf->var->name ?? '',
        ];
    }

    private function taxonomyData(): array
    {
        return [
            'name' => $this->treeLeaf->name ?? null,
            'family_id' => $this->models['general']['family']['id'] ?? null,
            'genus_id' => $this->models['general']['genus']['id'] ?? null,
            'species_id' => $this->models['general']['species']['id'] ?? null,
            'subspecies_id' => $this->models['general']['subspecies']['id'] ?? null,
            'variety_id' => $this->models['general']['variety']['id'] ?? null,
        ];
    }

    private function organizationConditions(): array
    {
        return [
            ['name->en', trim($this->treeLeaf->organization)],
        ];
    }

    private function organizationData(): array
    {
        return [
            'name' => [
                'en' => trim($this->treeLeaf->organization),
            ],
        ];
    }

    private function plantHerbariumData(): array
    {
        return [
            'herbarium_number' => $this->treeLeaf->herbariumnumber,
            'cf' => $this->treeLeaf->cf,
            'description' => $this->treeLeaf['note1'],
            'is_flowering' => 0,
            'location_id' => $this->models['location']['id'],
            'organization_id' => $this->models['organization']['id'],
            'taxonomy_id' => $this->models['taxonomy']['id'],
        ];
    }

    private function actionHubCollectData(): array
    {
        return [
            'action_id' => self::ACTION['collect'],
            'actionable_type' => PlantHerbarium::class,
            'actionable_id' => $this->models['plantHerbarium']['id'],
            'date' => $this->treeLeaf->gateringdate
        ];
    }

    private function ActorCollectData($collector): array
    {
        return [
            'name' => trim($collector)
        ];
    }

    private function actorHubCollectData(): array
    {
        return [
            'actorable_type' => ActionHub::class,
            'actorable_id' => $this->models['actionHub']['collect']['id'],
            'actor_id' => $this->models['actor']['collect']['id'],
        ];
    }

    private function actionHubDetectData(): array
    {
        return [
            'action_id' => self::ACTION['detect'],
            'actionable_type' => PlantHerbarium::class,
            'actionable_id' => $this->models['plantHerbarium']['id'],
            'date' => $this->treeLeaf->identifydate
        ];
    }

    private function actorDetectData($detector): array
    {
        return [
            'name' => trim($detector)
        ];
    }

    private function actorHubDetectData(): array
    {
        return [
            'actorable_type' => ActionHub::class,
            'actorable_id' => $this->models['actionHub']['detect']['id'],
            'actor_id' => $this->models['actor']['detect']['id'],
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    private function ActorCollectConditions($collector): array
    {
        return [
            ['name', trim($collector)]
        ];
    }

    private function actorDetectConditions($detector): array
    {
        return [
            ['name', trim($detector)]
        ];
    }

    private function actorHubCollectConditions(): array
    {
        return [
            ['actorable_type', ActionHub::class],
            ['actorable_id', $this->models['actionHub']['collect']['id']],
            ['actor_id', $this->models['actor']['collect']['id']],
        ];
    }

}
