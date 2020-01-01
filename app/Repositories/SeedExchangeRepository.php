<?php

namespace App\Repositories;

use App\Models\SeedExchange;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Class SeedExchangeRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class SeedExchangeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var ProjectRepository
     */
    private $projectRepo;

    public function __construct(Application $app, ProjectRepository $projectRepo)
    {
        parent::__construct($app);

        $this->projectRepo = $projectRepo;
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
        return SeedExchange::class;
    }


    public function create($input)
    {
        $input = $this->createOrUpdateProject($input);
        return parent::create(Arr::except($input, ['project']));
    }

    /**
     * @param $input
     * @return mixed
     * @throws ValidationException
     */
    private function createOrUpdateProject($input)
    {
        $input['project_id'] = !empty($input['project_id']) ?
            $this->projectRepo->update($input['project'], $input['project_id'])->id :
            $this->projectRepo->create($input['project'])->id;
        return $input;
    }

    public function update($input, $id)
    {
        $input = $this->createOrUpdateProject($input);
        return parent::update(Arr::except($input, ['project']), $id);
    }
}
