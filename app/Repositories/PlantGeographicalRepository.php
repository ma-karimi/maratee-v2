<?php

namespace App\Repositories;

use App\Models\PlantGeographical;

/**
 * Class PlantGeographicalRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:06 am UTC
 */
class PlantGeographicalRepository extends BaseRepository
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
        return PlantGeographical::class;
    }

    public function store($input)
    {
        $geographicals = $input['geographical_ids'];
        $this->model->where('plant_id', $input['plant_id'])
            ->whereNotIn('geographical_id', $geographicals)
            ->delete();
        if (count($geographicals)) {
            foreach ($geographicals as $item) {
                $this->model->firstOrCreate([
                    'plant_id' => $input['plant_id'],
                    'geographical_id' => $item,
                ]);
            }
        }
    }
}
