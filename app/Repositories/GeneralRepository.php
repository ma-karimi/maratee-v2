<?php

namespace App\Repositories;

use App\Models\General;
use Illuminate\Validation\ValidationException;

/**
 * Class GeneralRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class GeneralRepository extends BaseRepository
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
        return General::class;
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

    public function allWithType($type)
    {
        if (!in_array($type, General::TYPES)) {
            throw ValidationException::withMessages(['errors' => ['message' => 'Operation Failed!']]);
        }
        return $this->model->whereType($type)->get();
    }

    /**
     * @param $input
     * @return array
     */
    private function setPrimaryData($input): array
    {
        return collect($input)->except('authors')->all();
    }

    /**
     * @return array
     */
    public function getRelationFields(): array
    {
        return ['authors'];
    }
}
