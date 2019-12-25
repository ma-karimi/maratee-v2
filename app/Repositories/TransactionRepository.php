<?php

namespace App\Repositories;

use App\Models\Transaction;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version September 2, 2019, 5:47 am UTC
 */
class TransactionRepository extends BaseRepository
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
        return Transaction::class;
    }

    public function storeMedia($input, $id)
    {
        $media_input = [];
        if (request()->hasFile('file')) {
            $media_input = [
                'date' => $input['date'] ?? null,
//                'user_id' => $input['user_id'] ?? null,
//                'location_id' => $input['location_id'] ?? null,
                'description' => $input['media_description'] ?? null,
                'media_type' => $input['media_type'] ?? 2,
                'reference' => $input['reference'] ?? null,
            ];
        }

        $model = $this->find($id);
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection(in_array($media_input['media_type'], [1, 2]) ? 'images' : 'media');
            $media_record->update($media_input);
        }
        return $model;
    }
}
