<?php

namespace App\Repositories;

use App\Models\DistributionHub;

/**
 * Class DistributionHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:06 am UTC
 */
class DistributionHubRepository extends BaseRepository
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
        return DistributionHub::class;
    }

    public function store(array $input, $distributable_id)
    {
        $distributions = is_array($input['distributions']) ? $input['distributions'] : explode(',', $input['distributions']);
        $this->model->where(['distributable_type' => $input['distributable_type'], 'distributable_id' => $distributable_id])
            ->whereNotIn('geographical_id', $distributions)
            ->delete();
        if (count($distributions)) {
            foreach ($distributions as $item) {
                $this->model->firstOrCreate([
                    'distributable_type' => $input['distributable_type'],
                    'distributable_id' => $distributable_id,
                    'geographical_id' => $item,
                ]);
            }
        }
    }
}
