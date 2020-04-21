<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:24 am UTC
 */
class ProductRepository extends BaseRepository
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
        return Product::class;
    }

    public function create($input)
    {
        $model = parent::create($input->except('media_type', 'file'));

        $this->storeMedia($input, $model);
        return $model;
    }

    /**
     * @param $input
     * @param $model
     */
    public function storeMedia($input, $model): void
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
        $model = parent::update($input->except('media_type', 'file'), $id);

        $this->storeMedia($input, $model);
        return $model;
    }

    public function getRelationFields()
    {
        return [];
    }
}
