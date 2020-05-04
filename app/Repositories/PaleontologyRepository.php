<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Paleontology;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class PaleontologyRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:26 am UTC
 */
class PaleontologyRepository extends BaseRepository
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
     * @var LocalityRepository
     */
    private $localityRepo;

    public function __construct(Application $app, ActionHub $actionHubRepo, ActorHub $actorHubRepo, LocationRepository $locationRepo, LocalityRepository $localityRepo)
    {
        parent::__construct($app);
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
        $this->locationRepo = $locationRepo;
        $this->localityRepo = $localityRepo;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param array $search
     * @param int $perPage
     * @param array|null $with_relations
     * @param array $columns
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function paginate($perPage, array $search = [], array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->orderBy('catalog_no')->paginate($perPage ?? 25, $columns);
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
        return Paleontology::class;
    }

    public function create($input)
    {
        $paleontology = parent::create($this->setPrimaryData($input));
//
//        $this->createHub($paleontology->id, 'generalSamples', is_array($input['samples']) ? $input['samples'] : explode(',', $input['samples']));

        return $paleontology;
    }

    /**
     * @param $input
     * @return array
     */
    public function setPrimaryData($input): array
    {
        return Arr::only($input->all(), [
            'catalog_no', 'specimen_no', 'field_no', 'taxonomy_id',
//            'general_order_id', 'general_plant_type_id', deleted by comment dr.jamzad
            'location_in_collection', 'additional_info']);
    }

    public function storeGeologyAndRemark($input, $paleontology_id)
    {

        $data = Arr::only($input->all(), [
            'geology_age_era_id', 'geology_age_epoch_id', 'geology_age_period_id', 'geology_age_stage_id'
        ]);

        return parent::update($data, $paleontology_id);
    }

    public function storeOtherData($input, $paleontology_id)
    {
        $this->storeDetermine($input, $paleontology_id);
        $this->storeCollect($input, $paleontology_id);
        $data = Arr::only($input->all(), ['pieces', 'color', 'element', 'treatment_history'
        ]);

        $paleontology = parent::update($data, $paleontology_id);
        $this->createHub($paleontology->id, 'preservations', is_array($input['preservations']) ? $input['preservations'] : explode(',', $input['preservations']));
        $this->createHub($paleontology->id, 'citations', is_array($input['citations']) ? $input['citations'] : explode(',', $input['citations']));

        return $paleontology;

    }

    private function storeDetermine($input, $paleontology_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        $action_hub = $this->actionHubRepo->updateOrCreate([
            'action_id' => 1,
            'actionable_type' => Paleontology::class,
            'actionable_id' => $paleontology_id
        ],
            [
                'date' => $input['identify_date'] ?? null
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

    private function storeCollect($input, $paleontology_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => Paleontology::class,
                'actionable_id' => $paleontology_id
            ],
            [
                'date' => $input['collecting_date'] ?? null,
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
     * @deleted samples
     * @param array $input
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($input, $id)
    {
        $paleontology = parent::update($this->setPrimaryData($input), $id);
//
//        $this->createHub($paleontology->id, 'generalSamples', is_array($input['samples']) ? $input['samples'] : explode(',', $input['samples']));
        return $paleontology;
    }

    public function storeLocality($input, $locality_id = null)
    {
        $location = $this->storeLocation($input->all(), $input->filled('location_id') ? $input['location_id'] : null);
        $data = [
            'paleontology_id' => $input['paleontology_id'] ?? null,
            'formation' => $input['formation'] ?? null,
            'thickness' => $input['thickness'] ?? null,
            'stratigraphy' => $input['stratigraphy'] ?? null,
            'lithology' => $input['lithology'] ?? null,
            'fauna' => $input['fauna'] ?? null,
        ];

        $data['location_id'] = $location->id;
        $data['description'] = $input['locality_description'];
        if ($locality_id) {
            return $this->localityRepo->update($data, $locality_id);
        }
        return $this->localityRepo->create($data);
    }

    private function storeLocation($input, $location_id = null)
    {
        $data = Arr::only($input, [
            'village', 'city_id', 'province_id', 'address_en', 'region_name', 'address_fa', 'point'
        ]);

        if ($location_id) {
            return $this->locationRepo->update($data, $location_id);
        }
        return $this->locationRepo->create($data);

    }

    /**
     * @param $input
     * @param $model
     */
    public function storeMedia($input, $model): void
    {
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
            'description' => $input['description'] ?? null
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection(in_array($media_input['media_type'], [1, 2]) ? 'images' : 'media');

            $media_record->update($media_input);
        }
    }

    public function getRelationFields()
    {
        return ['taxonomy', 'geologyAgePeriod', 'geologyAgeStage', 'geologyAgeEpoch', 'geologyAgeEra', 'locality.location', 'maps.media', 'collect', 'determine', 'media', 'preservations', 'citations', 'transactions.media'];
    }
}
