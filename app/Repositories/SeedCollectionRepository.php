<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\SeedCollection;
use App\Models\SeedGeneralCollection;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    public function create($input)
    {
        if (SeedCollection::where('accession_code', $input['accession_code'])->exists()) {
            throw ValidationException::withMessages(['accession_code' => 'The accession code has already been taken.']);
        }

        if (request()->filled('location')) {
            $input['location_id'] = $this->locationRepo->create($input['location'])->id;
        }
        return parent::create(Arr::except($input, ['location']));
    }

    /**
     * delete collectors with dr.jamzad comment
     *
     * @param $input
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     * @throws ValidationException
     */
    public function storeProject($input, $id)
    {
        return parent::update($input, $id);
    }

    public function update($input, $id)
    {
        if (SeedCollection::where('accession_code', $input['accession_code'])->where('id', '!=', $id)->exists()) {
            throw ValidationException::withMessages(['accession_code' => 'The accession code has already been taken.']);
        }
        if (request()->filled(['location_id', 'location'])) {
            $input['location_id'] = $this->locationRepo->update($input['location'], $input['location']['id'])->id;
        } else if (request()->filled(['location'])) {
            $input['location_id'] = $this->locationRepo->create($input['location'])->id;
        }
        return parent::update(Arr::except($input, ['location', 'collect', 'id']), $id);
    }

    public function getRelationFields()
    {
        return ['location','organization.city', 'organization:id,name_en,city_id', 'landForm', 'taxonomy', 'project', 'drainage', 'fruitType', 'habitat', 'usedPart', 'growthForm', 'lifeForm', 'consumption', 'motherHealth', 'pollinationAgent', 'pollinationType', 'collectedFrom', 'slopeAspect', 'soilDepth', 'soilErosion', 'soilLime', 'soilSalinity', 'soilTexture', 'specimenType', 'associatedSpecies', 'communityTypes', 'climates', 'media', 'floweringTime', 'harvestingTime'];
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
        $this->storePivot(is_array($input['climates']) ? $input['climates'] : [], $seed_collection->id, 20);
        $this->storePivot(is_array($input['community_types']) ? $input['community_types'] : [], $seed_collection->id, 21);
        $this->storePivot(is_array($input['associated_species']) ? $input['associated_species'] : [], $seed_collection->id, 22);
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
                    'seed_general_type_id' => $type_id,
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
            'description' => $input['description'] ?? null
        ];
        //store media
        if (request()->hasFile('file')) {
//            $media_record = $model->addMediaFromRequest('file')->toMediaCollection('images');

            $extension = request()->file('file')->getClientOriginalExtension();
            $media_record = $model
                ->addMedia(request()->file('file'))
                ->usingName(sha1('image' . time()) . '.' . $extension)
                ->usingFileName(sha1('image' . time()) . '.' . $extension)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })->toMediaCollection('images');

            $media_record->update($media_input);
        }
    }






    /**
     * @param $input
     * @param $seed_collect_id
     * @deprecated  by dr.jamzad
     */
    private function storeCollect($input, $seed_collect_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => SeedCollection::class,
                'actionable_id' => $seed_collect_id
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
}
