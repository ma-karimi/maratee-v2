<?php


namespace App\Services;


use App\Models\ActionHub;
use App\Models\Actor;
use App\Models\ActorHub;
use App\Models\City;
use App\Models\Convert\Treeleaf;
use App\Models\Country;
use App\Models\General;
use App\Models\Location;
use App\Models\Organization;
use App\Models\PlantHerbarium;
use App\Models\Province;
use App\Models\Taxonomy;
use App\Models\Village;

class ConvertService
{

    private $treeLeaf;
    private $models = [];
    private CONST ACTION = [
        'detect' => 1, 'collect' => 2
    ];


    public function __get($name)
    {
        return $this->treeLeaf[$name] ?? null;
    }

    public function treeLeaf(Treeleaf $treeLeaf): self
    {
        $this->treeLeaf = $treeLeaf;
        return $this;
    }

    public function handle()
    {

        // country
        $this->models['country'] = Country::where($this->countryConditions())->first();
        if (!$this->hasCountry())
            $this->models['country'] = Country::create($this->countryData());

        // province
        $this->models['province'] = Province::where($this->provinceConditions())->first();
        if (!$this->hasProvince())
            $this->models['province'] = Province::create($this->provinceData());

        // city
        $this->models['city'] = City::where($this->cityConditions())->first();
        if (!$this->hasCity())
            $this->models['city'] = City::create($this->cityData());

        // village
        $this->models['village'] = Village::where($this->villageConditions())->first();
        if (!$this->hasVillage())
            $this->models['village'] = Village::create($this->villageData());

        // location
        $this->models['location'] = Location::where($this->locationConditions())->first();
        if (!$this->hasLocation())
            $this->models['location'] = Location::create($this->locationData());


        if (!empty($this->gatherer)) {

            // action hub collect
            $this->models['actionHub']['collect'] = ActionHub::create($this->actionHubCollectData());

            foreach ($this->collectors as $collector) {

                $this->treeLeaf['collector'] = $collector;

                // collector
                $this->models['actor']['collect'] = Actor::where($this->ActorCollectConditions())->first();
                if (!$this->hasActorCollect())
                    $this->models['actor']['collect'] = Actor::create($this->ActorCollectData());

                // actor hub collect
                $this->models['actorHub']['collect'] = ActorHub::where($this->actorHubCollectConditions())->first();
                if (!$this->hasActorHubCollect())
                    $this->models['actorHub']['collect'] = ActorHub::create($this->actorHubCollectData());

            }
        }

        // action hub detect
        if (!empty($this->detector)) {

            $this->models['actionHub']['detect'] = ActionHub::create($this->actionHubDetectData());

            foreach ($this->detectors as $detector) {

                $this->treeLeaf['detector'] = $detector;

                // detector
                $this->models['actor']['detect'] = Actor::where($this->actorDetectConditions())->first();
                if (!$this->hasActorDetect())
                    $this->models['actor']['detect'] = Actor::create($this->actorDetectData());

                // detect hub
                $this->models['actorHub']['detect'] = ActorHub::where($this->actorHubDetectConditions())->first();
                if (!$this->hasActorHubDetect())
                    $this->models['actorHub']['detect'] = ActorHub::create($this->actorHubDetectData());

            }
        }

        // family
        $this->models['general']['family'] = General::firstOrCreate($this->familyData());

        // genus
        if(!empty($this->genus))
            $this->models['general']['genus'] = General::firstOrCreate($this->genusData());

        // species
        if(!empty($this->species))
            $this->models['general']['species'] = General::firstOrCreate($this->speciesData());

        // subspecies
        if(!empty($this->subspecies))
            $this->models['general']['subspecies'] = General::firstOrCreate($this->subspeciesData());

        // variety
        if(!empty($this->variety))
            $this->models['general']['variety'] = General::firstOrCreate($this->varietyData());

        // taxonomy
        $this->models['taxonomy'] = Taxonomy::firstOrCreate($this->taxonomyData());

        // organization
        $this->models['organization'] = Organization::where($this->organizationConditions())->first();
        if (!$this->hasOrganization())
            $this->models['organization'] = Organization::create($this->organizationData());

        // plant herbarium
        $this->models['plantHerbarium'] = PlantHerbarium::create($this->plantHerbariumData());

        $this->log(" - - - - end convert TreeLeaf id : {$this->id} - - - - ");

    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    private function hasCountry(): bool
    {
        return $this->models['country'];
    }

    private function countryConditions(): array
    {
        return [
            ['name->en', $this->country['en']],
            ['name->fa', $this->country['fa']],
        ];
    }

    private function countryData()
    {
        return [
            'name' => $this->country
        ];
    }

    private function hasProvince(): bool
    {
        return $this->models['province'];
    }

    private function provinceConditions(): array
    {
        return [
            ['name->en', $this->province['en']],
        ];
    }

    private function provinceData(): array
    {
        return [
            'name' => $this->province,
            'country_id' => $this->models['country']['id']
        ];
    }

    private function hasCity(): bool
    {
        return $this->models['city'];
    }

    private function cityConditions(): array
    {
        return [
            ['name->en', $this->cityConvert['en']],
        ];
    }

    private function cityData(): array
    {
        return [
            'name' => $this->cityConvert,
            'province_id' => $this->models['province']['id']
        ];
    }

    private function hasVillage(): bool
    {
        return $this->models['village'];
    }

    private function villageConditions(): array
    {
        return [
            ['name->en', $this->village['en']],
        ];
    }

    private function villageData(): array
    {
        return [
            'name' => $this->village
        ];
    }

    private function hasLocation(): bool
    {
        return $this->models['location'];
    }

    private function locationConditions(): array
    {
        return [
            ['city_id', $this->models['city']['id']],
            ['address->en', trim($this->addresse)],
            ['address->fa', trim($this->addressf)],
        ];
    }

    private function locationData(): array
    {
        $data = [
            'city_id' => $this->models['city']['id'],
            'address' => [
                'en' => trim($this->addresse),
                'fa' => trim($this->addressf)
            ],
            'village_id' => $this->models['village']['id'] ?? null,
            'min_altitude' => $this->minaltitude,
            'max_altitude' => $this->maxaltitude,
        ];
        if ($this->hasPoint())
            $data['point'] = $this->getPoint();
        return $data;
    }

    private function hasPoint(): bool
    {
        return strlen($this->latitude) && strlen($this->longitude);
    }

    private function getPoint(): array
    {
        return [
            $this->latitude, $this->longitude
        ];
    }

    private function hasOrganization(): bool
    {
        return $this->models['organization'];
    }

    private function organizationConditions(): array
    {
        return [
            ['name->en', trim($this->organization)],
        ];
    }

    private function organizationData(): array
    {
        return [
            'name' => [
                'en' => trim($this->organization),
            ],
        ];
    }

    private function plantHerbariumData(): array
    {
        return [
            'herbarium_number' => $this->herbariumnumber,
            'cf' => $this->cf,
            'is_flowering' => 0,
            'location_id' => $this->models['location']['id'],
            'organization_id' => $this->models['organization']['id'],
            'taxonomy_id' => $this->models['taxonomy']['id'],
        ];
    }

    private function hasActorCollect(): bool
    {
        return $this->models['actor']['collect'];
    }

    private function ActorCollectConditions(): array
    {
        return [
            ['name->en', $this->collector],
        ];
    }

    private function ActorCollectData(): array
    {
        return [
            'name' => [
                'en' => $this->collector,
            ],
        ];
    }

    private function actionHubCollectData(): array
    {
        return [
            'action_id' => self::ACTION['collect'],
            'actionable_type' => PlantHerbarium::class,
            'actionable_id' => $this->models['plantHerbarium']['id'],
            'date' => $this->gateringdate
        ];
    }

    private function hasActorHubCollect(): bool
    {
        return $this->models['actorHub']['collect'];
    }

    private function actorHubCollectConditions(): array
    {
        return [
            ['actorable_type', ActionHub::class],
            ['actorable_id', $this->models['actionHub']['collect']['id']],
            ['actor_id', $this->models['actor']['collect']['id']],
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

    private function hasActorDetect(): bool
    {
        return $this->models['actor']['detect'];
    }

    private function actorDetectConditions(): array
    {
        return [
            ['name->en', $this->detector],
        ];
    }

    private function actorDetectData(): array
    {
        return [
            'name' => [
                'en' => $this->detector,
            ],
        ];
    }

    private function actionHubDetectData(): array
    {
        return [
            'action_id' => self::ACTION['detect'],
            'actionable_type' => PlantHerbarium::class,
            'actionable_id' => $this->models['plantHerbarium']['id'],
            'date' => $this->identifydate
        ];
    }

    private function hasActorHubDetect(): bool
    {
        return $this->detector && $this->models['actorHub']['detect'];
    }

    private function actorHubDetectConditions(): array
    {
        return [
            ['actorable_type', ActionHub::class],
            ['actorable_id', $this->models['actionHub']['detect']['id']],
            ['actor_id', $this->models['actor']['detect']['id']],
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

    private function familyData(): array
    {
        return [
            'type' => 'family',
            'name' => trim($this->family)
        ];
    }

    private function genusData(): array
    {
        return [
            'type' => 'genus',
            'name' => trim($this->genus),
        ];
    }

    private function speciesData(): array
    {
        return [
            'type' => 'species',
            'name' => trim($this->species),
        ];
    }

    private function subspeciesData(): array
    {
        return [
            'type' => 'sub_species',
            'name' => trim($this->subspecies),
        ];
    }

    private function varietyData(): array
    {
        return [
            'type' => 'variety',
            'name' => trim($this->variety),
        ];
    }

    private function taxonomyData(): array
    {
        return [
            'name' => $this->name,
            'family_id' => $this->models['general']['family']
        ];
    }

}
