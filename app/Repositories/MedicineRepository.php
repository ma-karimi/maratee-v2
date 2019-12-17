<?php

namespace App\Repositories;

use App\Models\{Medicine, MedicineIndustry};

/**
 * Class MedicineRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:24 am UTC
 */
class MedicineRepository extends BaseRepository
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
        return Medicine::class;
    }


    public function create($input)
    {
        $model = parent::create($input->except('media_type', 'file', 'industries'));
        $this->storeIndustries($input, $model->id);
        $this->storeMedia($input, $model);
        return $model;
    }

    private function storeIndustries($input, $medicine_id)
    {
        $industries = is_array($input['industries']) ? $input['industries'] : explode(',', $input['industries']);


        MedicineIndustry::where('medicine_id', $medicine_id)
            ->whereNotIn('industry_id', $industries)
            ->delete();
        if (!empty($industries) && count($industries)) {
            foreach ($industries as $item) {
                MedicineIndustry::firstOrCreate([
                    'medicine_id' => $medicine_id,
                    'industry_id' => (int)$item,
                ]);
            }
        }
    }

    /**
     * @param $input
     * @param $model
     */
    private function storeMedia($input, $model): void
    {
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('images');
            $media_record->update($media_input);
        }
    }

    public function update($input, $id)
    {
        $model = parent::update($input->except('media_type', 'file','industries'));
        $this->storeIndustries($input, $model->id);
        $this->storeMedia($input, $model);
        return $model;
    }
}
