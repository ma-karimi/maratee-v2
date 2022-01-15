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
        return ['seedCollection:id,accession_code,taxonomy_data', 'collection'];
    }

    public function create($input)
    {
        $specimen_type_collections = [];

        if ($input['collection_name'] == 'Active Collection') {
            $specimen_type_collections = ['Seed in Active Collection', 'Fruit in Active Collection'];
        }
        if ($input['collection_name'] == 'Base Collection') {
            $specimen_type_collections = ['Seed in Base Collection', 'Fruit in Base Collection'];
        }
        if ($input['collection_name'] == 'Duplicate Collection') {
            $specimen_type_collections = ['Seed in Duplicate Collection', 'Fruit in Duplicate Collection'];
        }
        if ($input['collection_name'] == 'Regenerated in Base Collection') {
            $specimen_type_collections = ['Regenerated Seed in Base Collection', 'Regenerated Fruit in Base Collection'];
        }
        if ($input['collection_name'] == 'Regenerated in Active Collection') {
            $specimen_type_collections = ['Regenerated Seed in Active Collection', 'Regenerated Fruit in Active Collection'];
        }
        if ($input['collection_name'] == 'Regenerated in Duplicate Collection') {
            $specimen_type_collections = ['Regenerated Seed in Duplicate Collection', 'Regenerated Fruit in Duplicate Collection'];
        }
        return parent::create(array_merge($input, ['specimen_type_collections' => $specimen_type_collections]));
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
        })->latest()->withSum('seed_exchanges', 'exchanged_weight')->paginate($perPage ?? 25, $columns);
    }
}
