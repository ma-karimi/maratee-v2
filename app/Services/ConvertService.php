<?php


namespace App\Services;


use App\Models\Action;
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
use App\Models\Protection;
use App\Models\Province;
use App\Models\Taxonomy;
use App\Models\Village;
use Carbon\Carbon;

class ConvertService
{

    private $treeLeaf;
    private $models = [];

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
//        $this->log(" - - - - begin convert TreeLeaf id : {$this->id} - - - - ");

        // country
        if (!$this->hasCountry())
            $this->models['country'] = Country::create($this->countryData());
//        $this->log('country id : ' . $this->models['country']['id']);

        // province
        if (!$this->hasProvince())
            $this->models['province'] = Province::create($this->provinceData());
//        $this->log('province id : ' . $this->models['province']['id']);

        // city
        if (!$this->hasCity())
            $this->models['city'] = City::create($this->cityData());
//        $this->log('city id : ' . $this->models['city']['id']);

        // village
        if (!$this->hasVillage())
            $this->models['village'] = Village::create($this->villageData());
//        $this->log('village id : ' . $this->models['village']['id']);

        // location
        if (!$this->hasLocation())
            $this->models['location'] = Location::create($this->locationData());
//        $this->log('location id : ' . $this->models['location']['id']);

        // family
        if (!$this->hasFamily())
            $this->models['general']['family'] = General::create($this->familyData());
//        $this->log('family : general id : ' . $this->models['general']['family']['id']);

        // genus
        if (!$this->hasGenus())
            $this->models['general']['genus'] = General::create($this->genusData());
//        $this->log('genus : general id : ' . $this->models['general']['genus']['id']);

        // species
        if (!$this->hasSpecies())
            $this->models['general']['species'] = General::create($this->speciesData());
//        $this->log('species : general id : ' . $this->models['general']['species']['id']);

        // subspecies
        if (!$this->hasSubspecies())
            $this->models['general']['subspecies'] = General::create($this->subspeciesData());
//        $this->log('subspecies : general id : ' . $this->models['general']['subspecies']['id']);

        // variety
        if (!$this->hasVariety())
            $this->models['general']['variety'] = General::create($this->varietyData());
//        $this->log('variety : general id : ' . $this->models['general']['variety']['id']);

        // taxonomy
        if (!$this->hasTaxonomy())
            $this->models['taxonomy'] = Taxonomy::create($this->taxonomyData());
//        $this->log('taxonomy id : ' . $this->models['taxonomy']['id']);

        // organization
        if (!$this->hasOrganization())
            $this->models['organization'] = Organization::create($this->organizationData());
//        $this->log('organization id : ' . $this->models['organization']['id']);

        // protection
        if (!$this->hasProtection())
            $this->models['protection'] = Protection::create($this->protectionData());
//        $this->log('protection id : ' . $this->models['protection']['id']);

        // plant herbarium
        if (!$this->hasPlantHerbarium())
            $this->models['plantHerbarium'] = PlantHerbarium::create($this->plantHerbariumData());
//        $this->log('plantHerbarium id : ' . $this->models['plantHerbarium']['id']);

        // collect
        if (!$this->hasCollect())
            $this->models['action']['collect'] = Action::create($this->collectData());
//        $this->log('collect : action id : ' . $this->models['action']['collect']['id']);

        // collectors
        foreach ($this->collectors as $collector) {

            $this->treeLeaf['collector'] = $collector;
            if (!$this->hasCollector())
                $this->models['actor']['collect'] = Actor::create($this->collectorData());
//            $this->log('collect : actor id : ' . $this->models['actor']['collect']['id']);

            // collect hub
            if (!$this->hasCollectHub())
                $this->models['actionHub']['collect'] = ActionHub::create($this->collectHubData());
//            $this->log('collect : actionHub id : ' . $this->models['actionHub']['collect']['id']);

            // collector hub
            if (!$this->hasCollectorHub())
                $this->models['actorHub']['collect'] = ActorHub::create($this->collectorHubData());
//            $this->log('collect : actorHub id : ' . $this->models['actorHub']['collect']['id']);

        }

        // detect
        if (!$this->hasDetect())
            $this->models['action']['detect'] = Action::create($this->detectData());
//        $this->log('detect : action id : ' . $this->models['action']['detect']['id']);

        // detectors
        foreach ($this->detectors as $detector) {

            $this->treeLeaf['detector'] = $detector;
            if (!$this->hasDetector())
                $this->models['actor']['detect'] = Actor::create($this->detectorData());
//            $this->log('detect : actor id : ' . $this->models['actor']['detect']['id']);

            // collect hub
            if (!$this->hasDetectHub())
                $this->models['actionHub']['detect'] = ActionHub::create($this->detectHubData());
//            $this->log('detect : actionHub id : ' . $this->models['actionHub']['detect']['id']);

            // detect hub
            if (!$this->hasDetectorHub())
                $this->models['actorHub']['detect'] = ActorHub::create($this->detectorHubData());
//            $this->log('detect : actorHub id : ' . $this->models['actorHub']['detect']['id']);

        }

