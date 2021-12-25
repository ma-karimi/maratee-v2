<?php

namespace App\Repositories;

use App\Models\SeedExchange;

/**
 * Class SeedExchangeRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class SeedExchangeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SeedExchange::class;
    }

    public function getRelationFields()
    {
        return ['organization.city', 'organization:id,name_en,city_id', 'seed_weight.seedCollection', 'seed_weight.collection'];
    }
}
