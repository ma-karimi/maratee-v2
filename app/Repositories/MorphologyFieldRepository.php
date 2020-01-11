<?php

namespace App\Repositories;

use App\Models\MorphologyField;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;


/**
 * Class MorphologyFieldRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class MorphologyFieldRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var LocationRepository
     */
    private $locationRepo;

    public function __construct(Application $app, LocationRepository $locationRepo)
    {
        parent::__construct($app);
        $this->locationRepo = $locationRepo;
    }

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
        return MorphologyField::class;
    }

    public function create($input)
    {
        $input['location_id'] = $this->locationRepo->create($input['location'])->id;
        return parent::create(Arr::except($input, ['location']));

    }

    public function update($input, $id)
    {
        $input['location_id'] = $this->locationRepo->update($input['location'], $input['location']['id'])->id;
        return parent::update(Arr::except($input, ['location']), $id);

    }
}
