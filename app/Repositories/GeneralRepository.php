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
        //        $this->createHub($model->id, 'authors', request()->filled('authors') ? $input['authors'] : []);
        if (General::where($this->setPrimaryData($input))->exist()) {

        }
        return parent::create($this->setPrimaryData($input));
    }

    /**
     * @param $input
     * @return array
     */
    private function setPrimaryData($input): array
    {
        return collect($input)->except('authors')->all();
    }

    public function update($input, $id)
    {
        //        $this->createHub($model->id, 'authors', request()->filled('authors') ? $input['authors'] : []);

        return parent::update($this->setPrimaryData($input), $id);
    }

    public function allWithType($type)
    {
        if (!in_array($type, General::TYPES)) {
            throw ValidationException::withMessages(['errors' => ['message' => 'Operation Failed!']]);
        }
        return $this->model->whereType($type)->get();
    }
}
