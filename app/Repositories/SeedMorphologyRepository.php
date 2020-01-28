<?php

namespace App\Repositories;

use App\Models\MorphologyVariable;
use App\Models\SeedMorphology;
use Carbon\Carbon;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class SeedMorphologyRepository
 * @package App\Repositories
 * @version October 20, 2019, 8:47 am UTC
 */
class SeedMorphologyRepository extends BaseRepository
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
     * BotanicalRepository constructor.
     * @param Application $app
     * @param ProjectRepository $projectRepository
     * @throws Exception
     */
    public function __construct(Application $app, ProjectRepository $projectRepository)
    {
        parent::__construct($app);
        $this->projectRepository = $projectRepository;
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
        return SeedMorphology::class;
    }

    public function storeQuantitatives($input, $morphology)
    {
        $this->storeVariables($input, $morphology, 'quantitatives');
    }

    /**
     * @param $input
     * @param $morphology
     * @param $type
     */
    public function storeVariables($input, $morphology, $type): void
    {
        $morphology->$type()
            ->whereNotIn('seed_general_id', collect($input)->pluck('seed_general_id')->all())
            ->each(function ($query) {
                $query->pivot->update(['deleted_at' => Carbon::now()]);
            });

        if (!empty($input) && count($input)) {
            foreach ($input as $item) {
                MorphologyVariable::updateOrCreate(
                    [
                        'seed_morphology_id' => $morphology->id,
                        'seed_general_id' => $item['seed_general_id']
                    ],
                    [
                        'value' => $item['value']
                    ]
                );
            }
        }
    }

    public function create($input)
    {
        $input['project_id'] = $this->storeProject($input);
        return parent::create(Arr::except($input, ['project']));

    }

    public function storeProject($input)
    {
        return request()->filled('project_id') ? $this->projectRepository->update($input['project'], $input['project_id'])->id : $this->projectRepository->create($input['project'])->id;
    }

    public function update($input, $id)
    {
        $input['project_id'] = $this->storeProject($input);
        return parent::update(Arr::except($input, ['project']), $id);

    }

    public function storeQualititatives($input, $morphology)
    {
        $this->storeVariables($input, $morphology, 'qualititatives');
    }

    public function storeMedia(array $input, SeedMorphology $seedMorphology)
    {
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
        ];
        if (request()->hasFile('file')) {
            $media_record = $seedMorphology->addMedia(request()->file('file'))->toMediaCollection('media');
            $media_record->update($media_input);
        }
    }

    public function storeField(array $input, SeedMorphology $seedMorphology)
    {
        $seedMorphology->field->create($input);

        return $seedMorphology;
    }
}
