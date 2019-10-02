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
        return $this->data;
    }

}
