<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Herbarium;
use App\Models\Plant;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
     * @var LocationRepository
     */
    private $locationRepo;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param ActionHub $actionHubRepo
     * @param ActorHub $actorHubRepo
     * @param LocationRepository $locationRepo
     * @throws \Exception
     */
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
        return Herbarium::class;
    }

    public function create($input)
    {


        if (Herbarium::where('herbarium_number', $input['herbarium_number'])->exists()) {
            throw ValidationException::withMessages([
                'herbarium_number' => 'Herbarium Number Already Exists!'
            ]);
        }
        $location = $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        $is_flowering = $input['is_flowering'] != 1 ? $input['is_flowering'] : 1;
        $plant = Plant::where('taxonomy_id', $input['taxonomy_id'])
            ->where('is_flowering', $is_flowering)
            ->first();
        if ($plant) {
            $input['plant_id'] = $plant->id;
        }
        $herbarium = parent::create($this->herbariumData($input));
        $this->storeDetermine($input, $herbarium->id);
        $this->storeCollect($input, $herbarium->id);
        $this->storeMedia($input, $herbarium);

        return $herbarium;
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

    /**
     * @param $input
     * @return array
     */
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

    /**
     * @param $input
     * @return array
     */
    private function herbariumData($input): array
    {
        return [
            'herbarium_index' => $input->herbarium_index ?? null,
            'herbarium_number' => $input->herbarium_number ?? null,
            'cf' => $input->cf ?? null,
            'plant_id' => $input->plant_id ?? null,
            'location_id' => $input->location_id ?? null,
            'taxonomy_id' => $input->taxonomy_id ?? null,
            'organization_id' => $input->organization_id ?? null,
            'tip_picture_id' => $input->tip_picture_id ?? null,
            'consideration' => $input->consideration ?? null,
            'description' => $input->description ?? null];
    }

    private function storeDetermine($input, $herbarium_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        $action_hub = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => Herbarium::class,
            'actionable_id' => $herbarium_id
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
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
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

    public function update($input, $id)
    {

        if (Herbarium::where('herbarium_number', $input['herbarium_number'])->where('id', '!=', $id)->exists()) {
            throw ValidationException::withMessages([
                'herbarium_number' => 'Herbarium Number Already Exists!'
            ]);
        }
        $location = $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        $is_flowering = $input['is_flowering'] != 1 ? $input['is_flowering'] : 1;
        $plant = Plant::where('taxonomy_id', $input['taxonomy_id'])
            ->where('is_flowering', $is_flowering)
            ->first();
        if ($plant) {
            $input['plant_id'] = $plant->id;
        }
        Log::info([$this->herbariumData($input), $id]);
        $model = parent::update($this->herbariumData($input), $id);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);

        return $model;
    }
}
