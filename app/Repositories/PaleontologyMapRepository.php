<?php

namespace App\Repositories;

use App\Models\Media;
use App\Models\PaleontologyMap;

/**
 * Class MapRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:21 am UTC
 */
class PaleontologyMapRepository extends BaseRepository
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
        return PaleontologyMap::class;
    }

    public function create($input)
    {
        $paleontology_map = parent::create($input->except('file'));
        $this->storeMedia($paleontology_map);
        return $paleontology_map;
    }

    /**
     * @param $paleontology_map
     */
    private function storeMedia($paleontology_map): void
    {
        Media::where(['model_type' => PaleontologyMap::class, 'model_id' => $paleontology_map->id])->delete();
        $media_record = $paleontology_map->addMedia(request()->file('file'))->toMediaCollection('media');
        $media_record->update(['media_type' => 2]);
    }


    public function update($input, $id)
    {
        $paleontology_map = parent::update($input->except('file'), $id);
        $this->storeMedia($paleontology_map);
        return $paleontology_map;
    }
}
