<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Nonflower;
use Illuminate\Container\Container as Application;

/**
 * Class NonflowerRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:21 am UTC
 */
class NonflowerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

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
     * @var LocationRepository
     */
    private $locationRepo;


    public function __construct(Application $app, ActionHub $actionHubRepo, ActorHub $actorHubRepo, LocationRepository $locationRepo)
    {
        parent::__construct($app);
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
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
        return Nonflower::class;
    }

    public function create($input)
    {

        $location = $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        $record = parent::create($this->recordData($input));
        $this->storeDetermine($input, $record->id);
        $this->storeCollect($input, $record->id);

        return $record;
    }

    private function storeLocation($input, $location_id)
    {
        if ($location_id) {
            $location = $this->locationRepo->update($this->locationData($input), $location_id);
        } else {
            $location = $this->locationRepo->create($this->locationData($input));
        }
        return $location;
    }

    private function locationData($input): array
    {
        return [
            'province_id' => $input['province_id'],
            'city_id' => $input['city_id'] ?? null,
            'address_en' => $input['address_en'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
            'village' => $input['village'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
        ];
    }

    private function recordData($input): array
    {
        return [
            'herbarium_number' => $input->herbarium_number ?? null,
            'location_id' => $input->location_id ?? null,
            'taxonomy_id' => $input->taxonomy_id ?? null,
            'description' => $input->description ?? null,
            'phytogeography_id' => $input['phytogeography_id'] ?? null,
            'habitat_id' => $input['habitat_id'] ?? null,
            'substrate_id' => $input['substrate_id'] ?? null,
        ];
    }

    private function storeDetermine($input, $record_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        $action_hub = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => Nonflower::class,
            'actionable_id' => $record_id
        ]);

        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $determines)
            ->delete();
        if (count($determines) && !empty($determines[0])) {
            foreach ($determines as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
    }

    private function storeCollect($input, $record_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => Nonflower::class,
                'actionable_id' => $record_id
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
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
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

    public function update($input, $id)
    {

        $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);

        $model = parent::update($this->recordData($input), $id);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);

        return $model;
    }

    public function getRelationFields()
    {
        return ['phytogeography', 'taxonomy', 'habitat', 'media', 'substrate', 'collect', 'determine', 'transactions', 'location'];
    }

}
