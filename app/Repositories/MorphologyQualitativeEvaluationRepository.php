<?php

namespace App\Repositories;

use App\Models\MorphologyQualitativeEvaluation;
use App\Models\MorphologyVariable;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class MorphologyQualitativeEvaluationRepository
 * @package App\Repositories
 * @version October 20, 2019, 8:47 am UTC
 */
class MorphologyQualitativeEvaluationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

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
        return MorphologyQualitativeEvaluation::class;
    }
    public function __construct(Application $app, ProjectRepository $projectRepository)
    {
        parent::__construct($app);
        $this->projectRepository = $projectRepository;
    }

    public function create($input)
    {
        $input['project_id'] = $this->projectRepository->create($input['project'])->id;
        return parent::create(Arr::except($input, ['project']));

    }

    public function update($input, $id)
    {
        $input['project_id'] = $this->projectRepository->update($input['project'], $input['project']['id'])->id;
        return parent::update(Arr::except($input, ['project']), $id);

    }

    public function storeVariable($input, $id)
    {
        MorphologyVariable::where(
            [
                'morphology_type' => MorphologyQualitativeEvaluation::class,
                'morphology_id' => $id
            ]
        )
            ->whereNotIn('seed_general_id', collect($input)->pluck('seed_general_id')->all())
            ->delete();

        if (!empty($input) && count($input)) {
            foreach ($input as $item) {
                MorphologyVariable::updateOrCreate(
                    [
                        'morphology_type' => MorphologyQualitativeEvaluation::class,
                        'morphology_id' => $id,
                        'seed_general_id' => $item['seed_general_id']
                    ],
                    [
                        'value' => $item['value']
                    ]
                );
            }
        }
    }
}
