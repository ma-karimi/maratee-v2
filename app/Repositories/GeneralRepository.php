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

    public function allWithType($type)
    {
        if (!in_array($type, General::TYPES)) {
            throw ValidationException::withMessages(['errors' => ['message' => 'Operation Failed!']]);
        }
        return $this->model->whereType($type)->get();
    }
}