        $this->log(" - - - - end convert TreeLeaf id : {$this->id} - - - - ");

    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    private function hasCountry(): bool
    {
        $this->models['country'] = Country::where($this->countryConditions())->first();
        return $this->models['country'] instanceof Country;
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
        $this->models['province'] = Province::where($this->provinceConditions())->first();
        return $this->models['province'] instanceof Province;
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
        $this->models['city'] = City::where($this->cityConditions())->first();
        return $this->models['city'] instanceof City;
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
        $this->models['village'] = Village::where($this->villageConditions())->first();
        return $this->models['village'] instanceof Village;
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
        $this->models['location'] = Location::where($this->locationConditions())->first();
        return $this->models['location'] instanceof Location;
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

    private function hasFamily()
    {
        $this->models['general']['family'] = General::where($this->familyConditions())->first();
        return $this->models['general']['family'] instanceof General;
    }

    private function familyConditions(): array
    {
        return [
            ['type', 'family'],
            ['name->en', trim($this->family)],
        ];
    }

    private function familyData(): array
    {
        return [
            'type' => 'family',
            'name' => [
                'en' => trim($this->family)
            ]
        ];
    }

    private function hasGenus()
    {
        $this->models['general']['genus'] = General::where($this->genusConditions())->first();
        return $this->models['general']['genus'] instanceof General;
    }

    private function genusConditions(): array
    {
        return [
            ['type', 'genus'],
            ['name->en', trim($this->genus)],
        ];
    }

    private function genusData(): array
    {
        return [
            'type' => 'genus',
            'name' => [
                'en' => trim($this->genus)
            ]
        ];
    }

    private function hasSpecies()
    {
        $this->models['general']['species'] = General::where($this->speciesConditions())->first();
        return $this->models['general']['species'] instanceof General;
    }

    private function speciesConditions(): array
    {
        return [
            ['type', 'species'],
            ['name->en', trim($this->species)],
        ];
    }

    private function speciesData(): array
    {
        return [
            'type' => 'species',
            'name' => [
                'en' => trim($this->species)
            ]
        ];
    }

    private function hasSubspecies()
    {
        $this->models['general']['subspecies'] = General::where($this->subspeciesConditions())->first();
        return $this->models['general']['subspecies'] instanceof General;
    }

    private function subspeciesConditions(): array
    {
        return [
            ['type', 'sub_species'],
            ['name->en', trim($this->subspecies)],
        ];
    }

    private function subspeciesData(): array
    {
        return [
            'type' => 'sub_species',
            'name' => [
                'en' => trim($this->subspecies)
            ]
        ];
    }

    private function hasVariety()
    {
        $this->models['general']['variety'] = General::where($this->varietyConditions())->first();
        return $this->models['general']['variety'] instanceof General;
    }

    private function varietyConditions(): array
    {
        return [
            ['type', 'variety'],
            ['name->en', trim($this->variety)],
        ];
    }

    private function varietyData(): array
    {
        return [
            'type' => 'variety',
            'name' => [
                'en' => trim($this->variety)
            ]
        ];
    }

    private function hasTaxonomy(): bool
    {
        $this->models['taxonomy'] = Taxonomy::where($this->taxonomyConditions())->first();
        return $this->models['taxonomy'] instanceof Taxonomy;
    }

    private function taxonomyConditions(): array
    {
        return [
            ['name->en', trim($this->name)],
            ['name->fa', trim($this->othername)],
            ['family_id', $this->models['general']['family']['id']],
            ['genus_id', $this->models['general']['genus']['id']],
            ['species_id', $this->models['general']['species']['id']],
            ['subspecies_id', $this->models['general']['subspecies']['id']],
            ['variety_id', $this->models['general']['variety']['id']],
        ];
    }

    private function taxonomyData(): array
    {
        return [
            'name' => [
                'en' => trim($this->name),
                'fa' => trim($this->othername),
            ],
            'family_id' => $this->models['general']['family']['id'],
            'genus_id' => $this->models['general']['genus']['id'],
            'species_id' => $this->models['general']['species']['id'],
            'subspecies_id' => $this->models['general']['subspecies']['id'],
            'variety_id' => $this->models['general']['variety']['id'],
        ];
    }

    private function hasOrganization(): bool
    {
        $this->models['organization'] = Organization::where($this->organizationConditions())->first();
        return $this->models['organization'] instanceof Organization;
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
            'phone' => '',
        ];
    }

    private function hasProtection(): bool
    {
        $this->models['protection'] = Protection::where($this->protectionConditions())->first();
        return $this->models['protection'] instanceof Protection;
    }

    private function protectionConditions(): array
    {
        return [
            ['name->en', trim($this->protection)],
        ];
    }

    private function protectionData(): array
    {
        return [
            'name' => [
                'en' => trim($this->protection),
            ],
        ];
    }

    private function hasPlantHerbarium(): bool
    {
        $this->models['plantHerbarium'] = PlantHerbarium::where($this->plantHerbariumConditions())->first();
        return $this->models['plantHerbarium'] instanceof PlantHerbarium;
    }

