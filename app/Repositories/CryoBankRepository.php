<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\CryoBank;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class CryoBankRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:07 am UTC
 */
class CryoBankRepository extends BaseRepository
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
        return CryoBank::class;
    }

    public function create($input)
    {
        $input = $this->createOrUpdateCryoBankData($input);
        $cryo_bank = parent::create($this->cryoBankData($input->all()));

        $this->storeCollect($input, $cryo_bank->id);
        $this->storeResearch($input, $cryo_bank->id);

        return $cryo_bank;
    }

    /**
     * @param $input
     * @return mixed
     */
    private function createOrUpdateCryoBankData($input)
    {
        $location = $this->storeLocation($input->all(), $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        $input['genotype_code'] = $this->setGenoTypeCode($input);
        return $input;
    }

    private function storeLocation($input, $location_id = null)
    {

        $data = [
            'village' => $input['village'] ?? null,
            'city_id' => $input['city_id'] ?? null,
            'province_id' => $input['province_id'] ?? null,
            'address_en' => $input['address_en'] ?? null,
            'region_name' => $input['region_name'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
            'point' => $input['point'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
        ];

        if ($location_id) {
            return $this->locationRepo->update($data, $location_id);
        }
        return $this->locationRepo->create($data);

    }

    /**
     * @param $input
     * @return mixed
     */
    private function setGenoTypeCode($input)
    {

        return $input['year'] . Arr::get(CryoBank::TYPE_SAMPLE, $input['sample_type_id']) . $input['tank'] . $input['row'] . $input['rack'] . $input['cell'];
    }

    private function cryoBankData($input)
    {
        return Arr::only($input, [
            'genotype_code', 'sample_type_id', 'repeat', 'tank', 'taxonomy_id', 'protection_id', 'location_id', 'treatment_id', 'treatment_values', 'year', 'cell', 'row', 'rack', 'proposal_name'
        ]);
    }

    private function storeCollect($input, $cryo_bank_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => CryoBank::class,
                'actionable_id' => $cryo_bank_id
            ],
            [
                'date' => $input['collecting_date'] ?? null,
                'description' => $input['collecting_description'] ?? null
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

    private function storeResearch($input, $cryo_bank_id)
    {
        $researchers = is_array($input['researchers']) ? $input['researchers'] : explode(',', $input['researchers']);

        $action_hub = $this->actionHubRepo->firstOrCreate([
            'action_id' => 3,
            'actionable_type' => CryoBank::class,
            'actionable_id' => $cryo_bank_id
        ]);

        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $researchers)
            ->delete();
        if (count($researchers) && !empty($researchers[0])) {
            foreach ($researchers as $item) {
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
        $input = $this->createOrUpdateCryoBankData($input);
        $cryo_bank = parent::update($this->cryoBankData($input->all()), $id);

        $this->storeCollect($input, $cryo_bank->id);
        $this->storeResearch($input, $cryo_bank->id);

        return $cryo_bank;
    }
}
