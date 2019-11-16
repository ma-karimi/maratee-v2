<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\Herbarium;
use Illuminate\Container\Container as Application;

/**
 * Class HerbariumRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:21 am UTC
 */
class HerbariumRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'plant:is_flowering' => 1
    ];
    /**
     * @var ActionHubRepository
     */
    private $actionHubRepo;
    /**
     * @var ActorHubRepository
     */
    private $actorHubRepo;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param ActionHubRepository $actionHubRepo
     * @param ActorHubRepository $actorHubRepo
     * @throws \Exception
     */
    public function __construct(Application $app, ActionHubRepository $actionHubRepo, ActorHubRepository $actorHubRepo)
    {
        parent::__construct($app);
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
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
        return Herbarium::class;
    }

    public function create($input)
    {
        $herbarium = parent::create($input);
        $this->storeDetermine($input, $herbarium->id);
        $this->storeCollect($input, $herbarium->id);
        $this->storeMedia($input, $herbarium);

        return $herbarium;
    }


    public function update($input, $id)
    {
        $model = parent::update($input, $id);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);

        return $model;
    }

    /**
     * @param $input
     * @param $model
     */
    public function storeMedia($input, $model): void
    {
        $media_input = [
            'date' => $input['date'] ?? null,
            'user_id' => $input['user_id'] ?? null,
            'location_id' => $input['location_id'] ?? null,
            'description' => $input['media_description'] ?? null,
            'media_type' => $input['media_type'] ?? 2,
            'reference' => $input['reference'] ?? null,
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('media');
            $media_record->update($media_input);
        }
    }


    private function storeDetermine($input, $herbarium_id)
    {
        $determines = $input['determines'];

        $action_hub_id = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => Herbarium::class,
            'actionable_id' => $herbarium_id
        ]);

        $this->actorHubRepo
            ->where('actorable_id', $action_hub_id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $determines)
            ->delete();
        if (count($determines)) {
            foreach ($determines as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub_id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => $item,
                ]);
            }
        }
    }

    private function storeCollect($input, $herbarium_id)
    {
        $collectors = $input['collectors'];

        $action_hub_id = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => Herbarium::class,
                'actionable_id' => $herbarium_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $this->actorHubRepo
            ->where('actorable_id', $action_hub_id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $collectors)
            ->delete();
        if (count($collectors)) {
            foreach ($collectors as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub_id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => $item,
                ]);
            }
        }
    }
}