    private function plantHerbariumConditions(): array
    {
        return [
            ['herbarium_number', $this->herbariumnumber],
            ['cf', $this->cf],
            ['is_flowering', 0],
            ['location_id', $this->models['location']['id']],
            ['organization_id', $this->models['organization']['id']],
            ['taxonomy_id', $this->models['taxonomy']['id']],
            ['protection_id', $this->models['protection']['id']],
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
            'protection_id' => $this->models['protection']['id'],
        ];
    }

    private function hasCollect(): bool
    {
        $this->models['action']['collect'] = Action::where($this->collectConditions())->first();
        return $this->models['action']['collect'] instanceof Action;
    }

    private function collectConditions(): array
    {
        return [
            ['name->en', Action::TYPES['collect']],
        ];
    }

    private function collectData(): array
    {
        return [
            'name' => [
                'en' => Action::TYPES['collect'],
            ],
        ];
    }

    private function hasCollector(): bool
    {
        $this->models['actor']['collect'] = Actor::where($this->collectorConditions())->first();
        return $this->models['actor']['collect'] instanceof Actor;
    }

    private function collectorConditions(): array
    {
        return [
            ['name->en', $this->collector],
        ];
    }

    private function collectorData(): array
    {
        return [
            'name' => [
                'en' => $this->collector,
            ],
        ];
    }

    private function hasCollectHub(): bool
    {
        $this->models['actionHub']['collect'] = ActionHub::where($this->collectHubConditions())->first();
        return $this->models['actionHub']['collect'] instanceof ActionHub;
    }

    private function collectHubConditions(): array
    {
        return [
            ['action_id', $this->models['action']['collect']['id']],
            ['actionable_type', PlantHerbarium::class],
            ['actionable_id', $this->models['plantHerbarium']['id']],
        ];
    }

    private function collectHubData(): array
    {
        return [
            'action_id' => $this->models['actor']['collect']['id'],
            'actionable_type' => PlantHerbarium::class,
            'actionable_id' => $this->models['plantHerbarium']['id'],
            'date' => $this->gateringdate
        ];
    }

    private function hasCollectorHub(): bool
    {
        $this->models['actorHub']['collect'] = ActorHub::where($this->collectorHubConditions())->first();
        return $this->models['actorHub']['collect'] instanceof ActorHub;
    }

    private function collectorHubConditions(): array
    {
        return [
            ['actorable_type', ActionHub::class],
            ['actorable_id', $this->models['actionHub']['collect']['id']],
            ['actor_id', $this->models['actor']['collect']['id']],
        ];
    }

    private function collectorHubData(): array
    {
        return [
            'actorable_type' => ActionHub::class,
            'actorable_id' => $this->models['actionHub']['collect']['id'],
            'actor_id' => $this->models['actor']['collect']['id'],
        ];
    }

    private function hasDetect(): bool
    {
        $this->models['action']['detect'] = Action::where($this->detectConditions())->first();
        return $this->models['action']['detect'] instanceof Action;
    }

    private function detectConditions(): array
    {
        return [
            ['name->en', Action::TYPES['detect']],
        ];
    }

    private function detectData(): array
    {
        return [
            'name' => [
                'en' => Action::TYPES['detect'],
            ],
        ];
    }

    private function hasDetector(): bool
    {
        $this->models['actor']['detect'] = Actor::where($this->detectorConditions())->first();
        return $this->models['actor']['detect'] instanceof Actor;
    }

    private function detectorConditions(): array
    {
        return [
            ['name->en', $this->detector],
        ];
    }

    private function detectorData(): array
    {
        return [
            'name' => [
                'en' => $this->detector,
            ],
        ];
    }

    private function hasDetectHub(): bool
    {
        $this->models['actionHub']['detect'] = ActionHub::where($this->detectHubConditions())->first();
        return $this->models['actionHub']['detect'] instanceof ActionHub;
    }

    private function detectHubConditions(): array
    {
        return [
            ['actionable_type', PlantHerbarium::class],
            ['actionable_id', $this->models['plantHerbarium']['id']],
            ['action_id', $this->models['action']['detect']['id']],
        ];
    }

    private function detectHubData(): array
    {
        return [
            'actionable_type' => PlantHerbarium::class,
            'actionable_id' => $this->models['plantHerbarium']['id'],
            'action_id' => $this->models['action']['detect']['id'],
            'date' => $this->identifydate
        ];
    }

    private function hasDetectorHub(): bool
    {
        $this->models['actorHub']['detect'] = ActorHub::where($this->detectorHubConditions())->first();
        return $this->models['actorHub']['detect'] instanceof ActorHub;
    }

    private function detectorHubConditions(): array
    {
        return [
            ['actorable_type', ActionHub::class],
            ['actorable_id', $this->models['actionHub']['detect']['id']],
            ['actor_id', $this->models['actor']['detect']['id']],
        ];
    }

    private function detectorHubData(): array
    {
        return [
            'actorable_type' => ActionHub::class,
            'actorable_id' => $this->models['actionHub']['detect']['id'],
            'actor_id' => $this->models['actor']['detect']['id'],
        ];
    }
}
