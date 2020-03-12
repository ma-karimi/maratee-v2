<?php

namespace App\Repositories;

use App\Models\PaleobotanyGeneral;

/**
 * Class PaleobotanyGeneralRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class PaleobotanyGeneralRepository extends BaseRepository
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
        return PaleobotanyGeneral::class;
    }



    public function create($input)
    {
        $model = parent::create($this->setPrimaryData($input));
        $this->createHub($model->id, 'authors', request()->filled('authors') ? $input['authors'] : []);

        return $model;
    }

    public function update($input, $id)
    {
        $model = parent::update($this->setPrimaryData($input), $id);
        $this->createHub($model->id, 'authors', request()->filled('authors') ? $input['authors'] : []);

        return $model;
    }

    /**
     * @param $input
     * @return array
     */
    private function setPrimaryData($input): array
    {
        return collect($input)->except('authors')->all();
    }
}
