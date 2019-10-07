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
            $this->firstOrCreateProvince();

            if (!empty(trim($this->treeLeaf->village->parent['name']))) {
                $this->firstOrCreateCity();
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
            $this->firstOrCreateLocation();


        } elseif (!empty($this->treeLeaf->cityR) && !empty($this->treeLeaf->cityR->parent)) {

            $this->firstOrCreateProvince();

            if (!empty(trim($this->treeLeaf->cityR['name']))) {

                $this->firstOrCreateCity();

            } else {
                $this->models['city'] = null;
            }
            // location
            $this->firstOrCreateLocation();

        } elseif (!empty($this->treeLeaf->provinceR) && !empty($this->treeLeaf->provinceR['name'])) {
            $this->firstOrCreateProvince();


            // location
            $this->firstOrCreateLocation();


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

        if ($this->treeLeaf->collect) {
            $collectors = explode('&', $this->treeLeaf->collect->name);
            // action hub collect
            $this->models['actionHub']['collect'] = ActionHub::create($this->actionHubCollectData());

            foreach ($collectors as $collector) {

                // collector
                $this->models['actor']['collect'] = Actor::where($this->ActorCollectConditions($collector))->first();
                if (!$this->models['actor']['collect'])
                    $this->models['actor']['collect'] = Actor::create($this->ActorCollectData($collector));

                // actor hub collect
                $this->models['actorHub']['collect'] = ActorHub::create($this->actorHubCollectData());

            }
        }

        // action hub detect
        if ($this->treeLeaf->detect) {
            $detectors = explode('&', $this->treeLeaf->detect->name);

            $this->models['actionHub']['detect'] = ActionHub::create($this->actionHubDetectData());

            foreach ($detectors as $detector) {

                // detector
                $this->models['actor']['detect'] = Actor::where($this->actorDetectConditions($detector))->first();
                if (!$this->models['actor']['detect'])
                    $this->models['actor']['detect'] = Actor::create($this->actorDetectData($detector));

                // detect hub
                $this->models['actorHub']['detect'] = ActorHub::create($this->actorHubDetectData());

            }
        }

        $this->log(" - - - - end convert TreeLeaf id : {$this->id} - - - - ");

    }

    private function firstOrCreateProvince(): void
    {
        $this->models['province'] = Province::where($this->provinceConditions())->first();
        if (!$this->models['province'])
            $this->models['province'] = Province::create($this->provinceData());
    }

    private function provinceConditions(): array
    {
        return [
            ['name->en', trim($this->treeLeaf->village->parent->parent->name)],
        ];
    }

    private function provinceData(): array
    {
        return [
            'name' => [
                'en' => trim($this->treeLeaf->village->parent->parent->name ?? ''),
                'fa' => trim($this->treeLeaf->village->parent->parent->othername ?? ''),
            ],
            'country_id' => 1
        ];
    }

    private function firstOrCreateCity(): void
    {
        $this->models['city'] = City::where($this->cityConditions())->first();
        if (!$this->models['city'])
            $this->models['city'] = City::create($this->cityData());
    }

    private function cityConditions(): array
    {
        return [
            ['name->en', trim($this->treeLeaf->village->parent->name)],
        ];
    }

    private function cityData(): array
    {
        return [
            'name' => [
                'en' => trim($this->treeLeaf->village->parent->name),
                'fa' => trim($this->treeLeaf->village->parent->othername),
            ],
            'province_id' => $this->models['province']['id']
        ];
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
        return [
            'name' => [
                'en' => trim($this->treeLeaf->village->name),
                'fa' => trim($this->treeLeaf->village->othername),
            ]
        ];
    }

    private function firstOrCreateLocation(): void
    {
        $this->models['location'] = Location::where($this->locationConditions())->first();
        if (!$this->models['location'])
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
            'family_id' => $this->models['general']['family']['id'],
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

    private function ActorCollectConditions($collector): array
    {
        return [
            ['name->en', trim($collector)],
        ];
    }

    private function ActorCollectData($collector): array
    {
        return [
            'name' => [
                'en' => trim($collector),
            ],
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

    private function actorDetectConditions($detector): array
    {
        return [
            ['name->en', trim($detector)],
        ];
    }

    private function actorDetectData($detector): array
    {
        return [
            'name' => [
                'en' => trim($detector),
            ],
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

    private function actorHubCollectConditions(): array
    {
        return [
            ['actorable_type', ActionHub::class],
            ['actorable_id', $this->models['actionHub']['collect']['id']],
            ['actor_id', $this->models['actor']['collect']['id']],
        ];
    }

}
