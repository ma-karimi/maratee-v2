<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Herbarium;
use App\Models\SeedCollection;
use App\Models\SeedGeneralCollection;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Class SeedCollectionRepository
 * @package App\Repositories
 * @version October 12, 2019, 11:34 am UTC
 */
class SeedCollectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var ActionHub
     */
    private $actionHubRepo;
    /**
     * @var ActorHub
     */
    private $actorHubRepo;
    /**
     * @var LocationRepository
     */
    private $locationRepo;
    /**
     * @var ProjectRepository
     */
    private $projectRepo;

    public function __construct(Application $app, ActionHub $actionHubRepo, ActorHub $actorHubRepo, LocationRepository $locationRepo, ProjectRepository $projectRepo)
    {
        parent::__construct($app);
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
        $this->locationRepo = $locationRepo;
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

    public function create($input)
    {
        $input['location_id'] = $this->locationRepo->create($input['location'])->id;
        return parent::create(Arr::except($input, ['location']));
    }

    /**
     * @param $input
     * @param $id
     * @throws ValidationException
     */
    public function storeProject($input, $id)
    {
        $input = $this->createOrUpdateProject($input);
        $seed_collect = $this->update($input, $id);
        $this->storeCollect($input, $seed_collect->id);
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
        $this->locationRepo->update($input['location'], $input['location']['id']);
        return parent::update(Arr::except($input, ['location', 'collect', 'id']), $id);
    }

    private function storeCollect($input, $herbarium_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => Herbarium::class,
                'actionable_id' => $herbarium_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $collectors)
            ->delete();
        if (count($collectors) && !empty($collectors[0])) {
            foreach ($collectors as $item) {
                $this->actorHubRepo::firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
    }

    public function storePlantFlowering($input, $id)
    {
        return parent::update($input, $id);
    }

    public function storeSoil($input, $id)
    {
        return parent::update($input, $id);
    }

    public function storeClimate($input, $id)
    {
        $seed_collection = parent::update(Arr::except($input, ['climates', 'community_types', 'associated_species']), $id);
        $this->storePivot($input['climates'], $seed_collection->id, 20);
        $this->storePivot($input['community_types'], $seed_collection->id, 21);
        $this->storePivot($input['associated_species'], $seed_collection->id, 22);
        return $seed_collection;
    }

    private function storePivot($input, $id, $type_id)
    {
        SeedGeneralCollection::where('seed_collection_id', $id)
            ->whereNotIn('seed_general_id', $input)
            ->where('seed_general_type_id', $type_id)
            ->delete();

        if (!empty($input) && count($input)) {
            foreach ($input as $item) {
                SeedGeneralCollection::firstOrCreate([
                    'seed_collection_id' => $id,
                    'seed_general_type_id' => $id,
                    'seed_general_id' => $item,
                ]);
            }
        }
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SeedCollection::class;
    }

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
}
