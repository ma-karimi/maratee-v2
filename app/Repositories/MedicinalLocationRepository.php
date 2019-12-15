<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Article;
use App\Models\Location;
use App\Models\MedicinalLocation;
use App\Models\MedicinalLocationConstituent;
use App\Models\MedicinalLocationHub;
use App\Models\MedicinalPlant;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class MedicinalLocationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalLocationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var Location
     */
    private $location_model;
    private $article_repo;
    /**
     * @var ActionHub
     */
    private $actionHubRepo;
    /**
     * @var ActorHub
     */
    private $actorHubRepo;
    /**
     * @var MedicinalLocationConstituent
     */
    private $medicinalPlantConstituentRepo;

    /**
     * @var MedicinalLocationHub
     */
    private $medicinalLocationHub;

    /**
     * MedicinalLocationRepository constructor.
     * @param Application $app
     * @param ArticleRepository $article_repository
     * @param ActionHub $actionHubRepo
     * @param ActorHub $actorHubRepo
     * @param Location $location_model
     * @param MedicinalLocationConstituent $medicinalPlantConstituentRepo
     * @param MedicinalLocationHub $medicinalLocationHub
     * @throws \Exception
     */
    public function __construct(Application $app, ArticleRepository $article_repository, ActionHub $actionHubRepo, ActorHub $actorHubRepo, Location $location_model, MedicinalLocationConstituent $medicinalPlantConstituentRepo)
    {
        parent::__construct($app);
        $this->location_model = $location_model;
        $this->article_repo = $article_repository;
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
        $this->medicinalPlantConstituentRepo = $medicinalPlantConstituentRepo;
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
        return MedicinalLocation::class;
    }

    public function create($input)
    {

        $input['location_id'] = $this->createLocation($input)->id;

        $model = parent::create(Arr::only($input, $this->MedicinalLocationData()));
        $this->storeMetabolites($input, $model);
        $this->storeEffectiveMaterials($input, $model);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);
        return $model;
    }

    /**
     * @param $input
     * @return object
     */
    private function createLocation($input)
    {
        $location_input = $this->locationData($input);

        return $this->location_model->create($location_input);
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
            'region_name' => $input['region_name'] ?? null,
            'address_en' => $input['address_en'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
            'village' => $input['village'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
            'description' => $input['geographical_description'] ?? null,
        ];
    }

    /**
     * @return array
     */
    private function MedicinalLocationData(): array
    {
        return ['location_id', 'treatment_id', 'efficiency', 'studied_sample', 'presence_in_country', 'medicinal_properties', 'side_effects', 'phenology_id', 'method_distillation_id', 'method_extraction_id', 'method_analyse_id', 'herbarium_number'];
    }

    private function storeMetabolites($input, $medicinal_location)
    {
        $metabolites = request()->filled('metabolites') ? $input['metabolites'] : [];
        $this->createHub($medicinal_location->id, 'secondaryMetabolites', $metabolites);
    }

    private function storeEffectiveMaterials($input, $medicinal_location)
    {
        $materials = request()->filled('materials') ? $input['materials'] : [];
        $this->createHub($medicinal_location->id, 'secondaryMetabolites', $materials);
    }

    private function storeDetermine($input, $medicinal_location_id)
    {
        $action_hub = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => MedicinalPlant::class,
            'actionable_id' => $medicinal_location_id
        ]);
        $determines = request()->filled('determines') ? $input['determines'] : [];
        $this->createHub($action_hub->id, 'actors', $determines);
    }

    private function storeCollect($input, $medicinal_location_id)
    {

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => MedicinalPlant::class,
                'actionable_id' => $medicinal_location_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $collectors = request()->filled('collectors') ? $input['collectors'] : [];
        $this->createHub($action_hub->id, 'actors', $collectors);
    }

    public function storeConstituent($input, $medicinal_plant_id)
    {
        $constituents = json_decode($input['constituents']);

        $cons_collection = [];
        foreach ($constituents as $constituent) {
            $cons_collection[] = $constituent->constituent_type->id;
        }

        $this->medicinalPlantConstituentRepo
            ->where('medicinal_plant_id', $medicinal_plant_id)
            ->whereNotIn('constituent_type_id', $cons_collection)
            ->delete();

        foreach ($constituents as $item) {
            $this->medicinalPlantConstituentRepo
                ->updateOrCreate(
                    [
                        'constituent_type_id' => $item->constituent_type->id,
                        'medicinal_plant_id' => $medicinal_plant_id
                    ],
                    [
                        'value' => $item->value
                    ]
                );
        }
    }

    public function update($input, $id)
    {

        $this->updateLocation($input);

        $model = parent::update(Arr::except($input, $this->MedicinalLocationData()), $id);
        $this->storeMetabolites($input, $model->id);
        $this->storeEffectiveMaterials($input, $model->id);
        $this->storeDetermine($input, $id);
        $this->storeCollect($input, $id);
        return $model;
    }

    /**
     * @param $input
     * @return object
     */
    private function updateLocation($input)
    {
        $location_input = $this->locationData($input);

        return $this->location_model->find($input['location_id'])->update($location_input);
    }

    public function storeReference(array $input, $id)
    {
        $article_id = $this->storeArticle($input, !empty($input['article_id']) ? $input['article_id'] : null)->id ?? null;
        $this->storeArticleAuthors($input, $article_id);
        return parent::update(['article_id' => $article_id], $id);
    }

    private function storeArticle(array $input, $article_id = null)
    {
        $data = [
            'title' => $input['title'],
            'year' => $input['year'] ?? null,
            'journal_name' => $input['journal_name'] ?? null,
            'page_no' => $input['page_no'] ?? null
        ];
        if ($article_id) {
            return $this->article_repo->update($data, $article_id);
        }
        return $this->article_repo->create($data);
    }

    /**
     * @param array $input
     * @param $article
     * @return mixed
     */
    private function storeArticleAuthors(array $input, $article)
    {
        $authors = request()->filled('authors') ? $input['authors'] : [];
        $this->createHub($article->id, 'actors', $authors);
    }

}
