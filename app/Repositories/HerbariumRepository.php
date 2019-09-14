<?php

namespace App\Repositories;

use App\Models\Herbarium;
use Illuminate\Http\UploadedFile;

/**
 * Class HerbariumRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:14 am UTC
 */
class HerbariumRepository extends BaseRepository
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
        return Herbarium::class;
    }

    public function update($input, $id)
    {
      /*  $herbarium_input = [
            'organization_id' => $input['organization_id'],
            'plant_id' => $input['plant_id'],
            'number' => $input['number'] ?? null,
            'sheets_no' => $input['sheets_no'] ?? null,
            'samples_no' => $input['samples_no'] ?? null,
            'tip_qt' => $input['tip_qt'] ?? null,
            'physical_tip_qt' => $input['physical_tip_qt'] ?? null,
            'description' => $input['description'] ?? null,
        ];*/
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
