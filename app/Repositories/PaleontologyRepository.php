<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Paleontology;
use Illuminate\Container\Container as Application;
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
        return parent::create(Arr::only($input->all(), [
            'catalog_no', 'specimen_no', 'field_no', 'barcode_no', 'taxonomy_id', 'general_order_id', 'general_plant_type_id', 'location_in_collection']));
    }

    public function storeGeologyAndRemark($input, $paleontology_id)
    {

        $data = Arr::only($input->all(), [
            'geology_age_era_id', 'geology_age_epoch_id', 'geology_age_period_id', 'geology_age_stage_id', 'additional_info', 'update_frequency', 'last_update', 'access_code'
        ]);

        return parent::update($data, $paleontology_id);
    }

    public function storeOtherData($input, $paleontology_id)
    {
        $this->storeDetermine($input, $paleontology_id);
        $this->storeCollect($input, $paleontology_id);

        $data = Arr::only($input->all(), [
            'preservation', 'pieces', 'color', 'element', 'treatment_history'
        ]);

        return parent::update($data, $paleontology_id);
    }

    private function storeDetermine($input, $paleontology_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        $action_hub = $this->actionHubRepo->firstOrCreate([
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
                'description' => $input['field_notes'] ?? null
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

    public function update($input, $id)
    {
        return parent::update(Arr::only($input->all(), [
            'catalog_no', 'specimen_no', 'field_no', 'barcode_no', 'taxonomy_id', 'general_order_id', 'general_plant_type_id', 'location_in_collection']), $id);
    }

    public function storeLocality($input, $locality_id = null)
    {
        $location = $this->storeLocation($input->all(), $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        $data = Arr::only($input->all(), [
            'location_id', 'paleontology_id', 'formation', 'layer', 'stratigraphy', 'lithology', 'fauna'
        ]);

        $data['description'] = $input['locality_description'];
        if ($locality_id) {
            return $this->localityRepo->update($data, $locality_id);
        }
        return $this->localityRepo->create($data);
    }

    private function storeLocation($input, $location_id = null)
    {
        $data = Arr::only($input, [
            'village', 'city_id', 'province_id', 'address_en', 'region_name', 'address_fa'
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
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('media');
            $media_record->update($media_input);
        }
    }

    private function palebotanyData($input)
    {
        return Arr::only($input, [
            'geology_age_era_id', 'geology_age_period_id', 'geology_age_epoch_id', 'geology_age_stage_id', 'preservation', 'pieces', 'color', 'element', 'treatment_history', 'access_code', 'additional_info', 'update_frequency', 'last_update', 'excavation', 'description'
        ]);
    }
}
