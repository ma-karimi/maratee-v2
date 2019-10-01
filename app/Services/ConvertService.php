<?php


namespace App\Services;


use App\Models\Convert\Convert;
use App\Models\Convert\City;
use App\Models\Convert\Herbariumname;
use App\Models\Convert\Person;
use App\Models\Convert\Taxonomytree;
use App\Models\Convert\Treeleaf;
use App\Models\General;
use App\Models\Organization;
use App\Models\PlantHerbarium;
use App\Models\Protection;
use App\Services\Store\LocationStore;
use App\Services\Store\TaxonomyStore;
use App\Traits\GeneralAble;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConvertService
{

    use GeneralAble;

    const IS_FLOWERING = 0;

    private $treeleaf;
    private $taxonomy;
    private $location;
    private $plantHerbarium;
    private $collect;
    private $detect;

    public function __get($name)
    {
        return $this->treeleaf->$name ?? null;
    }

    public function treeleaf(Treeleaf $treeleaf): self
    {
        $this->treeleaf = $treeleaf;
        return $this;
    }

    public function handle()
    {
        Log::channel('convert')->debug("- - begin convert treaaleaf id {$this->id}");
        $this->taxonomy = TaxonomyStore::store($this->taxonomyData());
        Log::channel('convert')->debug("store taxonomy id {$this->taxonomy->id} done");
        $this->location = LocationStore::store($this->locationData());
        Log::channel('convert')->debug("store location id {$this->location->id} done");
        $this->plantHerbarium = PlantHerbarium::firstOrCreate($this->plantHerbariumData());
        Log::channel('convert')->debug("store plantHerbarium id {$this->plantHerbarium->id} done");
        $this->collect = ActionService::collect($this->collectData());
        Log::channel('convert')->debug("store collect action id {$this->collect['action']->id} done");
        Log::channel('convert')->debug("store collect actionHub id {$this->collect['actionHub']->id} done");
        foreach ($this->collect['actors'] as $actor)
            Log::channel('convert')->debug("store collect actor id {$actor->id} done");
        $this->detect = ActionService::detect($this->detectData());
        Log::channel('convert')->debug("store detect action id {$this->collect['action']->id} done");
        Log::channel('convert')->debug("store detect actionHub id {$this->collect['actionHub']->id} done");
        foreach ($this->collect['actors'] as $actor)
            Log::channel('convert')->debug("store detect actor id {$actor->id} done");
        // store states for rollback
//        $convert = Convert::firstOrCreate($this->convertData());
        Log::channel('convert')->debug("- - end convert treaaleaf id {$this->id}");
//        return $convert;
    }

    private function getTaxonomyTree(int $id): Taxonomytree
    {
        return Taxonomytree::find($id);
    }

    private function getCity(int $id): City
    {
        return City::find($id);
    }

    private function getPerson(int $id)
    {
        return Person::find($id);
    }

    private function getOrgan(int $id)
    {
        return Herbariumname::find($id) ?? null;
    }

    private function taxonomyData(): array
    {
        return [
            'name' => ['en' => $this->name, 'fa' => $this->name],
            'family' => $this->getTaxonomyTree($this->family)->name,
            'genus' => $this->getTaxonomyTree($this->genus)->name,
            'species' => $this->getTaxonomyTree($this->species)->name,
            'subspecies' => $this->getTaxonomyTree($this->subspecies)->name,
            'variety' => $this->getTaxonomyTree($this->variety)->name,
        ];
    }

    private function locationData(): array
    {
        $village = $this->getCity($this->city);
        $city = $this->getCity($village->parentid);
        $province = $this->getCity($city->parentid);
        $country = $this->getCity($province->parentid);
        // village
        if (!empty($village->name))
            $data['village']['en'] = trim($village->name);
        if (!empty($village->othername))
            $data['village']['fa'] = trim($village->othername);
        // city
        if (!empty($city->name))
            $data['city']['en'] = trim($city->name);
        if (!empty($city->othername))
            $data['city']['fa'] = trim($city->othername);
        // province
        if (!empty($province->name))
            $data['province']['en'] = trim($province->name);
        if (!empty($province->othername))
            $data['province']['fa'] = trim($province->othername);
        // country
        if (!empty($country->name))
            $data['country']['en'] = trim($country->name);
        if (!empty($country->othername))
            $data['country']['fa'] = trim($country->othername);
        // address
        $data['address']['en'] = trim($this->addresse);
        if (strlen($this->addressf))
            $data['address']['fa'] = trim($this->addressf);
        $data['min_altitude'] = trim($this->minaltitude);
        $data['min_altitude'] = trim($this->minaltitude);
        $data['max_altitude'] = trim($this->maxaltitude);
        $data['lat'] = trim($this->Latitude);
        $data['long'] = trim($this->Longitude);
        return $data;
    }

    private function plantHerbariumData(): array
    {
        return [
            'herbarium_number' => $this->herbariumnumber,
            'cf' => $this->cf,
            'is_flowering' => self::IS_FLOWERING,
            'location_id' => $this->location->id,
            'taxonomy_id' => $this->taxonomy->id,
            'organization_id' => $this->getOrganization()->id,
            'protection_id' => Protection::firstOrCreate($this->protectionData())->id,
        ];
    }

    private function getOrganization()
    {
        $name = $this->getOrgan($this->herbariumname);
        $organ = Organization::where('name->en', $name)->get();
        if ($organ instanceof Organization)
            return $organ;
        return Organization::firstOrCreate($this->organData());
    }

    private function organData(): array
    {
        return [
            'is_herbarium' => 1,
            'name' => $this->getOrgan($this->herbariumname),
            'phone' => '',
        ];
    }

    private function getProtection()
    {
        $organ = Protection::where('name->en', 'DD')->get();
        if ($organ instanceof Organization)
            return $organ;
        return Protection::firstOrCreate($this->protectionData());
    }

    private function protectionData(): array
    {
        return [
            'name' => 'dd'
        ];
    }

    private function collectData(): array
    {
        return [
            'location_id' => $this->location->id,
            'date' => $this->gatheringdate,
            'names' => $this->getCollectors(),
        ];
    }

    private function getCollectors(): array
    {
        $persons = [];
        $persons_id = explode('&', $this->gatherer);
        foreach ($persons_id as $id) {
            $person_name = $this->getPerson($id)->name;
            $names = explode('&', $person_name);
            $persons = array_merge($persons, $names);
        }
        return $persons;
    }

    private function detectData(): array
    {
        return [
            'location_id' => $this->location->id,
            'date' => $this->identifydate,
            'names' => $this->getDetectors(),
        ];
    }

    private function getDetectors(): array
    {
        $persons = [];
        $persons_id = explode('&', $this->detector);
        foreach ($persons_id as $id) {
            if (empty($id))
                continue;
            $person_name = $this->getPerson($id)->name;
            $names = explode('&', $person_name);
            $persons = array_merge($persons, $names);
        }
        return $persons;
    }


    private function convertData(): array
    {
        $collectors_id = [];
        $detectors_id = [];
        foreach ($this->collect['actors'] as $actor)
            $collectors_id[] = $actor->id;
        foreach ($this->detect['actors'] as $actor)
            $detectors_id[] = $actor->id;
        return [
            'treeleaf_id' => $this->id,
            'taxonomy_id' => $this->taxonomy->id,
            'location_id' => $this->location->id,
            'plant_herbarium_id' => $this->plantHerbarium->id,
            'collect_action_id' => $this->collect['action']->id,
            'collect_actionHub_id' => $this->collect['actionHub']->id,
            'collect_actors_id' => sizeof($collectors_id) ? implode('-', $collectors_id) : null,
            'detect_action_id' => $this->detect['action']->id,
            'detect_actionHub_id' => $this->detect['actionHub']->id,
            'detect_actors_id' => sizeof($detectors_id) ? implode('-', $detectors_id) : null,
        ];
    }

}
