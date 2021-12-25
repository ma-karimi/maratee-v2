<?php

namespace App\Repositories;

use App\Models\SeedWeight;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class SeedWeightRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:20 am UTC
 */
class SeedWeightRepository extends BaseRepository
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
        return SeedWeight::class;
    }

    public function getRelationFields()
    {
        return ['seedCollection:id,accession_code,taxonomy_id', 'collection'];
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $search
     * @param array|null $with_relations
     * @param array $columns
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function paginate($perPage, array $search = [], array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->latest()->withSum('seed_exchanges', 'seed_weight_value')->withSum('seed_exchanges', 'fruit_weight_value')->paginate($perPage ?? 25, $columns);
    }
}
