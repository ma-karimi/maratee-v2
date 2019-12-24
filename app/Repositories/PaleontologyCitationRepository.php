<?php

namespace App\Repositories;

use App\Models\PaleontologyCitation;
use Illuminate\Support\Arr;

/**
 * Class PaleontologyCitationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:27 am UTC
 */
class PaleontologyCitationRepository extends BaseRepository
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
        return PaleontologyCitation::class;
    }

    public function create($input)
    {
        $citation = parent::create(Arr::except($input, 'authors'));

        $this->setAuthors($input, $citation);

        return $citation;
    }

    /**
     * @param $input
     * @param $citation
     */
    private function setAuthors($input, $citation)
    {
        $authors = is_array($input['authors']) ? $input['authors'] : explode(',', $input['authors']);
        $this->createHub($citation->id, 'actors', $authors);
    }

    public function update($input, $id)
    {
        $citation = parent::update(Arr::except($input, 'authors'), $id);

        $this->setAuthors($input, $citation);

        return $citation;
    }
}
