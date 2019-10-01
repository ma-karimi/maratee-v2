<?php


namespace App\Services\Store;


use App\Models\Taxonomy;
use App\Traits\GeneralAble;

class TaxonomyStore extends BaseStore
{

    use GeneralAble;

    protected static $model = Taxonomy::class;

    protected function data(): array
    {
        $family_id = $this->getGeneralId('family', $this->family);
        $genus_id = $this->getGeneralId('genus', $this->genus, $family_id);
        $species_id = $this->getGeneralId('species', $this->species, $genus_id);
        $subspecies_id = $this->getGeneralId('subspecies', $this->subspecies, $species_id);
        $variety_id = $this->getGeneralId('variety', $this->subspecies, $subspecies_id);
        return compact('family_id', 'genus_id', 'species_id', 'subspecies_id', 'variety_id');
    }

}
