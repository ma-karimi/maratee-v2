<?php

namespace App\Repositories;

use App\Models\MedicinalPlant;
use App\Models\MedicinalPlantConstituent;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

/**
 * Class MedicinalPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantRepository extends BaseRepository
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
        return MedicinalPlant::class;
    }

    public function create($input)
    {
        $model=parent::create(Arr::except($input,'life_forms'));
        $this->storeLifeForm($input, $model);
    }

    public function update($input, $id)
    {
        $model=parent::update(Arr::except($input,'life_forms'),$id);
        $this->storeLifeForm($input, $model);
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    private function storeLifeForm($input, \Illuminate\Database\Eloquent\Model $model): void
    {
        $model->cycle_id = $input['life_forms']['cycle_id'] ?? null;
        $model->wooden_id = $input['life_forms']['wooden_id'] ?? null;
        $model->herbaceous_id = $input['life_forms']['herbaceous_id'] ?? null;
        $model->save();
    }

}
