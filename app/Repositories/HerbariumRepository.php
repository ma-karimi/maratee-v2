<?php

namespace App\Repositories;

use App\Models\ActionActor;
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

    ];
    /**
     * @var LocationRepository
     */
    private $locationRepo;


    public function __construct(Application $app, LocationRepository $locationRepo)
    {
        parent::__construct($app);
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

        $location = $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;

        $herbarium = parent::create($this->herbariumData($input));
        $this->storeDetermine($input, $herbarium->id);
        $this->storeCollect($input, $herbarium->id);

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

    private function herbariumData($input): array
    {
        return [
            'herbarium_number' => $input->herbarium_number ?? null,
            'location_id' => $input->location_id ?? null,
            'taxonomy_id' => $input->taxonomy_id ?? null,
            'organization_id' => $input->organization_id ?? null,
            'tip_picture_id' => $input->tip_picture_id ?? null,
            'consideration' => $input->consideration ?? null,
            'description' => $input->description ?? null,
            'general_phytogeography_id' => $input['general_phytogeography_id'] ?? null,
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'collection_date' => $input['collection_date'] ?? null,
            'determine_date' => $input['determine_date'] ?? null,
        ];
    }

    private function storeDetermine($input, $herbarium_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        ActionActor::where('actorable_id', $herbarium_id)
            ->where('actorable_type', Herbarium::class)
            ->whereNotIn('actor_id', $determines)
            ->where('type_id', 1)
            ->delete();
        if (count($determines) && !empty($determines[0])) {
            foreach ($determines as $item) {
                ActionActor::firstOrCreate([
                    'actorable_id' => $herbarium_id,
                    'actorable_type' => Herbarium::class,
                    'actor_id' => (int)$item,
                    'type_id' => 1
                ]);
            }
        }
    }

    private function storeCollect($input, $herbarium_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        ActionActor::where('actorable_id', $herbarium_id)
            ->where('actorable_type', Herbarium::class)
            ->whereNotIn('actor_id', $collectors)
            ->where('type_id', 2)
            ->delete();
        if (count($collectors) && !empty($collectors[0])) {
            foreach ($collectors as $item) {
                ActionActor::firstOrCreate([
                    'actorable_id' => $herbarium_id,
                    'actorable_type' => Herbarium::class,
                    'actor_id' => (int)$item,
                    'type_id' => 2
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

        $model = parent::update($this->herbariumData($input), $id);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);

        return $model;
    }

    public function getRelationFields()
    {
        return ['taxonomy', 'organization:id,name_en', 'media', 'location'];
    }
}
