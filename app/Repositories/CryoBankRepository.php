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
    public function __construct(Application $app, ActionHub $actionHubRepo, ActorHub $actorHubRepo, LocationRepository $locationRepo)
    {
        parent::__construct($app);
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
        $this->locationRepo = $locationRepo;
    }


    public function create($input)
    {
        $input = $this->createOrUpdateCryoBankData($input);
        $cryo_bank = parent::create($this->cryoBankData($input->all()));

        $this->storeCollect($input, $cryo_bank->id);
        $this->storeResearch($input, $cryo_bank->id);

        return $cryo_bank;
    }

    private function storeLocation($input, $location_id = null)
    {
        $data = Arr::only($input, [
            'village', 'city_id', 'province_id', 'address_en', 'region_name', 'address_fa', 'point', 'min_altitude', 'max_altitude'
        ]);

        if ($location_id) {
            return $this->locationRepo->update($data, $location_id);
        }
        return $this->locationRepo->create($data);

    }

    private function cryoBankData($input)
    {
        return Arr::only($input, [
            'genotype_code', 'sample_type_id', 'repeat', 'tank', 'taxonomy_id', 'protection_id', 'location_id', 'treatment_id', 'treatment_values', 'year', 'cell', 'row', 'rack', 'proposal_name'
        ]);
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

    public function update($input, $id)
    {
        $input = $this->createOrUpdateCryoBankData($input);
        $cryo_bank = parent::update($this->cryoBankData($input->all()), $id);

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

    /**
     * @param $input
     * @return mixed
     */
    private function setGenoTypeCode($input)
    {

        return $input['year'] . Arr::get(CryoBank::TYPE_SAMPLE, $input['sample_type_id']) . $input['tank'] . $input['row'] . $input['rack'] . $input['cell'];
    }
}
