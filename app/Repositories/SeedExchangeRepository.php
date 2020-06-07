<?php

namespace App\Repositories;

use App\Models\SeedExchange;
use Illuminate\Container\Container as Application;

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
     * @var ProjectRepository
     */
    private $projectRepo;

    public function __construct(Application $app, ProjectRepository $projectRepo)
    {
        parent::__construct($app);

        $this->projectRepo = $projectRepo;
    }

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
        return ['organization.city', 'organization:id,name_en,city_id', 'specimenType', 'seedCollection:id,accession_code,taxonomy_id', 'collection'];
    }
}
