<?php

namespace App\Repositories;

use App\Models\General;
use App\Models\Plant;
use App\Models\PlantProperty;
use function GuzzleHttp\Promise\queue;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class PlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class PlantRepository extends BaseRepository
{

    private $taxonomyRepository;
    private $classificationRepository;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param TaxonomyRepository $taxonomyRepository
     * @throws \Exception
     */
    public function __construct(Application $app, TaxonomyRepository $taxonomyRepository, ClassificationRepository $classificationRepository)
    {
        parent::__construct($app);
        $this->taxonomyRepository = $taxonomyRepository;
        $this->classificationRepository = $classificationRepository;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'is_flowering' => [
            'scope' => 'ofFloweringHerbariums'
        ]
    ];

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
        return Plant::class;
    }

    /**
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function create($input)
    {
        $plant = $this->createPlant($input);
        $taxonomy_input = $this->createTaxonomy($input, $plant);
        $this->syncPlantProperties($taxonomy_input, $plant);
        $this->syncPlantTypeProperties($input, $plant);
        $this->syncPlantSubSpeciesProperties($input, $plant);
        return $plant;
    }

    /**
     * @param array $input
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function update($input, $id)
    {
        $plant_input = [
            'name' => $input['name'],
            'description' => $input['description'] ?? null,
            'domestic_name' => $input['domestic_name'] ?? null,
            'exclusivity' => $input['exclusivity'] ?? null,
            'flowering_id' => $input['flowering_id'] ?? null,
            'cotyledon_id' => $input['cotyledon_id'] ?? null,
            'sperm_id' => $input['sperm_id'] ?? null,
        ];
        dd(parent::update($input->toArray(),$id));
        return parent::update($input->toArray(),$id);
    }


    /**
     * @param $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createPlant($input): \Illuminate\Database\Eloquent\Model
    {
        $plant_input = [
            'name' => $input['name'],
            'description' => $input['description'] ?? null,
            'domestic_name' => $input['domestic_name'] ?? null,
            'exclusivity' => $input['exclusivity'] ?? null,
            'flowering_id' => $input['flowering_id'] ?? null,
            'cotyledon_id' => $input['cotyledon_id'] ?? null,
            'sperm_id' => $input['sperm_id'] ?? null,
        ];
        //store plant
        return  parent::create($plant_input);
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $plant
     * @return array
     */
    private function createTaxonomy($input, \Illuminate\Database\Eloquent\Model $plant): array
    {
        $taxonomy_input = [
            'family_id' => $input['family_id'],
            'genus_id' => $input['genus_id'] ?? null,
            'order_id' => $input['order_id'] ?? null,
            'class_id' => $input['class_id'] ?? null,
            'species_id' => $input['species_id'] ?? null,
            'variety_id' => $input['variety_id'] ?? null,
            'type_description' => $input['type_description'] ?? null,
        ];
        $taxonomy_input['plant_id'] = $plant->id;
        //store taxonomy
        $this->taxonomyRepository->create($taxonomy_input);
        return $taxonomy_input;
    }

    /**
     * @param array $taxonomy_input
     * @param \Illuminate\Database\Eloquent\Model $plant
     */
    private function syncPlantProperties(array $taxonomy_input, \Illuminate\Database\Eloquent\Model $plant): void
    {
        $general_input = array_filter($taxonomy_input, function ($value, $key) {
            return $value !== null and $key !== 'type_description' and $key !== 'plant_id';
        }, ARRAY_FILTER_USE_BOTH);

        $plant->generals()->sync($general_input);
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $plant
     * @return mixed
     */
    private function syncPlantTypeProperties($input, \Illuminate\Database\Eloquent\Model $plant)
    {
        $plant_type_ids=[];
        if (isset($input['plant_types'])) {
            foreach ($input['plant_types'] as $item) {
                $plant_type_ids[] = DB::table('generals')->where('type', 'plant_type')
                    ->where('name->en', 'LIKE', "%$item%")->pluck('id')->first();
            }
            //remove null members
            $plant_type_ids = array_filter($plant_type_ids, function ($value) {
                return $value !== null;
            });
            $plant->generals()->sync($plant_type_ids);
        }
        //return $input;
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $plant
     */
    private function syncPlantSubSpeciesProperties($input, \Illuminate\Database\Eloquent\Model $plant): void
    {
        if (isset($input['subspecies_ids'])) {
            $plant->generals()->sync($input['subspecies_ids']);
        }
    }

}
