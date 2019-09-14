<?php

namespace App\Repositories;

use App\Models\Garden;
use App\Repositories\BaseRepository;

/**
 * Class GardenRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:12 am UTC
*/

class GardenRepository extends BaseRepository
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
        return Garden::class;
    }
    public function update($input, $id)
    {
        $media_input = [
            'date' => $input['date'] ?? null,
            'user_id' => $input['user_id'] ?? null,
            'location_id' => $input['location_id'] ?? null,
            'description' => $input['description'] ?? null,
            'media_type' => $input['media_type'] ?? 2,
            'reference' => $input['reference'] ?? null,
        ];

        $model_input = collect($input)->except(array_keys($media_input))->toArray();
        unset($model_input['file']);
        $model = parent::update($model_input, $id);
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('media');
            $media_record->update($media_input);
        }
        $model->save();
        return $model;
    }
}
