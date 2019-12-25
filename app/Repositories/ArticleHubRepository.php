<?php

namespace App\Repositories;

use App\Models\ArticleHub;

/**
 * Class ArticleHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:34 am UTC
 */
class ArticleHubRepository extends BaseRepository
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
        return ArticleHub::class;
    }
}
