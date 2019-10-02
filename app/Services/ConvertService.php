<?php


namespace App\Services;


use App\Models\Convert\City;
use App\Models\Convert\Herbariumname;
use App\Models\Convert\Person;
use App\Models\Convert\Taxonomytree;
use App\Models\Convert\Treeleaf;
use App\Models\Organization;
use App\Models\PlantHerbarium;
use App\Models\Protection;
use App\Services\Store\LocationStore;
use App\Services\Store\TaxonomyStore;
use App\Traits\GeneralAble;
use Illuminate\Support\Facades\Log;

class ConvertService
{

    use GeneralAble;

    const IS_FLOWERING = 0;

    private $ignores = [1269,1444];

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

    private function inIgnore($id)
    {
        return in_array($id,$this->ignores);
    }

    public function treeleaf(Treeleaf $treeleaf): self
    {
        $this->treeleaf = $treeleaf;
        return $this;
    }

    public function handle()
    {
        if($this->inIgnore($this->id)){
            $this->log("- ignore treaaleaf id {$this->id}");
            return;
        }
        $this->log("- - begin convert treaaleaf id {$this->id}");
        $this->taxonomy = TaxonomyStore::store($this->taxonomyData());
        $this->log("store taxonomy id {$this->taxonomy->id} done");
        $this->location = LocationStore::store($this->locationData());
        $this->log("store location id {$this->location->id} done");
        $this->plantHerbarium = PlantHerbarium::firstOrCreate($this->plantHerbariumData());
        $this->log("store plantHerbarium id {$this->plantHerbarium->id} done");
        $this->collect = ActionService::collect($this->collectData());
        $this->log("store collect action id {$this->collect['action']->id} done");
        $this->log("store collect actionHub id {$this->collect['actionHub']->id} done");
        foreach ($this->collect['actors'] as $actor)
            $this->log("store collect actor id {$actor->id} done");
        $this->detect = ActionService::detect($this->detectData());
        $this->log("store detect action id {$this->collect['action']->id} done");
        $this->log("store detect actionHub id {$this->collect['actionHub']->id} done");
        foreach ($this->collect['actors'] as $actor)
            $this->log("store detect actor id {$actor->id} done");
        $this->log("- - end convert treaaleaf id {$this->id}");
    }

    private function getTaxonomyTreeName(int $id)
    {
        $taxonomyTree = Taxonomytree::find($id);
        return $taxonomyTree instanceof Taxonomytree ? $taxonomyTree->name : null;
    }

    private function getCity(int $id)
    {
        $city = City::find($id);
        return $city instanceof City ? $city : null;
    }

    private function getPersonName(int $id)
    {
        $person = Person::find($id);
        return $person instanceof Person ? $person->name : null;
    }

    private function getOrgan(int $id)
    {
        return Herbariumname::find($id) ?? null;
    }

    private function taxonomyData(): array
    {
        $family = $this->getTaxonomyTreeName($this->family);
        $genus = $this->getTaxonomyTreeName($this->genus);
        $species = $this->getTaxonomyTreeName($this->species);
        $subspecies = $this->getTaxonomyTreeName($this->subspecies);
        $variety = $this->getTaxonomyTreeName($this->variety);
        return [
            'name' => empty($this->name) ? null : ['en' => $this->name],
            'family_id' => $this->getGeneralId('family', $family),
            'genus_id' => $this->getGeneralId('genus', $genus),
            'species_id' => $this->getGeneralId('species', $species),
            'subspecies_id' => $this->getGeneralId('sub_species', $subspecies),
            'variety_id' => $this->getGeneralId('variety', $variety),
        ];
    }

    private function locationData(): array
    {
        $village = $this->getCity($this->city);
        $city = $village ? $this->getCity($village->parentid) : null;
        $province = $city ? $this->getCity($city->parentid) : null;
        $country = $province ? $this->getCity($province->parentid) : null;
        return [
            'village' => ['en' => trim($village->name), 'fa' => trim($village->othername)],
            'city' => ['en' => trim($city->name), 'fa' => trim($city->othername)],
            'province' => ['en' => trim($province->name), 'fa' => trim($province->othername)],
            'country' => ['en' => trim($country->name), 'fa' => trim($country->othername)],
            'address' => ['en' => trim($this->addresse), 'fa' => trim($this->addressf)],
            'min_altitude' => trim($this->minaltitude),
            'max_altitude' => trim($this->max_altitude),
            'lat' => trim($this->Latitude),
            'long' => trim($this->Longitude),
        ];
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
            $person_name = $this->getPersonName($id);
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
            $person_name = $this->getPersonName($id);
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

    private function log(string $message)
    {
        Log::channel('convert')->debug($message);
        echo "$message\n";
    }

}
